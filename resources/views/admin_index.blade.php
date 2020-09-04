

 @include('cabecera');


  <body>
    <div class="container">
       @if (count($category_list) > 0)
        <div class="row">
              @foreach($category_list as $category)
                  <div class="col s6 m6">
                    <div class="card  red lighten-5">
                      <div class="card-content white-text">
                        <span class="card-title red-text">{{ $category['name'] }}</span>
                        <p class=" red-text">Info Categoty</p>
                      </div>
                      <div class="card-action">
                        <a href="/category_list/{{ $category['id'] }}">Acceder</a>
                      </div>
                    </div>
                  </div>
              @endforeach
          </div>
          @endif
    </div>
  </body>
  
  
  
     
  
  