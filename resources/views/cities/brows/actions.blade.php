<a href="{{ route('cities.edit', $city) }}">
    <i class="fa fa-fw fa-lg fa-pencil" title="Редактировать город"></i>
</a>

<a href="#" onclick="event.preventDefault(); document.getElementById('form-delete-artisan-{{ $city->id }}').submit();">
    <i class="fa fa-fw fa-lg fa-trash text-danger" title="Удалить город"></i>
</a>
<form id="form-delete-artisan-{{ $city->id }}" action="{{ route('cities.destroy', $city) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

