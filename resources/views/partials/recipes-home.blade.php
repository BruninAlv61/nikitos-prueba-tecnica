{{-- recipes-home.blade.php --}}

<section class="recipes-home">
    <h3 class="recipes-home__h3">Recetas</h3>
    <article class="recipes-home__card-container">
        <x-card-category
            href="#"
            image="{{ asset('images/re1.png') }}"
            alt=""
            title="Nachos de tacos en sartén"
            button_text="Ver receta"
            text_color="#000000"
            img_size="cover"
        />
        <x-card-category
            href="#"
            image="{{ asset('images/re2.png') }}"
            alt=""
            title="Tiras de pescado"
            button_text="Ver receta"
            text_color="#000000"
            img_size="cover"

        />
        <x-card-category
            href="#"
            image="{{ asset('images/re3.png') }}"
            alt=""
            title="Diferentes Salsas para Nachos Clásicos Nikitos"
            button_text="Ver receta"
            text_color="#000000"
            img_size="cover"

        />
    </article>
</section>
