
@include('cabecera');
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
                <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $Producto['sku'] }}</span>Sku</a>
                <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $Producto['brand'] }}</span>Brand</a>
                <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $Producto['model'] }}</span>Model</a>
                <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">{{ $Producto['stockUnits'] }}</span>Unidades</a>
             </div>
    
             
             @if (!empty($ExtraInf[$Producto['idProducto']]) && sizeof($ExtraInf[$Producto['idProducto']]) > 0)
                <br>
                <h6>Información adicional del producto </h6>
                <div class="divider"></div>
                   <div class="collection">
                      @foreach($ExtraInf[$Producto['idProducto']] as $p)
                      
                      <?php $value = $p['value']; if($p['type'] == 2) { $value = "si"; if($p['value'] != 1) $value = "no";} ?>
                         <a href="#!" class="collection-item red-text text-lighten-3">{{$p['name']}}<span class="badge right"><?=$value?></span></a>
                      @endforeach
                   </div>
                </div>   
                <br>
                <br>
             @endif
         </div>
         <div class="row">
            <div class="col s12">
               <a class="waves-effect waves-light red btn right " href="/category_list/{{ $Producto['category'] }}">volver</a>
            </div>
         </div>
      </div>
      
   </div>
</body>