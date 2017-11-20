@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Города »
                        @if($city && $city->id){{ 'Редактирование "'.$city->title.'"' }}@else{{ 'Новый' }}@endif
                    </div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <form action="{{ route('cities.'.($city && $city->id ? 'update' : 'store'), $city) }}"
                              method="post">
                            @if($city && $city->id){{ method_field('PUT') }}@endif
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="control-label" for="title">
                                    Название
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Название" required
                                       value="{{ old('title', $city->title ?? '') }}">
                                <p class="help-block"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        @if($city && $city->id)
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
