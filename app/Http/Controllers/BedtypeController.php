<?php

namespace App\Http\Controllers;

use App\Models\Bedtype;
use Illuminate\Http\Request;

class BedtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.bedtype.index', [
            'bedtypes' => Bedtype::orderBy('name')->paginate(16),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.bedtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:bedtypes',
            'sleepingspots' => 'required|integer',
        ]);

        Bedtype::create([
            'name' => $request->name,
            'sleepingspots' => $request->sleepingspots,
        ]);

        return redirect(route('bedtype.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bedtype  $bedtype
     * @return \Illuminate\Http\Response
     */
    public function show(Bedtype $bedtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bedtype  $bedtype
     * @return \Illuminate\Http\Response
     */
    public function edit(Bedtype $bedtype)
    {
        return view('manage.bedtype.edit', [
            'bedtype' => $bedtype
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bedtype  $bedtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bedtype $bedtype)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'sleepingspots' => 'required|integer',
        ]);

        $bedtype->update([
            'name' => $request->name,
            'sleepingspots' => $request->sleepingspots,
        ]);

        return redirect(route('bedtype.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bedtype  $bedtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bedtype $bedtype)
    {
        //
    }
}
