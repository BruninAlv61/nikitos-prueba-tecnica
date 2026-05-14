@php
    $bloques = preg_split('/\R{2,}/u', trim($cuerpo ?? ''), -1, PREG_SPLIT_NO_EMPTY);
@endphp
@foreach ($bloques as $bloque)
    <p class="nosotros-page__p">{!! nl2br(e($bloque)) !!}</p>
@endforeach
