@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Пользователи » Мастера » Навыки</div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('users.artisans.skills.create') }}" class="btn btn-lg btn-block btn-primary">
                                    Новый навык
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-table">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed table-numbered">
                                <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Код
                                    </th>
                                    <th colspan="2">
                                        Описание
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($skills as $skill)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration + (($skills->currentPage() - 1) * $skills->perPage()) }}
                                        </th>
                                        <td>
                                            <strong>
                                                {{ $skill->slug }}
                                            </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted" title="{{ $skill->description }}">
                                                {{ str_limit($skill->description, 80) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="pull-right">
                                                @includeIf('users.artisans.skills.brows.actions', $skill)
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                {{ $skills->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
