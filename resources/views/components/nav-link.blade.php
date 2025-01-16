<li class="nav-item">
    <a href="{{ $href }}" class="nav-link {{ $isActive() ? 'active' : '' }}">
        {{ $slot }}
    </a>
</li>
