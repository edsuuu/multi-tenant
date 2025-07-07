<?php

namespace App\Livewire\Scheduling\Catalog\Components\Procedure;

use App\Models\ProcedureCategory;
use Livewire\Component;

class FormCategory extends Component
{
    public $name, $idCategory, $idCategoryDelete;

    public function mount($categoryId = null, $categoryIdDelete = null)
    {
        if ($categoryId) {
            $this->idCategory = $categoryId;

            $this->name = ProcedureCategory::query()->find($categoryId)->name;
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
            ProcedureCategory::where('id', $this->idCategory)
                ->where('business_id', auth()->user()->business->id)
                ->update([
                    'name' => $validate['name'],
                ]);
        } else {
            ProcedureCategory::updateOrCreate(
                [
                    'name' => $validate['name'],
                    'business_id' => auth()->user()->business->id
                ],
                [
                    'business_id' => auth()->user()->business->id,
                ]
            );
        }

        $this->dispatch('refreshNewProcedure');
        $this->dispatch('refreshCategoryInScreenProcedure');
        $this->dispatch('close-side-modal2', ['events' => 'refreshNewCategoryProcedure']);
    }

    public function deleteCategory(): void
    {
        $haveProcedureByCategory = ProcedureCategory::query()->with('procedures')->find($this->idCategoryDelete);

        if (isset($haveProcedureByCategory->procedures)) {
            if (count($haveProcedureByCategory->procedures) >= 1) {
                foreach ($haveProcedureByCategory->procedures as $product) {
                    $product->update(['product_category_id' => null]);
                }
            }
        }

        $haveProcedureByCategory->delete();

        $this->dispatch('close-side-modal2', ['events' => 'refreshNewCategoryProcedure']);
    }


    public function render()
    {
        return view('livewire.scheduling.catalog.components.procedure.form-category');
    }
}
