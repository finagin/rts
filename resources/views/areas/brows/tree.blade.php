@foreach($areas as $area)
    <tr>
        <td>
            {{ str_repeat('&nbsp;', ($depth ?? 0) * 4).$area->title }}
        </td>
        <td>
            <div class="pull-right">
                @includeIf('areas.brows.actions', $area)
            </div>
        </td>
    </tr>
    @includeIf('areas.brows.tree', ['areas' => $area->children, 'depth' => ($depth ?? 0) + 1])
@endforeach