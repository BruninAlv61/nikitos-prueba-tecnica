(function () {
    /* ─── helpers ─── */

    /** Escape HTML entities (replaces L.Util.escapeHtml which may not exist) */
    function escHtml(str) {
        var d = document.createElement('div');
        d.appendChild(document.createTextNode(String(str)));
        return d.innerHTML;
    }

    /** Escape for HTML attribute values */
    function escAttr(v) {
        return String(v)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    /**
     * Custom Leaflet divIcon with the Nikitos logo.
     * @param {string} logoUrl
     * @param {string|number} markerId
     */
    function makeLogoIcon(logoUrl, markerId) {
        return L.divIcon({
            className: 'nikitos-marker-wrap',
            html:
                '<div class="nikitos-marker" data-nikitos-marker="' +
                escAttr(markerId) +
                '">' +
                '<div class="nikitos-marker__img-wrap">' +
                '<img src="' +
                escAttr(logoUrl) +
                '" alt="Nikitos" decoding="async" loading="lazy">' +
                '</div></div>',
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40],
        });
    }

    function addOsmTiles(map) {
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap',
        }).addTo(map);
    }

    /* ─── Donde comprar ─── */

    function initDondeComprar() {
        var cfg = window.__DONDE_COMPRAR__;
        if (!cfg || typeof L === 'undefined') return;

        var rawSedes = cfg.sedes;
        var sedes = Array.isArray(rawSedes)
            ? rawSedes
            : Object.values(rawSedes || {});
        if (sedes.length === 0) return;

        var root = document.querySelector('[data-donde-comprar]');
        var mapEl = document.getElementById('donde-comprar-map');
        var listEl = root && root.querySelector('[data-sedes-list]');
        var filterEl = root && root.querySelector('[data-provincia-filter]');
        if (!root || !mapEl || !listEl || !filterEl) return;

        var logoUrl = cfg.logoUrl;

        /* --- map --- */
        var map = L.map(mapEl, {
            scrollWheelZoom: true,
            zoomControl: true,
        });

        addOsmTiles(map);

        /* Show entire Argentina initially */
        var argentinaBounds = L.latLngBounds(
            L.latLng(-55.3, -73.6),
            L.latLng(-21.8, -53.6)
        );
        map.fitBounds(argentinaBounds, { padding: [12, 12] });

        /* --- markers --- */
        /** @type {Map<number, L.Marker>} */
        var markersById = new Map();

        sedes.forEach(function (sede) {
            var lat = Number(sede.lat);
            var lng = Number(sede.lng);
            if (Number.isNaN(lat) || Number.isNaN(lng)) return;

            var marker = L.marker([lat, lng], {
                icon: makeLogoIcon(logoUrl, sede.id),
            }).addTo(map);

            marker.bindPopup(
                '<strong>' + escHtml(sede.ciudad) + '</strong><br>' +
                escHtml(sede.provincia)
            );

            markersById.set(Number(sede.id), marker);
        });

        /* --- active state --- */
        var activeId = null;

        function setActive(id) {
            activeId = id;
            listEl.querySelectorAll('.donde-comprar__item').forEach(function (btn) {
                var sid = Number(btn.getAttribute('data-sede-id'));
                btn.classList.toggle('donde-comprar__item--active', sid === id);
            });
        }

        function flyToSede(sede) {
            var marker = markersById.get(Number(sede.id));
            var z = map.getZoom() < 10 ? 13 : Math.max(map.getZoom(), 13);
            map.flyTo([Number(sede.lat), Number(sede.lng)], Math.min(z, 15), {
                duration: 0.85,
            });
            if (marker) {
                setTimeout(function () { marker.openPopup(); }, 900);
            }
            setActive(Number(sede.id));
        }

        /* --- sidebar list --- */
        function renderList(filterProvincia) {
            listEl.innerHTML = '';
            var frag = document.createDocumentFragment();

            sedes
                .filter(function (s) {
                    return !filterProvincia || s.provincia === filterProvincia;
                })
                .forEach(function (sede) {
                    var li = document.createElement('li');
                    li.className = 'donde-comprar__li';

                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'donde-comprar__item';
                    btn.setAttribute('data-sede-id', String(sede.id));
                    btn.setAttribute(
                        'aria-label',
                        'Ver en mapa: ' + sede.ciudad + ', ' + sede.provincia
                    );

                    var prov = document.createElement('span');
                    prov.className = 'donde-comprar__provincia';
                    prov.textContent = sede.provincia;

                    var ciu = document.createElement('span');
                    ciu.className = 'donde-comprar__ciudad';
                    ciu.textContent = sede.ciudad;

                    btn.appendChild(prov);
                    btn.appendChild(ciu);
                    btn.addEventListener('click', flyToSede.bind(null, sede));

                    li.appendChild(btn);
                    frag.appendChild(li);
                });

            listEl.appendChild(frag);

            /* keep active highlight if still in view */
            if (activeId != null) {
                var stillVisible = sedes.some(function (s) {
                    return (
                        Number(s.id) === activeId &&
                        (!filterProvincia || s.provincia === filterProvincia)
                    );
                });
                if (!stillVisible) {
                    activeId = null;
                } else {
                    setActive(activeId);
                }
            }
        }

        /* province filter */
        filterEl.addEventListener('change', function () {
            renderList(filterEl.value || '');
        });

        /* initial render */
        renderList('');

        /* force Leaflet to recalculate container size */
        var refreshMapSize = function () { map.invalidateSize(); };
        refreshMapSize();
        requestAnimationFrame(refreshMapSize);
        setTimeout(refreshMapSize, 250);
        setTimeout(refreshMapSize, 600);
        window.addEventListener('resize', refreshMapSize);
    }

    /* ─── Contacto map ─── */

    function initContactoMap() {
        var cfg = window.__CONTACTO_MAP__;
        if (!cfg || typeof L === 'undefined') return;

        var mapEl = document.getElementById('contacto-map');
        if (!mapEl) return;

        var lat = Number(cfg.lat);
        var lng = Number(cfg.lng);
        if (Number.isNaN(lat) || Number.isNaN(lng)) return;

        var logoUrl = cfg.logoUrl;
        if (!logoUrl) return;

        var zoom = Number(cfg.zoom);
        var initialZoom = Number.isNaN(zoom) ? 15 : zoom;

        var map = L.map(mapEl, {
            scrollWheelZoom: true,
            zoomControl: true,
            dragging: true,
            touchZoom: true,
            doubleClickZoom: true,
        });

        addOsmTiles(map);
        map.setView([lat, lng], initialZoom);

        var title = escHtml(cfg.title || 'Nikitos Snacks');
        var line1 = cfg.line1 ? escHtml(cfg.line1) : '';
        var line2 = cfg.line2 ? escHtml(cfg.line2) : '';
        var popupHtml = '<strong>' + title + '</strong>';
        if (line1) popupHtml += '<br>' + line1;
        if (line2) popupHtml += '<br>' + line2;

        L.marker([lat, lng], {
            icon: makeLogoIcon(logoUrl, 'contacto-sede'),
        })
            .addTo(map)
            .bindPopup(popupHtml);

        var refreshMapSize = function () { map.invalidateSize(); };
        refreshMapSize();
        requestAnimationFrame(refreshMapSize);
        setTimeout(refreshMapSize, 250);
        setTimeout(refreshMapSize, 600);
        window.addEventListener('resize', refreshMapSize);
    }

    /* ─── boot ─── */

    function boot() {
        initDondeComprar();
        initContactoMap();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
