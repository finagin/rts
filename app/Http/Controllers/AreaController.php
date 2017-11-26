<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all()->toTree();

        return view('areas.brows', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function create(Area $area)
    {
        return static::viewCreateOrEdit($area);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area)
    {
        return static::insertOrUpdate($request, $area);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return static::viewCreateOrEdit($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        return static::insertOrUpdate($request, $area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }

    /**
     * Create or edit view.
     *
     * @param \App\Models\Area $area
     *
     * @return \Illuminate\Http\Response
     */
    protected function viewCreateOrEdit(Area $area)
    {
        $areas = Area::all()->toTree();

        return view('areas.edit-add', compact('area', 'areas'));
    }

    /**
     * Insert or Update method.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     *
     * @return \Illuminate\Http\Response
     */
    protected function insertOrUpdate(Request $request, Area $area)
    {
        $fillable = $request->validate([
            'title' => 'required|string|max:63|unique:areas'.($area && $area->id ? ',title,'.$area->id : ''),
            'parent_id' => 'required',
        ]);

        if ($area && $area->id) {
            $area->update($fillable);
            $status = 'Город <b>'.$area->title.'</b> успешно изменён.';
        } else {
            $area = Area::create($fillable);
            $status = 'Мастер <b>'.$area->title.'</b> успешно изменён.';
        }

        $area->parent_id = $fillable['parent_id'];
        $area->save();

        return redirect(route('areas.index'))->with(compact('status'));
    }
}
