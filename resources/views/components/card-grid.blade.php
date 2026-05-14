@props(['title', 'columns' => 4])

<section class="card-grid">
    <h3 class="card-grid__title">{{ $title }}</h3>
    <div class="card-grid__container card-grid__container--cols-{{ $columns }}">
        {{ $slot }}
    </div>
</section>
