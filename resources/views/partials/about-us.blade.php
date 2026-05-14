{{-- about-us.php --}}

<section class="about-us">
    <img class="about-us__vector v1" src="{{ asset('images/vector.png')}}" alt="">
    <div class="about-us__content">
        <article class="about-us__content__text">
            <h3 class="about-us__content__text__h3">Nosotros</h3>
            <p class="about-us__content__text__p">
                {{ $inicioContenido->about_us_texto }}
            </p>
            <a class="about-us__content__text__btn" href="{{ route('nosotros') }}">Mas info</a>
        </article>
        <picture class="about-us__content__img-container">
            <img class="about-us__content__img-container__img" src="{{ asset('images/about-us.png') }}" alt="">
        </picture>
    </div>
    <img class="about-us__vector v2" src="{{ asset('images/vector.png')}}" alt="">
</section>