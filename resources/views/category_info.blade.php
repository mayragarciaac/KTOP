@include('cabecera');

<!-- Page Layout here -->
<div class="row">
    <div class="coll s12" style="position: absolute;right: 50;">
        <a class="btn-floating btn-small waves-effect waves-light red" href="/create_product/{{ $category_list['id'] }}"><i class="material-icons">+</i></a>
    </div>
</div>
<div class="row">
    <div class="col s3">
        <ul class="collection">
            <li class="collection-header center"><h4>{{ $category_list['name'] }}</h4></li>
                @if ( sizeof($properties) > 0)
                    @foreach($properties as $prop)
                        <li class="collection-item"> {{ $prop['name'] }} </li>
                    @endforeach
                @endif
        </ul>
    </div>
    
    <div class=" col s7">
        @if ( sizeof($products) > 0)
        <table class="responsive-table">
            <thead>
              <tr>
                  <th>Producto</th>
                  <th>Model</th>
                  <th>stockUnits</th>
                  <th>Details</th>
              </tr>
            </thead>
    
            <tbody>
                @foreach($products as $prod)
                <tr>
                    <td>
                        <span>{{ $prod['name'] }}</span> <br>
                        <span>brand: {{ $prod['brand'] }}</span> <br>
                        <span>sku: {{ $prod['sku'] }}</span> <br>
                       
                    </td>
                    <td>{{ $prod['model'] }}</td>
                    <td>{{ $prod['stockUnits'] }}</td>
                    <td><a href="/show_product/{{ $prod['idProducto'] }}" >Detalles</a></td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        @endif
    </div>

</div>

