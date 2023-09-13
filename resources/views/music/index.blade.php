@extends("layouts.canonical")

@section('title'){{ "Music" }}@endsection

@section('content')
<p class="center">
    <x-badge-link href="/music-intro">
        My journey as a musician
    </x-badge-link>
    <x-badge-link href="/music/fanmusic">
        Fanmusic / invited contributions
    </x-badge-link>
</p>

<h2>Albums</h2>

<div class="badge-grid">
    <x-badge-link href="/music/whereveryouwere" background_image="https://i.scdn.co/image/ab67616d00001e0270cefcb5dadf32ec1351f849">
    </x-badge-link>
    <x-badge-link href="/music/theskybeyondourbay" background_image="https://f4.bcbits.com/img/a3376744408_10.jpg">
    </x-badge-link>
    <x-badge-link href="/music/flyways" background_image="https://f4.bcbits.com/img/a3232585135_10.jpg">
    </x-badge-link>
    <x-badge-link href="/music/amemoryfindsitsname" background_image="https://f4.bcbits.com/img/a1668076941_10.jpg">
    </x-badge-link>
    <x-badge-link href="/music/theskyisours" background_image="https://f4.bcbits.com/img/a1495289006_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/thechanginglight" background_image="https://f4.bcbits.com/img/a3279646927_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/timeandtide" background_image="https://f4.bcbits.com/img/a3236619707_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/someotherhorizon" background_image="https://f4.bcbits.com/img/a1597463711_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/betweenskyandsea" background_image="https://f4.bcbits.com/img/a1237498215_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/coastaldreaming" background_image="https://f4.bcbits.com/img/a0396190320_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/worldsawait" background_image="https://f4.bcbits.com/img/a3836868237_16.jpg">
    </x-badge-link>
    <x-badge-link href="/music/compass" background_image="https://f4.bcbits.com/img/a2104335924_16.jpg">
    </x-badge-link>
</div>

@endsection