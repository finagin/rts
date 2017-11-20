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
                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                <label class="control-label" for="cities">
                                    Город
                                </label>
                                <select class="form-control" id="cities" name="cities[]">
                                    <option selected disabled>
                                        Выберите город
                                    </option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                        @if($user->hasCity($city->id)){{ 'selected' }}@endif>
                                            {{ $city->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    Навыки
                                </label>
                                <div class="row">
                                    @foreach($skills as $skill)
                                        <div class="col-xs-4 col-sm-3 col-md-2">
                                            <div class="checkbox">
                                                <label title="{{ $skill->description }}">
                                                    <input type="checkbox" name="skills[{{ $skill->id }}]"
                                                    @if($user->hasSkill($skill->id)){{ 'checked' }}@endif>
                                                    {{ $skill->slug }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
