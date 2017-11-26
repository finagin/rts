<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Skill;
use App\Events\ArtisanSaved;
use Illuminate\Http\Request;
use App\Http\Requests\Artisan\Store;
use App\Http\Requests\Artisan\Update;
use Illuminate\Database\QueryException;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::ofType('artisan');

        if ($request->has('city')) {
            $users = $users->ofCity($request->input('city'));
            $city = City::find($request->input('city'));
        } else {
            $city = null;
        }

        $users = $users->paginate();

        return view('users.artisans.brows', compact('users', 'city'));
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

        $cfs = AmoCrm::getClient()->account->apiCurrent()['custom_fields'][config('amocrm.catalog.artisans')];

        foreach ($cfs as $custom_field) {
            if ($custom_field['id'] == config('amocrm.custom_fields.artisans.skills')) {
                $skills = collect($custom_field['enums'])->map(function ($item, $key) {
                    Skill::updateOrCreate([
                        'id' => $key,
                    ], [
                        'slug' => $item,
                        'description' => $item,
                    ]);

                    return Skill::find($key);
                });
            } elseif ($custom_field['id'] == config('amocrm.custom_fields.artisans.cities')) {
                $cities = collect($custom_field['enums'])->map(function ($item, $key) {
                    return City::updateOrCreate([
                        'id' => $key,
                    ], [
                        'title' => $item,
                    ]);
                });
            }
        }

        return view('users.artisans.edit-add', compact('user', 'skills', 'cities'));
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
        $cities = $request->input('cities');

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
        $user->cities()->sync($cities);

        event(new ArtisanSaved($user));

        return redirect(route('users.artisans.index'))->with(compact('status'));
    }
}
