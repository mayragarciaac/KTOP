var token = sessionStorage.getItem('Token');
var XSRF_TOKEN = $.cookie("XSRF-TOKEN");
var laravel_session = $.cookie("laravel_session");


var element = location.href.substring(location.href.lastIndexOf('/') + 1);
var data = JSON.stringify({
    'token': token
});
var config = {
    method: 'post',
    url: 'http://localhost:8000/api/show_product2/' + element,
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
        let text_aditional = ``;
        if (data['product_data_extended'] != null && data['product_data_extended'] != undefined && data['product_data_extended'] != "") {
            let aditional_properties = JSON.parse(data['product_data_extended']);
            if (aditional_properties != null && aditional_properties != undefined && aditional_properties[element] != null) {

                aditional_properties = aditional_properties[element];
                aditional_properties.forEach(element => {
                    if (element['type'] == 2) {
                        if (element['value'] == 1)
                            element['value'] = "si";
                        else element['value'] = "No";
                    }
                    text_aditional += ` <a href="#!" class="collection-item red-text text-lighten-3">` + element['name'] + `<span class="badge right">` + element['value'] + `</span></a>`;
                });
            }
        }
        let text_final = `
        <body>
                <div class="container">
            
            <div class="row">
                <div class="col s12">
                    <h4>` + data['name'] + `</h4>
                    <h6>[` + data['categoryname'] + `] </h6>
                    <p> ` + data['description'] + `</p>
                    <div class="collection">
                        <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">` + data['sku'] + `</span>Sku</a>
                        <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">` + data['brand'] + `</span>Brand</a>
                        <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">` + data['model'] + `</span>Model</a>
                        <a href="#!" class="collection-item red-text text-lighten-3"><span class="badge">` + data['stockUnits'] + `</span>Unidades</a>
                    </div>
            
                    
                  
                        <br>
                        <h6>Información adicional del producto </h6>
                        <div class="divider"></div>
                        <div class="collection">
                           ` + text_aditional + `
                        </div>
                        </div>   
                        <br>
                        <br>
                  
                </div>
                <div class="row">
                    <div class="col s12">
                    <a class="waves-effect waves-light red btn right " href="/category_info2/` + data['category'] + `">volver</a>
                    </div>
                </div>
            </div>
            
        </div>
    </body>`;


        document.body.innerHTML += text_final;
    })
    .catch(function(error) {
        window.location.href = '/login';
    });