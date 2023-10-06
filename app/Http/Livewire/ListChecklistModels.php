<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChecklistModel;
use Livewire\WithPagination;

class ListChecklistModels extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $sort = 'name';
    public $direction = 'asc';
    public $cant = 8;

    public function render()
    {
        $checklist_models = ChecklistModel::where('name','like', '%'. $this->search .'%')
            ->orWhere('description', 'like', '%' . $this->search .'%')
            ->orderBy($this->sort, $this->direction)
            //->get();
            // ->orderBy('created_at', 'desc')
            ->paginate($this->cant);

        return view('livewire.list-checklist-models', compact('checklist_models'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($sort)
    {
        if ($this->sort === $sort) {
            if ($this->direction == 'asc') {
                $this->direction == 'desc';
            } else {
                $this->direction == 'asc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
}
