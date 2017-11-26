<a href="{{ route('areas.edit', $area) }}">
    <i class="fa fa-fw fa-lg fa-pencil" title="Редактировать город"></i>
</a>

<a href="#" onclick="event.preventDefault(); document.getElementById('form-delete-artisan-{{ $area->id }}').submit();">
    <i class="fa fa-fw fa-lg fa-trash text-danger" title="Удалить город"></i>
</a>
<form id="form-delete-artisan-{{ $area->id }}" action="{{ route('areas.destroy', $area) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

