@foreach($areas as $area)
    <option value="{{ $area->id }}" {{ $city->area_id == $area->id ? 'selected' : '' }} {{ $area->isLeaf() ? '' : 'disabled' }}>
        {{ str_repeat('&nbsp;', ($depth ?? 0) * 2).$area->title }}
    </option>
    @includeIf('cities.edit-add.tree', ['areas' => $area->children, 'depth' => ($depth ?? 0) + 1])
@endforeach