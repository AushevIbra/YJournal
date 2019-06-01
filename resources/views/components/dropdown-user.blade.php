<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content profile-dropdown">
    <li><a href="{{route('user.profile', auth()->user()->id)}}">Мой профиль</a></li>
    <li class="divider"></li>
    <li><a href="#!">Настройки</a></li>
    <li class="divider"></li>
    <li><a href="{{route("logout")}}">Выйти</a></li>
</ul>
