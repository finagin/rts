@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Пользователи » Мастера » Навыки »
                        @if($skill && $skill->id){{ 'Редактирование "'.$skill->slug.'"' }}@else{{ 'Новый' }}@endif
                    </div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <form
                            action="{{ route('users.artisans.skills.'.($skill && $skill->id ? 'update' : 'store'), $skill) }}"
                            method="post">
                            @if($skill && $skill->id){{ method_field('PUT') }}@endif
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                <label class="control-label" for="slug">
                                    Код
                                </label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="Код" required
                                       value="{{ old('slug', $skill->slug ?? '') }}">
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                <label class="control-label" for="slug">
                                    Описание
                                </label>
                                <textarea class="form-control"
                                          name="description" id="description" placeholder="Описание"
                                >{{ old('description', $skill->description ?? '') }}</textarea>
                                <p class="help-block"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        @if($skill && $skill->id)
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
