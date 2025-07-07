<?php

namespace App\Livewire\Scheduling\Catalog;

use App\Models\ProductCategory;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Products as ProductsBusiness;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshNewProducts' => '$refresh',
    ];

    public $searchProduct, $filterByCategory;
    public $categories = [];

    public function mount()
    {
        $this->resetPage();
    }

    #[On('refreshCategoryInScreenProducts')]
    public function refreshCategory()
    {
        $this->categories = ProductCategory::query()->where('business_id', auth()->user()->business->id)->get();
    }

    public function clearFilters():void
    {
        $this->searchProduct = '';
        $this->filterByCategory = '';
    }

    public function render()
    {
        $productsQuery = ProductsBusiness::query()
            ->with('category')
            ->where('business_id', auth()->user()->business->id)
            ->orderBy('name', 'ASC');

        if ($this->searchProduct) {
            $productsQuery->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->searchProduct . '%')->orWhereRelation('category', 'name', 'LIKE', '%' . $this->searchProduct . '%');
            });
        }

        if ($this->filterByCategory) {
            $productsQuery->where(function ($query) {
                $query->where('product_category_id', $this->filterByCategory);
            });
        }

        $products= $productsQuery->paginate(10);

        return view('livewire.scheduling.catalog.products', [
            'products' => $products,
        ]);
    }
}
