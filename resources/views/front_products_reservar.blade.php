
@include('cabecera_front');
<body>
    <div class="container">
        <h4>Resevar Producto - {{ $Producto['name'] }}</h4>
        <p> [solo se permite reservar un producto por cliente]</p>
        <div class="row">
            <form class="col s12" action="/create_reserva" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="IdProducto" value="{{ $Producto['idProducto'] }}">
                <div class="row">
                    <div class="input-field col s3">
                        <input placeholder="Nombre" id="Nombre" name="Nombre" type="text" class="validate">
                        <label for="Nombre">Nombre</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input placeholder="Apellido" id="Apellido" name="Apellido" type="text" class="validate">
                        <label for="Apellido">Apellido</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Email" id="Email" name="Email" type="text" class="validate">
                        <label for="Email">Email</label>
                    </div>
                </div>

                <div class="row right">
                    <a href="/products/{{ $Producto['idProducto'] }}" class="btn waves-effect waves-light grey">Cancelar</a>
                    <button class="btn waves-effect waves-light red" type="submit" name="action">Reservar  </button>
                </div>
              
            </form>
          </div>
    </div>
  </body>
