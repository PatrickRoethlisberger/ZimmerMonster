<?php

namespace App\Http\Livewire\Forms;

use App\Models\Bedtype;
use App\Models\Equipment;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\Repeater;
use Tanthammar\TallForms\Select;
use Tanthammar\TallForms\TallForm;
use Tanthammar\TallForms\Trix;

class CreateRoom extends Component
{
    use TallForm;

    public function mount(?Room $room, ?Hotel $hotel)
    {
        //Gate::authorize()
        $this->fill([
            'wrapWithView' => false, //see https://github.com/tanthammar/tall-forms/wiki/Wrapper-Layout
            'showGoBack' => false,
            'showDelete' => false,
            'showReset' => false,
        ]);

        $room->hotel_id = $hotel->id;

        $this->mount_form($room); // $room from hereon, called $this->model
    }


    // Mandatory method
    public function onCreateModel($validated_data)
    {
        // Check if user is even allowed to create rooms for this hotel
        if (! in_array($validated_data['hotel_id'], Auth::user()->team->hotels()->pluck('id')->toArray()) ) {
            return redirect()->route('manage.index');
        }

        // Set the $model property in order to conditionally display fields when the model instance exists, on saveAndStayResponse()
        $this->model = Room::create($validated_data);

        $validated_data['beds'] = collect($validated_data['beds'])->map(function($bed){
            return [
               'bedtype_id' => $bed['id'],
               'count' => $bed['pivot']['count'],
            ];
        })->toArray();

        $validated_data['equipments'] = collect($validated_data['equipments'])->map(function($equipment){
            if ($equipment['pivot']) {
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

        $this->model->beds()->sync($validated_data['beds']);

        $this->model->equipments()->sync($validated_data['equipments']);

        return redirect(route('manage.room.index', ['hotel' => Hotel::find($this->model->hotel_id)]));
    }

    // OPTIONAL method used for the "Save and stay" button, this method already exists in the TallForm trait
    public function onUpdateModel($validated_data)
    {
        // Check if user is even allowed to create rooms for this hotel
        if (! in_array($validated_data['hotel_id'], Auth::user()->team->hotels()->pluck('id')->toArray()) ) {
            return redirect()->route('manage.index');
        }

        $this->model->update($validated_data);

        $validated_data['beds'] = collect($validated_data['beds'])->map(function($bed){
            return [
               'bedtype_id' => $bed['id'],
               'count' => $bed['pivot']['count'],
            ];
        })->toArray();

        $validated_data['equipments'] = collect($validated_data['equipments'])->map(function($equipment){
            return [
               'equipment_id' => $equipment['id'],
               'description' => $equipment['pivot']['description'],
            ];
        })->toArray();

        $this->model->beds()->sync($validated_data['beds']);

        $this->model->equipments()->sync($validated_data['equipments']);

        return redirect(route('manage.room.index', ['hotel' => Hotel::find($this->model->hotel_id)]));
    }

    public function fields()
    {
        $fields = [
            Input::make('Name')->rules('required'),
            Trix::make('Beschreibung', 'description')->includeExternalScripts()->rules('required'),
            Input::make('Preis', 'price')->type('number')->step(0.05)->min(0)->rules('required|numeric'),
            Select::make('Kategorie', 'room_category_id')->options(RoomCategory::all()->pluck('id','name'))->rules('required')->placeholder('Kategorie auswählen'),
            Repeater::make('Schlaafplätze', 'beds')->fields([
                Select::make('Schlafplatz', 'id')->options(Bedtype::all()->pluck('id','name'))->rules('required')->colspan(8)->placeholder('Schlafplatzart auswählen'),
                Input::make('Anzahl', 'pivot.count')->type('number')->step(1)->min(1)->rules('required|integer')->colspan(4)
            ])->rules('required'),
            Repeater::make('Einrichtung', 'equipments')->fields([
                Select::make('Art', 'id')->options(Equipment::all()->pluck('id', 'name'))->rules('required')->placeholder('Einrichtungsart auswählen'),
                Input::make('Beschreibung', 'pivot.description')
            ])->childColspan(12),
            Input::make('hotel_id', 'hotel_id')->rules('required')->type('hidden')->class('nosy') ,
        ];

        return $fields;
    }
}
