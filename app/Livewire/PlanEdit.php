<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlanEdit extends Component
{
    public $plan;

    #[Validate]
    public $name;

    #[Validate]
    public $description;

    #[Validate]
    public $price;

    #[Validate]
    public $duration;

    #[Validate]
    public $duration_unit;

    #[Validate]
    public $type;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'description' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_unit' => 'required|in:day,week,month,year',
            'type' => 'required|in:trial,non_trial',
        ];
    }

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->price = $plan->price;
        $this->duration = $plan->duration;
        $this->duration_unit = $plan->duration_unit;
        $this->type = $plan->type;
    }

    public function update()
    {
        $this->validate();
        $this->plan->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'type' => $this->type,
        ]);
        return redirect()->route('all-plans')->with([
            'status' => 'success',
            'message' => 'Plan Updated Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.plan-edit');
    }
}
