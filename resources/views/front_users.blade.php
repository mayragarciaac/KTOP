@include('cabecera_front');

<body>
    <div class="container">
       <div class="row">
        @if ( sizeof($category_list) > 0)
            @foreach($category_list as $c)
                <div class="col s4">
                    <div class="card horizontal red lighten-4">
                        <div class="card-stacked">
                            <div class="card-content">
                                <h5 class="header red-text text-lighten-1"> {{$c['name']}} </h5>
                            </div>
                            <div class="card-action">
                                <a href="/category_products/{{$c['id']}}" class="red-text text-darken-4">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
         </div>
    </div>
</body>