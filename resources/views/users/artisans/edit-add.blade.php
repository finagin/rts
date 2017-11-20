@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Пользователи » Мастера »
                        @if($user && $user->id){{ 'Редактирование "'.$user->name.'"' }}@else{{ 'Новый' }}@endif
                    </div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <form action="{{ route('users.artisans.'.($user && $user->id ? 'update' : 'store'), $user) }}"
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
                            <input type="hidden" id="email" name="email"
                                   value="{{ old('email', $user->email ?? '') }}">
                            <input type="hidden" id="password" name="password"
                                   value="{{ old('password', $user->password ?? '') }}">
                            <input type="hidden" id="type" name="type" value="artisan">
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
