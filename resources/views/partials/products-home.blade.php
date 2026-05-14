{{-- products-home.blade.php --}}

<section class="products-home">
    <h3 class="products-home__h3">Linea de productos</h3>
    <div class="cards-categories-grid">
        <x-card-category href="#" image="{{ asset('images/cat1.png') }}" alt="" title="Línea juvenil metalizada 1" color="#F05199" button_text="Ver todos" />
        <x-card-category href="#" image="{{ asset('images/cat2.png') }}" alt="" title="Línea juvenil metalizada 2" color="#FD7E80" button_text="Ver todos" />
        <x-card-category href="#" image="{{ asset('images/cat3.png') }}" alt="" title="Línea fraccionada cristal x 40grs" color="#DC6DFC" button_text="Ver todos" />
        <x-card-category href="#" image="{{ asset('images/cat4.png') }}" alt="" title="Línea max x 65grs" color="#1CCB86" button_text="Ver todos" />
    </div>
</section>