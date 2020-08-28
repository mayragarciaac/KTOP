@include('cabecera_front');


@if (!empty($products) && sizeof($products) > 0)

<body>
    <div class="container">
       <div class="row">
        @foreach($products as $p)
        <div class="col s4">
            <div class="card horizontal">
                <div class="card-stacked">
                    <div class="card-content">
                        <h5 class="header red-text text-lighten-3"> {{$p['name']}} </h5>
                    </div>
                    <div class="card-action red-text text-lighten-3">
                        <a href="/products/{{$p['idProducto']}}">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
<br>
<br>
@endif