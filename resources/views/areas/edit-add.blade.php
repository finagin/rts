@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Города »
                        @if($area && $area->id){{ 'Редактирование "'.$area->title.'"' }}@else{{ 'Новый' }}@endif
                    </div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <form action="{{ route('areas.'.($area && $area->id ? 'update' : 'store'), $area) }}"
                              method="post">
                            @if($area && $area->id){{ method_field('PUT') }}@endif
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label class="control-label" for="title">
                                    Название
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Название" required
                                       value="{{ old('title', $area->title ?? '') }}">
                                <p class="help-block"></p>
                            </div>
                            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                <label class="control-label" for="parent_id">
                                    Название
                                </label>
                                <select class="form-control" id="parent_id" name="parent_id" required>
                                    <option disabled selected>Выберите родительскую зону</option>
                                    @includeIf('areas.edit-add.tree', ['areas' => $areas, 'self' => $area])
                                </select>
                                <p class="help-block"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        @if($area && $area->id)
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
