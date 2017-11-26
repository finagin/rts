@foreach($areas as $area)
    <option value="{{ $area->id }}" {{ $user->area_id == $area->id ? 'selected' : '' }}>
        {{ str_repeat('&nbsp;', ($depth ?? 0) * 2).$area->title }}
    </option>
    @includeIf('users.managers.edit-add.tree', ['areas' => $area->children, 'depth' => ($depth ?? 0) + 1])
@endforeach