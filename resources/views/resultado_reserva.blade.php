@include('cabecera_front');

<?php $reserva = json_decode($reserva,true);?>
<body>
    <div class="container">
        <h3>Reserva - {{ $reserva['idReserva'] }} </h3>
        <div class="collection">
            <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $reserva['email'] }}</span>Email</a>
            <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $reserva['name']." ".$reserva['lastname']  }}</span> Usuario</a>
        </div>
    </div>
</body>
