//revisar lo de la cookie en la cabecera!!

var token = sessionStorage.getItem('Token');
var XSRF_TOKEN = $.cookie("XSRF-TOKEN");
var laravel_session = $.cookie("laravel_session");

var element = location.href.substring(location.href.lastIndexOf('/') + 1);
var data = JSON.stringify({
    'token': token
});
var config = {
    method: 'post',
    url: 'http://http://165.232.110.31//api/category_info2/' + element,
    headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/x-www-form-urlencoded',
        'Cookie': 'XSRF-TOKEN=' + XSRF_TOKEN + '; laravel_session=' + laravel_session
    },
    data: data
};
axios.defaults.withCredentials = true;

axios(config)
    .then(function(response) {
        let data = response.data;
        let Li = ``;
        if (data.properties.length > 0)
            data.properties.forEach(prop => {
                Li += `<li class="collection-item"> ` + prop['name'] + ` </li>`;
            });
        let table_products = ``;
        let list_pro = ``;
        if (data.products.length > 0) {
            data.products.forEach(prod => {
                list_pro += `
                        <tr>
                            <td>
                                <span>` + prod['name'] + `</span> <br>
                                <span>brand: ` + prod['brand'] + `</span> <br>
                                <span>sku:` + prod['sku'] + `</span> <br>
                            
                            </td>
                            <td>` + prod['model'] + `</td>
                            <td>` + prod['stockUnits'] + `</td>
                            <td><a href="/show_product2/` + prod['idProducto'] + `" >Detalles</a></td>
                        </tr>
                    `;
            });
            table_products += `
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
                        ` + list_pro + `
                    </tbody>
                  </table>
            `;
        }

        document.body.innerHTML += `

        <!-- Page Layout here -->
        <div class="row">
            <div class="coll s12" style="position: absolute;right: 50;">
                <a class="btn-floating btn-small waves-effect waves-light red" href="/create_product2/` + element + `"><i class="material-icons">+</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <ul class="collection">
                    <li class="collection-header center"><h4>` + data.category_list['name'] + `</h4></li>
                        
                        ` + Li + ` 
                </ul>
            </div>
            
            <div class=" col s7">
                
            ` + table_products + `
            </div>
        
        </div>
        
        `;

    })
    .catch(function(error) {
        window.location.href = '/login';
    });