@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Города</div>

                    <div class="panel-body">
                        @includeIf('common.status')

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('areas.create') }}" class="btn btn-lg btn-block btn-primary">
                                    Новый город
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
                                @includeIf('areas.brows.tree', compact('areas'))
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
