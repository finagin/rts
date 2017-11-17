<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manager\Store;
use App\Http\Requests\Manager\Update;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::ofType('manager')
            ->paginate();

        return view('users.managers.brows', compact('users'));
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
     * @param  \App\Http\Requests\Manager\Store $request
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
     * @param  \App\Models\User $user
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
     * @param  \App\Http\Requests\Manager\Update $request
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
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Create or edit view
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function viewCreateOrEdit(User $user)
    {
        if($user && $user->id && $user->type !== 'manager'){
            return redirect(route('users.managers.index'))->withErrors(['type' => 'Ошибка типа пользователя.']);
        }

        return view('users.managers.edit-add', compact('user'));
    }

    /**
     * Insert or Update method
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function insertOrUpdate(Request $request, User $user)
    {
        $fillable = $request->only('name', 'email', 'password', 'type');

        if ($user && $user->id) {
            $user->update($fillable);
            $status = 'Менеджер <b>'.$user->name.'</b> успешно изменён.';
        } else {
            $user = User::create($fillable);
            $status = 'Менеджер <b>'.$user->name.'</b> успешно добавлен.';
        }

        return redirect(route('users.managers.index'))->with(compact('status'));
    }
}
