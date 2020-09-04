

 
 @include('cabecera')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
 <script src="{{ asset('js/api/create_products2.js') }}"></script>

<body>
    <div class="container">
        <h4>Crear Producto</h4>
        <div class="row">
            <form class="col s12 form_info" method="POST" onsubmit="return false;">
                <input type="hidden" id="categoriaId" name="categoriaId" value="">
                <div class="row">
                    <div class="input-field col s6">
                    <input placeholder="Producto" id="Nombre" name="Nombre" type="text" class="validate">
                    <label for="Nombre">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input disabled  name="Categoria" id="Categoria" placeholder="" value="" type="text" class="validate">
                        <label for="disabled">Categoria</label>
                    </div>
                </div>

                <div class="row">
                <div class="input-field col s6">
                    <input placeholder="100" id="stockUnits" name="stockUnits" type="number" class="validate">
                    <label for="stockUnits">stockUnits</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Modelo" id="model" name="model" type="text" class="validate">
                    <label for="model">Model</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Producto de uso intensivo" name="Description" id="Description" type="text" class="validate">
                    <label for="Description">Descripción</label>
                </div>
                <span class="properties"></span>
               
                 
                
              
            </form>
          </div>
    </div>
  </body>



    
 
 