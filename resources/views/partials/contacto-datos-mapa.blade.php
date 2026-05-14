{{-- Iconos SVG alineados con el footer (lucide); el color se aplica vía .contacto-datos__icon --}}
<section class="contacto-datos-mapa" aria-labelledby="contacto-datos-titulo">
    <div class="contacto-datos-mapa__inner">
        <div class="contacto-datos-mapa__grid">
        <div class="contacto-datos">
            <h2 id="contacto-datos-titulo" class="contacto-datos__titulo">Datos de contacto</h2>
            <ul class="contacto-datos__lista">
                <li class="contacto-datos__fila">
                    <span class="contacto-datos__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div class="contacto-datos__texto">
                        <span>Av. Otero y Gibraltar - Km 32 CP.1761</span>
                        <span>Pontevedra, Merlo, Buenos Aires, Argentina</span>
                    </div>
                </li>
                <li class="contacto-datos__fila">
                    <span class="contacto-datos__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg>
                    </span>
                    <div class="contacto-datos__texto">
                        <a href="tel:+542204924752">0220.492.4752</a>
                    </div>
                </li>
                <li class="contacto-datos__fila">
                    <span class="contacto-datos__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                    </span>
                    <div class="contacto-datos__texto">
                        <a href="mailto:ventas@nikitos.com.ar">ventas@nikitos.com.ar</a>
                    </div>
                </li>
                <li class="contacto-datos__fila">
                    <span class="contacto-datos__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </span>
                    <div class="contacto-datos__texto">
                        <span>Lunes a Viernes 9.00 a 17:30hs</span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="contacto-mapa">
            <div class="contacto-mapa__wrap">
                <div
                    id="contacto-map"
                    class="contacto-mapa__leaflet"
                    role="application"
                    aria-label="Mapa interactivo: Nikitos Snacks, Pontevedra, Merlo"
                ></div>
            </div>
        </div>
        </div>
    </div>
</section>
