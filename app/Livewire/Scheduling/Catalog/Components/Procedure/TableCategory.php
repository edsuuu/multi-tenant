<?php

namespace App\Livewire\Scheduling\Catalog\Components\Procedure;

use App\Models\ProcedureCategory;
use Livewire\Component;
use Livewire\WithPagination;

class TableCategory extends Component
{

    use WithPagination;

    public $search;

    protected $listeners = [
        'refreshNewCategoryProcedure' => '$refresh',
    ];
    public function getCategories()
    {
        $categories = ProcedureCategory::query()
            ->where('business_id', auth()->user()->business->id)
            ->orderBy('name', 'ASC');

        if ($this->search) {
            $categories->where('name', 'like', '%' . $this->search . '%');
        }

        return $categories;
    }

    public function render()
    {
        $categories = $this->getCategories()->paginate(13);

        return view('livewire.scheduling.catalog.components.procedure.table-category', [
            'categories' => $categories,
        ]);
    }
}
