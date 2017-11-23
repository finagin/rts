{{-- Right Side Of Navbar --}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
       aria-haspopup="true">
        Пользователи <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li>
            <a href="{{ route('users.managers.index') }}">
                Менеджеры
            </a>
        </li>
        <li role="separator" class="divider"></li>
        <li>
            <a href="{{ route('users.artisans.index') }}">
                Мастера
            </a>
        </li>
    </ul>
</li>