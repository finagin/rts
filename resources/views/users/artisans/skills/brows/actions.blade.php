<a href="{{ route('users.artisans.skills.edit', $skill) }}">
    <i class="fa fa-fw fa-lg fa-pencil" title="Редактировать навык"></i>
</a>

<a href="#" onclick="event.preventDefault(); document.getElementById('form-delete-artisan-{{ $skill->id }}').submit();">
    <i class="fa fa-fw fa-lg fa-trash text-danger" title="Удалить навык"></i>
</a>
<form id="form-delete-artisan-{{ $skill->id }}" action="{{ route('users.artisans.skills.destroy', $skill) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

