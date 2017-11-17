@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Пользователи » Менеджеры</div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('users.managers.create') }}" class="btn btn-lg btn-block btn-primary">
                                    Новый менеджер
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
                                                @includeIf('users.managers.brows.actions', $user)
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
