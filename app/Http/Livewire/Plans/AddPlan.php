<?php

namespace App\Http\Livewire\Plans;

use App\Models\Plan;
use Livewire\Component;

class AddPlan extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $plans;
    protected array $rules = [
        'plans.*.objective' => 'required',
        'plans.*.strategy' => 'required',
        'plans.*.method' => 'required',
    ];

    public function mount()
    {
        $this->plans=Plan::all();
    }

    public function render()
    {
        return view('livewire.plans.add-plan')->extends('layouts.app')
        ->section('content');
    }

    public function add()
    {
        $this->plans->push(new Plan());
    }

    public function save()
    {
        $this->validate();
        foreach($this->plans as $plan){
            $plan->save();
        }
    }

    public function delete($id)
    {
        $plan = $this->plans[$id];
        $this->plans->forget($id);
        $plan->delete();
    }

}
