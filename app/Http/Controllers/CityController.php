<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderByRaw('area_id IS NULL DESC')->paginate();

        $areas = Area::all()->toTree();

        return view('cities.brows', compact('cities', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function create(City $city)
    {
        return static::viewCreateOrEdit($city);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, City $city)
    {
        return static::insertOrUpdate($request, $city);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return static::viewCreateOrEdit($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        return static::insertOrUpdate($request, $city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        $status = 'Успех!';

        return redirect(route('cities.index'))->with(compact('status'));
    }

    /**
     * Create or edit view.
     *
     * @param \App\Models\City $city
     *
     * @return \Illuminate\Http\Response
     */
    protected function viewCreateOrEdit(City $city)
    {
        $areas = Area::all()->toTree();

        return view('cities.edit-add', compact('city', 'areas'));
    }

    /**
     * Insert or Update method.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     *
     * @return \Illuminate\Http\Response
     */
    protected function insertOrUpdate(Request $request, City $city)
    {
        $fillable = $request->validate([
            'title' => 'required|string|max:63|unique:cities'.($city && $city->id ? ',title,'.$city->id : ''),
            'area_id' => 'required',
        ]);

        if ($city && $city->id) {
            $city->update($fillable);
            $status = 'Город <b>'.$city->title.'</b> успешно изменён.';
        } else {
            $city = City::create($fillable);
            $status = 'Мастер <b>'.$city->title.'</b> успешно изменён.';
        }

        $area = Area::find($fillable['area_id']);

        $area->managers()->save($city);

        return redirect(route('cities.index'))->with(compact('status'));
    }
}
