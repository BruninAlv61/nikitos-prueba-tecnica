{{-- destacados.blade.php --}}

<section class="destacados">
    <h3 class="destacados__h3">Productos destacados</h3>
    <article class="destacados__card-container">
        <x-card-category
            href="#"
            image="{{ asset('images/des1.png') }}"
            alt=""
            title="Tapitas Barbacoa"
            tag="Línea fraccionada cristal x 80grs"
            tag_color="#F05199"
            button_text="Ver producto"
            text_color="#000000"

        />
        <x-card-category
            href="#"
            image="{{ asset('images/des2.png') }}"
            alt=""
            title="Pizzitos J y Q"
            tag="Línea premium max x 100grs"
            tag_color="#1CCB86"
            button_text="Ver producto"
            text_color="#000000"

        />
        <x-card-category
            href="#"
            image="{{ asset('images/des3.png') }}"
            alt=""
            title="Pochoclos Acaram."
            tag="Línea familiar tradicional"
            tag_color="#B899FC"
            button_text="Ver producto"
            text_color="#000000"

        />
        <x-card-category
            href="#"
            image="{{ asset('images/des4.png') }}"
            alt=""
            title="Jugos Surtidos"
            tag="Jugos"
            tag_color="#209276ff"
            button_text="Ver producto"
            text_color="#000000"
        />
    </article>
</section>
