<?php

namespace App\Livewire\Scheduling\Catalog\Components\Procedure;

use App\Models\ProcedureCategory;
use App\Models\Procedures;
use Livewire\Attributes\On;
use Livewire\Component;

class FormProcedure extends Component
{
    public $id, $name, $price, $description, $duration, $categorySelect, $idDelete;
    public $categories = [];

    public function mount($idProcedure = null, $idDelete = null): void
    {
        if ($idProcedure) {
            $this->id = $idProcedure;

            $procedureById = Procedures::query()->find($idProcedure);

            $this->name = $procedureById->name;
            $this->price = number_format($procedureById->price, 2, ',', '.');
            $this->description = $procedureById->description;
            $this->duration = $procedureById->duration;
            $this->categorySelect = $procedureById->procedure_category_id;
        }

        if ($idDelete) {
            $this->idDelete = $idDelete;
        }

        $this->refreshCategory();
    }

    #[On('refreshCategoryFormProcedure')]
    public function refreshCategory(): void
    {
        $this->categories = ProcedureCategory::query()->where('business_id', auth()->user()->business->id)->get();
    }

    public function save(): void
    {
        $validate = $this->validate([
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'categorySelect' => 'sometimes|nullable',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'Já existe um produto com esse :attribute.',
        ], [
            'name' => 'Nome',
            'price' => 'Preço',
            'description' => 'Descrição',
            'duration' => 'Duração',
            'categorySelect' => 'Categoria',
        ]);

        if ($this->id) {
            Procedures::query()->find($this->id)->update([
                'name' => $this->name,
                'price' => (float)str_replace(',', '.', str_replace('.', '', $this->price)),
                'description' => $this->description,
                'duration' => $this->duration,
                'procedure_category_id' => $validate['categorySelect'] ?? null,
            ]);
        } else {
            Procedures::create(
                [
                    'name' => $validate['name'],
                    'price' => (float)str_replace(',', '.', str_replace('.', '', $validate['price'])),
                    'description' => $validate['description'],
                    'duration' => $validate['duration'],
                    'procedure_category_id' => $validate['categorySelect'] ?? null,
                    'business_id' => auth()->user()->business->id,
                ]
            );
        }

        $this->dispatch('close-side-modal', ['events' => 'refreshNewProcedure']);
    }

    public function deleteProcedure(): void
    {
        $prod = Procedures::query()->find($this->idDelete)->delete();

        if ($prod) {
            $this->dispatch('close-side-modal2', ['events' => 'refreshNewProcedure']);
        }
    }

    public function render()
    {
        return view('livewire.scheduling.catalog.components.procedure.form-procedure');
    }
}
