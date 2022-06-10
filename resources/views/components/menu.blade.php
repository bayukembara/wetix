<nav class="nav flex-column">
    @foreach($list AS $row)
        <a class="nav-link {{ $isActive($row['label']) ? 'active' : '' }}"
           href="{{ route($row['route']) }}">
            <i class="icon-menu {{ $row['icon'] }}"></i>
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>