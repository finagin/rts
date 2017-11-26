@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Пользователи » Менеджеры » Новый</div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <form action="{{ route('users.managers.'.($user && $user->id ? 'update' : 'store'), $user) }}"
                              method="post">
                            @if($user && $user->id){{ method_field('PUT') }}@endif
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="control-label" for="name">
                                    Имя
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Имя" required
                                       value="{{ old('name', $user->name ?? '') }}">
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label class="control-label" for="email">
                                    Почта
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Почта" required
                                       value="{{ old('email', $user->email ?? '') }}">
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label class="control-label" for="password">
                                    Пароль
                                </label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Пароль" required
                                       value="{{ old('password', $user->password ?? '') }}">
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group {{ $errors->has('area_id') ? 'has-error' : '' }}">
                                <label class="control-label" for="area_id">
                                    Название
                                </label>
                                <select class="form-control" id="area_id" name="area_id" required>
                                    <option disabled selected>Выберите зону</option>
                                    @includeIf('users.managers.edit-add.tree', ['areas' => $areas])
                                </select>
                                <p class="help-block"></p>
                            </div>
                            <input type="hidden" id="type" name="type" value="manager">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        @if($user && $user->id)
                                            Сохранить
                                        @else
                                            Создать
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
