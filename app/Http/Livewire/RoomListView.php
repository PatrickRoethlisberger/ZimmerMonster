<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\ListView;

class RoomListView extends ListView
{
    // public $paginate = 16;

    public $itemComponent = 'components.room-list-item';


    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Room::query();
    }


    /**
     * Sets the properties to every list item component
     *
     * @param $model Current model for each card
     */
    public function data($model)
    {
        return [
            'name' => $model->name,
            'price' => $model->price,
        ];
    }

    protected function actionsByRow()
{
    return [
        // Will redirect to route('user', $user->id)
        new RedirectAction('room.show', 'Weitere Infos', 'eye'),
    ];
}
}
