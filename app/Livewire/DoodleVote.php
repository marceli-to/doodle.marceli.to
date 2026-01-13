<?php

namespace App\Livewire;

use App\Models\Vote;
use Livewire\Component;

class DoodleVote extends Component
{
    public string $name = '';
    public array $tripTypes = [];
    public array $periods = [];
    public bool $hasVoted = false;
    public ?Vote $existingVote = null;

    public array $tripTypeOptions = [
        'city' => 'City',
        'villa' => 'Villa with pool',
    ];

    public array $periodOptions = [
        'late_spring' => 'Late spring',
        'summer_holiday' => 'Summer holiday',
        'early_fall' => 'Early fall',
    ];

    public function mount()
    {
        $this->checkExistingVote();
    }

    protected function checkExistingVote()
    {
        $sessionVoteId = session('vote_id');
        if ($sessionVoteId) {
            $this->existingVote = Vote::find($sessionVoteId);
            if ($this->existingVote) {
                $this->hasVoted = true;
                $this->name = $this->existingVote->name;
                $this->tripTypes = $this->existingVote->trip_types ?? [];
                $this->periods = $this->existingVote->periods ?? [];
            }
        }
    }

    public function submitVote()
    {
        $this->validate([
            'name' => 'required|min:2|max:100',
            'tripTypes' => 'required|array|min:1',
            'periods' => 'required|array|min:1',
        ], [
            'name.required' => 'Please enter your name.',
            'tripTypes.required' => 'Please select at least one trip type.',
            'tripTypes.min' => 'Please select at least one trip type.',
            'periods.required' => 'Please select at least one period.',
            'periods.min' => 'Please select at least one period.',
        ]);

        if ($this->existingVote) {
            $this->existingVote->update([
                'name' => $this->name,
                'trip_types' => $this->tripTypes,
                'periods' => $this->periods,
            ]);
        } else {
            $vote = Vote::create([
                'name' => $this->name,
                'trip_types' => $this->tripTypes,
                'periods' => $this->periods,
            ]);
            session(['vote_id' => $vote->id]);
            $this->existingVote = $vote;
        }

        $this->hasVoted = true;
    }

    public function editVote()
    {
        $this->hasVoted = false;
    }

    public function loadVote($voteId)
    {
        $vote = Vote::find($voteId);
        if ($vote) {
            $this->existingVote = $vote;
            $this->name = $vote->name;
            $this->tripTypes = $vote->trip_types ?? [];
            $this->periods = $vote->periods ?? [];
            $this->hasVoted = false;
            session(['vote_id' => $vote->id]);
        }
    }

    public function getResultsProperty()
    {
        $votes = Vote::all();
        $totalVotes = $votes->count();

        $tripTypeResults = [];
        foreach ($this->tripTypeOptions as $key => $label) {
            $count = $votes->filter(fn($v) => in_array($key, $v->trip_types ?? []))->count();
            $tripTypeResults[$key] = [
                'label' => $label,
                'count' => $count,
                'percentage' => $totalVotes > 0 ? round(($count / $totalVotes) * 100) : 0,
            ];
        }
        uasort($tripTypeResults, fn($a, $b) => $b['count'] <=> $a['count']);

        $periodResults = [];
        foreach ($this->periodOptions as $key => $label) {
            $count = $votes->filter(fn($v) => in_array($key, $v->periods ?? []))->count();
            $periodResults[$key] = [
                'label' => $label,
                'count' => $count,
                'percentage' => $totalVotes > 0 ? round(($count / $totalVotes) * 100) : 0,
            ];
        }
        uasort($periodResults, fn($a, $b) => $b['count'] <=> $a['count']);

        return [
            'total' => $totalVotes,
            'tripTypes' => $tripTypeResults,
            'periods' => $periodResults,
            'votes' => $votes,
        ];
    }

    public function render()
    {
        return view('livewire.doodle-vote', [
            'results' => $this->results,
        ]);
    }
}
