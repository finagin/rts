@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Города</div>

                    <div class="panel-body">
                        @includeIf('common.status')
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
                                        Имя
                                    </th>
                                    <th>
                                        Мастера
                                    </th>
                                    <th colspan="2">
                                        Зона
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cities as $city)
                                    <tr class="{{ is_null($city->area_id) ? 'danger' : '' }}">
                                        <th>
                                            {{ $loop->iteration + (($cities->currentPage() - 1) * $cities->perPage()) }}
                                        </th>
                                        <td>
                                            {{ $city->title }}
                                        </td>
                                        <td>
                                            <a href="{{ route('users.artisans.index', ['city' => $city->id]) }}">
                                                {{ $city->artisans()->count() }}
                                            </a>
                                        </td>
                                        <td>
                                            @if(! is_null($city->area))
                                                <a href="{{ route('users.managers.index', ['area' => $city->area->id]) }}">
                                                    {{ $city->area->title }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="pull-right">
                                                @includeIf('cities.brows.actions', $city)
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                {{ $cities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
