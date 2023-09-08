<div class="breeze-submenu">
    <div class="menu-header">{{ $header }}</div>
    @isset($content)
        <ul class="dropdown">
            {{ $content }}
        </ul> 
    @endisset
</div>