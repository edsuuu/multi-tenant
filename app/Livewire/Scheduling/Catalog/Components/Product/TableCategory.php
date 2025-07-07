<?php

namespace App\Livewire\Scheduling\Catalog\Components\Product;

use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class TableCategory extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = [
        'refreshNewCategory' => '$refresh',
    ];

    public function getCategories()
    {
        $categories = ProductCategory::query()
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

        return view('livewire.scheduling.catalog.components.product.table-category', [
            'categories' => $categories,
        ]);
    }
}
