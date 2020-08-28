
@include('cabecera');
<?php $data = json_decode($data,true); ?>
<body>
    <div class="container">
        <h4>Crear Producto</h4>
        <div class="row">
            <form class="col s12" action="/save_productform" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="categoriaId" value="{{ $data['category']['id'] }}">
                <div class="row">
                    <div class="input-field col s6">
                    <input placeholder="Prducto" id="Nombre" name="Nombre" type="text" class="validate">
                    <label for="Nombre">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input disabled  name="Categoria"  value="{{ $data['category']['name'] }}" type="text" class="validate">
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

                @if (!empty($data['Properties']) && sizeof($data['Properties']) > 0)
                    
                    @foreach($data['Properties'] as $p)
                        <div class="input-field col s12">
                            <?php   $type = "text"; 
                                    $and =""; 
                                    if(intval($p['type']) == 2 ){ 
                                        $type = "checkbox"; $and = 'checked style="opacity: 1;"';
                                        ?>
                                            
                                            <label for="stockUnits"> {{$p['name']}} &nbsp;<input placeholder="  " id="additional_info_{{$p['id']}}" name="additional_info_ {{$p['id']}}" type="<?=$type?>" <?=$and?> class="validate"> </label>
                                        <?php
                                    } 
                                    else{
                                        ?>
                                            <input placeholder="  " id="additional_info_ {{$p['id']}}" name="additional_info_{{$p['id']}}" type="<?=$type?>" <?=$and?> class="validate">
                                            <label for="stockUnits"> {{$p['name']}} </label>
                                        <?php
                                    }
                                ?>
                            
                        </div>
                    @endforeach
                @endif
                 
                <div class="row right">
                    <a href="/category_list/{{ $data['category']['id'] }}" class="btn waves-effect waves-light grey">Cancelar</a>
                    <button class="btn waves-effect waves-light red" type="submit" name="action">Guardar  </button>
                </div>
              
            </form>
          </div>
    </div>
  </body>
