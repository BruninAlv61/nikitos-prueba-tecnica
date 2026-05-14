{{-- recipes-home.blade.php --}}

<x-card-grid title="Recetas" columns="3">
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
</x-card-grid>
