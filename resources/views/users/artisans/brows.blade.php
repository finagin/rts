@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Пользователи »
                        @if(! is_null($city))
                            <a href="{{ route('users.artisans.index') }}">Мастера</a>
                            » {{ $city->title }}
                        @else
                            Мастера
                        @endif
                    </div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('users.artisans.create') }}" class="btn btn-lg btn-block btn-primary">
                                    Новый мастер
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
                                    <th colspan="2">
                                        Имя
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration + (($users->currentPage() - 1) * $users->perPage()) }}
                                        </th>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            <div class="pull-right">
                                                @includeIf('users.artisans.brows.actions', $user)
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                {{ $users->appends([] + (! is_null($city) ? ['city' => $city->id] : []))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
