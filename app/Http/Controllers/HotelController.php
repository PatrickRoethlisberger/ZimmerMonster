<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\TouristAssociation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.hotel.index', [
            'hotels' => Auth::user()->team->hotels()->with(['city','touristAssociation'])->orderBy('name')->paginate(8)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.hotel.create', [
            'touristAssociations' => TouristAssociation::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( Auth::user()->team->type == 'admin') {
            $request->validate([
                'name' => ['required','string','max:255'],
                'street' => ['required', 'string', 'max:255'],
                'city_id' => ['required', 'exists:cities,id', 'integer'],
                'phone' => ['required', 'string', 'max:255', 'regex:/^(?:(?:|0{1,2}|\+{0,2})41(?:|\(0\))|0)([1-9]\d)(\d{3})(\d{2})(\d{2})$/'],
                'stars' => ['required', 'numeric', 'min:1', 'max:5'],
                'touristAssociation_id' => ['required', 'exists:tourist_associations,id', 'integer'],
            ]);

            $newTeam = Auth::user()->team->create([
                'type' => 'tourist_association',
                'parent_id' => $request->touristAssociation_id,
            ])->id;

            $touristAssociation_id = $request->touristAssociation_id;
        }
        else {
            $request->validate([
                'name' => ['required','string','max:255'],
                'street' => ['required', 'string', 'max:255'],
                'city_id' => ['required', 'exists:cities,id', 'integer'],
                'phone' => ['required', 'string', 'max:255', 'regex:/^(?:(?:|0{1,2}|\+{0,2})41(?:|\(0\))|0)([1-9]\d)(\d{3})(\d{2})(\d{2})$/'],
                'stars' => ['required', 'numeric', 'min:1', 'max:5'],
            ]);

            $touristAssociation_id = TouristAssociation::where('team_id',Auth::user()->team->id)->firstOrFail()->id;

            $newTeam = Auth::user()->team->create([
                'type' => 'hotel',
                'parent_id' => Auth::user()->team->id,
            ])->id;

        }

        Hotel::create([
            'name' => $request->name,
            'street' => $request->street,
            'city_id' => $request->city_id,
            'phone' => $request->phone,
            'stars' => $request->stars,
            'tourist_association_id' => $touristAssociation_id,
            'team_id' => $newTeam,
        ]);

        return redirect(route('manage.hotel.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        return view('manage.hotel.edit', [
            'hotel' => $hotel,
            'touristAssociations' => TouristAssociation::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        if (in_array($hotel->id, Auth::user()->team->hotels->pluck('id')->toArray())) {
            if( Auth::user()->team->type == 'admin') {
                $request->validate([
                    'name' => ['required','string','max:255'],
                    'street' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255', 'regex:/^(?:(?:|0{1,2}|\+{0,2})41(?:|\(0\))|0)([1-9]\d)(\d{3})(\d{2})(\d{2})$/'],
                    'stars' => ['required', 'numeric', 'min:1', 'max:5', 'multiple_of:0.5'],
                    'touristAssociation_id' => ['required', 'exists:tourist_associations,id', 'integer'],
                ]);

                $touristAssociation_id = $request->touristAssociation_id;
            }
            else {
                $request->validate([
                    'name' => ['required','string','max:255'],
                    'street' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255', 'regex:/^(?:(?:|0{1,2}|\+{0,2})41(?:|\(0\))|0)([1-9]\d)(\d{3})(\d{2})(\d{2})$/'],
                    'stars' => ['required', 'numeric', 'min:1', 'max:5', 'multiple_of:0.5'],
                ]);

                $touristAssociation_id = TouristAssociation::where('team_id',Auth::user()->team->id)->firstOrFail()->id;

            }

            $hotel->update([
                'name' => $request->name,
                'street' => $request->street,
                'phone' => $request->phone,
                'stars' => $request->stars,
                'tourist_association_id' => $touristAssociation_id,
            ]);

            return redirect(route('manage.hotel.index'));
        }
        else {
            return redirect(route('manage.hotel.edit', $hotel))
            ->withErrors('Sie können dieses Hotel nicht bearbeiten.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
