<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Requests\Artisan\Store;
use App\Http\Requests\Artisan\Update;
use Illuminate\Database\QueryException;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::ofType('artisan')
            ->paginate();

        return view('users.artisans.brows', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return static::viewCreateOrEdit($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Artisan\Store $request
     * @param  \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request, User $user)
    {
        return static::insertOrUpdate($request, $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return static::viewCreateOrEdit($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Artisan\Update $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, User $user)
    {
        return static::insertOrUpdate($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $status = 'Успех!';

        return redirect(route('users.artisans.index'))->with(compact('status'));
    }

    /**
     * Create or edit view.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function viewCreateOrEdit(User $user)
    {
        if ($user && $user->id && $user->type !== 'artisan') {
            return redirect(route('users.artisans.index'))->withErrors(['type' => 'Ошибка типа пользователя.']);
        }

        $skills = Skill::all();

        return view('users.artisans.edit-add', compact('user', 'skills'));
    }

    /**
     * Insert or Update method.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function insertOrUpdate(Request $request, User $user)
    {
        $fillable = $request->only('name', 'email', 'password', 'type');
        $skills = collect($request->input('skills'))->keys();

        if ($user && $user->id) {
            $user->update($fillable);
            $status = 'Мастер <b>'.$user->name.'</b> успешно изменён.';
        } else {
            $bool = true;
            $suffix = '@rts.ru';

            do {
                $random = str_random(15);
                $fillable['email'] = $random.$suffix;
                $fillable['password'] = $random;

                try {
                    $user = User::create($fillable);
                    $bool = false;
                } catch (QueryException $e) {
                }
            } while ($bool);

            $status = 'Мастер <b>'.$user->name.'</b> успешно добавлен.';
        }

        $user->skills()->sync($skills);

        return redirect(route('users.artisans.index'))->with(compact('status'));
    }
}
