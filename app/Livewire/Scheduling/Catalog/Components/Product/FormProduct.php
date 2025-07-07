<?php

namespace App\Livewire\Scheduling\Catalog\Components\Product;

use App\Models\ProductCategory;
use App\Models\Products;
use Livewire\Attributes\On;
use Livewire\Component;

class FormProduct extends Component
{
    public $id, $name, $price, $quantity = 1, $categorySelect, $idDelete;
    public $categories = [];

    public function mount($idProduct = null, $idDelete = null): void
    {
        if ($idProduct) {
            $this->id = $idProduct;

            $productById = Products::query()->find($idProduct);

            $this->name = $productById->name;
            $this->price = number_format($productById->price, 2, ',', '.');
            $this->quantity = $productById->quantity;
            $this->categorySelect = $productById->product_category_id;
        }

        if ($idDelete) {
            $this->idDelete = $idDelete;
        }

        $this->refreshCategory();
    }

    #[On('refreshCategoryFormProduct')]
    public function refreshCategory(): void
    {
        $this->categories = ProductCategory::query()->where('business_id', auth()->user()->business->id)->get();
    }

    public function save(): void
    {
        $validate = $this->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required',
            'quantity' => 'required:min:0',
            'categorySelect' => 'sometimes|nullable',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'Já existe um produto com esse :attribute.',
        ], [
            'name' => 'Nome',
            'price' => 'Preço',
            'quantity' => 'Quantidade',
            'categorySelect' => 'Categoria',
        ]);


        if ($this->id) {
            Products::query()->find($this->id)->update([
                'name' => $this->name,
                'price' => (float)str_replace(',', '.', str_replace('.', '', $this->price)),
                'quantity' => $this->quantity,
                'product_category_id' => (int)$validate['categorySelect'] ?? null,
            ]);
        } else {
            Products::create(
                [
                    'name' => $validate['name'],
                    'price' => (float)str_replace(',', '.', str_replace('.', '', $validate['price'])),
                    'quantity' => $validate['quantity'],
                    'product_category_id' => $validate['categorySelect'] ?? null,
                    'business_id' => auth()->user()->business->id,
                ]
            );
        }

        $this->dispatch('close-side-modal', ['events' => 'refreshNewProducts']);
    }

    public function deleteProduct(): void
    {
        $prod = Products::query()->find($this->idDelete)->delete();

        if ($prod) {
            $this->dispatch('close-side-modal2', ['events' => 'refreshNewProducts']);
        }
    }

    public function render()
    {
        return view('livewire.scheduling.catalog.components.product.form-product');
    }
}
