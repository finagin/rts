<a href="{{ route('users.artisans.edit', $user) }}">
    <i class="fa fa-fw fa-lg fa-pencil" title="Редактировать манеджера"></i>
</a>

<a href="#" onclick="event.preventDefault(); document.getElementById('form-delete-artisan-{{ $user->id }}').submit();">
    <i class="fa fa-fw fa-lg fa-trash text-danger" title="Удалить манеджера"></i>
</a>
<form id="form-delete-artisan-{{ $user->id }}" action="{{ route('users.artisans.destroy', $user) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

