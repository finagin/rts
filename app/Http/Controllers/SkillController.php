<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Requests\Skill\Store;
use App\Http\Requests\Skill\Update;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::paginate();

        return view('users.artisans.skills.brows', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function create(Skill $skill)
    {
        return static::viewCreateOrEdit($skill);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Skill\Store $request
     * @param  \App\Models\Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request, Skill $skill)
    {
        return static::insertOrUpdate($request, $skill);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return static::viewCreateOrEdit($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Skill\Update $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Skill $skill)
    {
        return static::insertOrUpdate($request, $skill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        $status = 'Успех!';

        return redirect(route('users.artisans.skills.index'))->with(compact('status'));
    }

    /**
     * Create or edit view.
     *
     * @param  \App\Models\Skill $skill
     *
     * @return \Illuminate\Http\Response
     */
    protected function viewCreateOrEdit(Skill $skill)
    {
        return view('users.artisans.skills.edit-add', compact('skill'));
    }

    /**
     * Insert or Update method.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Skill $skill
     *
     * @return \Illuminate\Http\Response
     */
    protected function insertOrUpdate(Request $request, Skill $skill)
    {
        $fillable = $request->all();

        if ($skill && $skill->id) {
            $skill->update($fillable);
        } else {
            $skill = Skill::create($fillable);
        }

        $status = 'Успех!';

        return redirect(route('users.artisans.skills.index'))->with(compact('status'));
    }
}
