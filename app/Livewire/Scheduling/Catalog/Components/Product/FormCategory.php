<?php

namespace App\Livewire\Scheduling\Catalog\Components\Product;

use App\Models\ProductCategory;
use Livewire\Component;

class FormCategory extends Component
{
    public $name, $idCategory, $idCategoryDelete;

    public function mount($categoryId = null, $categoryIdDelete = null)
    {
        if ($categoryId) {
            $this->idCategory = $categoryId;

            $this->name = ProductCategory::query()->find($categoryId)->name;
        }

        if ($categoryIdDelete) {
            $this->idCategoryDelete = $categoryIdDelete;
        }
    }

    public function save()
    {
        $validate = $this->validate([
            'name' => 'required|unique:product_categories,name',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Já existe um produto com esse :attribute.',
        ], [
            'name' => 'Nome da categoria',
        ]);

        if ($this->idCategory) {
            ProductCategory::where('id', $this->idCategory)
                ->where('business_id', auth()->user()->business->id)
                ->update([
                    'name' => $validate['name'],
                ]);
        } else {
            ProductCategory::updateOrCreate(
                [
                    'name' => $validate['name'],
                    'business_id' => auth()->user()->business->id
                ],
                [
                    'business_id' => auth()->user()->business->id,
                ]
            );
        }

        $this->dispatch('refreshCategoryFormProduct');
        $this->dispatch('refreshCategoryInScreenProducts');
        $this->dispatch('close-side-modal2', ['events' => 'refreshNewCategory']);
    }

    public function deleteCategory(): void
    {
        $haveProductsByCategory = ProductCategory::query()->with('products')->find($this->idCategoryDelete);

        if (isset($haveProductsByCategory->products)) {
            if (count($haveProductsByCategory->products) >= 1) {
                foreach ($haveProductsByCategory->products as $product) {
                    $product->update(['product_category_id' => null]);
                }
            }
        }

        $haveProductsByCategory->delete();

        $this->dispatch('close-side-modal2', ['events' => 'refreshNewCategory']);
    }

    public function render()
    {
        return view('livewire.scheduling.catalog.components.product.form-category');
    }
}
