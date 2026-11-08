<div class="carte">
    <h3 class="carte-titre">{{ $titre }}</h3>

    @if (isset($meta))
        <p class="carte-meta">{{ $meta }}</p>
    @endif

    <div class="carte-corps">
        {{ $slot }}
    </div>
</div>