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
    url: 'http://165.232.110.31/api/create_product_form_info/' + element,
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

        let category_info = document.querySelector("input#Categoria")
        if (category_info != null && category_info != undefined) {
            category_info.value = data.category['name'];
        }

        category_info = document.querySelector("input#categoriaId")
        if (category_info != null && category_info != undefined) {
            category_info.value = data.category['id'];
        }

        let properties = document.querySelector("span.properties");
        if (properties != null && properties != undefined) {
            let prop_text = ``;
            if (data.Properties.length > 0) {
                data.Properties.forEach(prop => {
                    type = "text";
                    and = "";
                    prop_text += `
                    <div class="input-field col s12">
                    `;
                    if (Number(prop['type']) == 2) {
                        type = "checkbox";
                        and = 'checked style="opacity: 1;"';
                        prop_text += `<label for="stockUnits">` + prop['name'] + ` &nbsp;<input id="additional_info_` + prop['id'] + `" name="additional_info_` + prop['id'] + `" type="` + type + `" ` + and + ` /> </label>`;
                    } else {
                        prop_text += `
                        <input placeholder="  " id="additional_info_` + prop['id'] + `" name="additional_info_` + prop['id'] + `" type="` + type + `" ` + and + ` />
                        <label for="stockUnits"> ` + prop['name'] + `  </label>
                        `;
                    }
                    prop_text += `
                    </div>`;
                });

            }
            properties.innerHTML = prop_text;

            properties.innerHTML += `<div class="row right">
                <a href="/category_info2/` + data.category['id'] + `" class="btn waves-effect waves-light grey">Cancelar</a>
                <button class="btn waves-effect waves-light red" name="action_submit" onclick="store_product(this)">Guardar  </button>
            </div>`;


        }
        console.log(data);
    })
    .catch(function(error) {
        window.location.href = '/login';
    });




function store_product() {
    let form_info = document.querySelector("form.form_info");
    if (form_info != null && form_info != undefined) {
        let data_send = {
            'name': form_info.querySelector("input#Nombre").value,
            'model': form_info.querySelector("input#model").value,
            'description': form_info.querySelector("input#Description").value,
            'stockUnits': form_info.querySelector("input#stockUnits").value,
            'category': form_info.querySelector("input#categoriaId").value,
            'categoriaId': form_info.querySelector("input#categoriaId").value
        };


        let additional_info = document.querySelectorAll("input[name^='additional_info']");
        if (additional_info != null && additional_info != undefined && additional_info.length > 0) {
            additional_info.forEach(ad => {
                if (ad.type == 2 && ad.value != "on")
                    return;
                data_send[ad.name] = ad.value;
            });
        }
        console.log((data_send));
        var data2 = JSON.stringify({

            producto: JSON.stringify(data_send),
            token: token
        });
        var config = {
            method: 'post',
            url: 'http://165.232.110.31/api/create_product2/',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/x-www-form-urlencoded',
                'Cookie': 'XSRF-TOKEN=' + XSRF_TOKEN + '; laravel_session=' + laravel_session
            },
            data: data2
        };
        axios.defaults.withCredentials = true;

        axios(config)
            .then(function(response) {
                /*if (response.data != false)
                    window.location.href = '/show_product2/' + response.data;*/
                console.log(response);

            }).catch(function(error) {
                window.location.href = '/login';
            });
    }

    return false;
}