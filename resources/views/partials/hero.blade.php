{{-- hero.blade.php --}}

<section class="hero">
    <video class="hero__video" src="{{ asset('videos/hero.mp4') }}" autoplay loop muted></video>
    <article class="hero__text">
        <h1 class="hero__text__title">Nikitos Snacks</h1>
        <p class="hero__text__subtitle">Nikitos se encuentra presente en el mercado local desde hace 40 años. </p>
    </article>

    <article class="hero__actions">
        <a class="hero__actions__button catalog-btn" href="#">Descargar catálogo <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></a>
        <a class="hero__actions__button products-btn" href="#">Ver productos</a>
    </article>
</section>