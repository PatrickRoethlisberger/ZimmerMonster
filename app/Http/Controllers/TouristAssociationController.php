<?php

namespace App\Http\Controllers;

use App\Models\TouristAssociation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TouristAssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.tourist_association.index', [
            'touristAssociations' => Auth::user()->team->touristassociations()->with('city')->orderBy('name')->paginate(8)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.tourist_association.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'street' => ['required', 'string', 'max:255'],
            'city_id' => ['required', 'exists:cities,id', 'integer'],
            'phone' => ['required', 'string', 'max:32', 'regex:/^(?:(?:|0{1,2}|\+{0,2})41(?:|\(0\))|0)([1-9]\d)(\d{3})(\d{2})(\d{2})$/'],
        ]);

        $newTeam = Auth::user()->team->create([
            'type' => 'tourist_association',
            'parent_id' => Auth::user()->team->id,
        ])->id;

        TouristAssociation::create([
            'name' => $request->name,
            'street' => $request->street,
            'city_id' => $request->city_id,
            'phone' => $request->phone,
            'team_id' => $newTeam,
        ]);

        return redirect(route('manage.touristAssociation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TouristAssociation  $touristAssociation
     * @return \Illuminate\Http\Response
     */
    public function show(TouristAssociation $touristAssociation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TouristAssociation  $touristAssociation
     * @return \Illuminate\Http\Response
     */
    public function edit(TouristAssociation $touristAssociation)
    {
        return(view('manage.tourist_association.edit', compact('touristAssociation')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TouristAssociation  $touristAssociation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TouristAssociation $touristAssociation)
    {
        if (in_array($touristAssociation->id, Auth::user()->team->touristAssociations->pluck('id')->toArray())) {

            $request->validate([
                'name' => ['required','string','max:255'],
                'street' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:32', 'regex:/^(?:(?:|0{1,2}|\+{0,2})41(?:|\(0\))|0)([1-9]\d)(\d{3})(\d{2})(\d{2})$/'],
            ]);




            $touristAssociation->update([
                'name' => $request->name,
                'street' => $request->street,
                'phone' => $request->phone
            ]);

            return redirect(route('manage.touristAssociation.index'));
        }
        else {
            return redirect(route('manage.touristAssociation.edit', $touristAssociation))
            ->withErrors('Sie k??nnen diesen Verkehrsverein nicht bearbeiten.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TouristAssociation  $touristAssociation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TouristAssociation $touristAssociation)
    {
        //
    }
}
