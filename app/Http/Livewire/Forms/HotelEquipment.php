<?php

namespace App\Http\Livewire\Forms;

use App\Models\Equipment;
use App\Models\Hotel;
use Livewire\Component;
use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\Repeater;
use Tanthammar\TallForms\Select;
use Tanthammar\TallForms\TallForm;

class HotelEquipment extends Component
{
    use TallForm;

    public function mount(?Hotel $hotel)
    {
        //Gate::authorize()
        $this->fill([
            'wrapWithView' => false, //see https://github.com/tanthammar/tall-forms/wiki/Wrapper-Layout
            'showGoBack' => false,
            'showDelete' => false,
            'showReset' => false,
        ]);
        $this->mount_form($hotel); // $hotel from hereon, called $this->model
    }


    // Mandatory method
    public function onCreateModel($validated_data)
    {
        $validated_data['equipments'] = collect($validated_data['equipments'])->map(function($equipment){
            if (isset($equipment['pivot'])) {
                return [
                    'equipment_id' => $equipment['id'],
                    'description' => $equipment['pivot']['description'],
                ];
            }
            else {
                return [
                    'equipment_id' => $equipment['id']
                ];
            }
        })->toArray();

        $this->model->equipments()->sync($validated_data['equipments']);
        // Set the $model property in order to conditionally display fields when the model instance exists, on saveAndStayResponse()

        return redirect(route('manage.hotel.index'));
    }

    // OPTIONAL method used for the "Save and stay" button, this method already exists in the TallForm trait
    public function onUpdateModel($validated_data)
    {
        $validated_data['equipments'] = collect($validated_data['equipments'])->map(function($equipment){
            if (isset($equipment['pivot'])) {
                return [
                    'equipment_id' => $equipment['id'],
                    'description' => $equipment['pivot']['description'],
                ];
            }
            else {
                return [
                    'equipment_id' => $equipment['id']
                ];
            }
        })->toArray();

        $this->model->equipments()->sync($validated_data['equipments']);
        // Set the $model property in order to conditionally display fields when the model instance exists, on saveAndStayResponse()

        return redirect(route('manage.hotel.index'));
    }

    public function fields()
    {
        return [
            Repeater::make('Einrichtung', 'equipments')->fields([
                Select::make('Art', 'id')->options(Equipment::all()->pluck('id', 'name'))->rules('required')->placeholder('Einrichtungsart auswählen'),
                Input::make('Beschreibung', 'pivot.description')
            ])->childColspan(12),
        ];
    }
}
