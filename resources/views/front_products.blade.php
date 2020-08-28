@include('cabecera_front');
<?php  $ExtraInf = NULL;
      if(!empty($Producto['product_data_extended']))
         $ExtraInf = json_decode($Producto['product_data_extended'],true); ?>
<body>
   <div class="container">
      
      <div class="row">
         <div class="col s12">
            <h4>{{ $Producto['name'] }}</h4>
            <h6>[{{ $Producto['categoryname'] }}] </h6>
            <p>{{ $Producto['description'] }}</p>
            <div class="collection">
               <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $Producto['model'] }}</span>Model</a>
             
             </div>
    
             
             @if (!empty($ExtraInf[$Producto['idProducto']]) && sizeof($ExtraInf[$Producto['idProducto']]) > 0)
                <br>
                <h6>Información adicional del producto </h6>
                <div class="divider"></div>
                   <div class="collection">
                      @foreach($ExtraInf[$Producto['idProducto']] as $p)
                         <a href="#!" class="collection-item red-text text-lighten-3">{{$p['name']}}<span class="badge right">{{$p['value']}}</span></a>
                      @endforeach
                   </div>
                </div>   
                <br>
                <br>
             @endif
         </div>
         <div class="row">
            <div class="col s12">
               <a class="waves-effect waves-light grey btn " href="/category_products/{{ $Producto['category'] }}">volver</a>
                <a class="waves-effect waves-light red btn right " href="/booking_products/{{ $Producto['category'] }}">reservar</a>
             </div>
         </div>
      </div>
      
   </div>
</body>