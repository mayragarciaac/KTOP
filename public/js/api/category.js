//revisar lo de la cookie en la cabecera!!

var token = sessionStorage.getItem('Token');
var XSRF_TOKEN = $.cookie("XSRF-TOKEN");
var laravel_session = $.cookie("laravel_session");
var data = JSON.stringify({
    'token': token
});
var config = {
    method: 'post',
    url: 'http://http://165.232.110.31//api/category_list2',
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
        document.body.innerHTML += ` 
        <body>
            <div class="container">
                <div class="row"></div>
            </div>
        </body>`;
        let categorias = JSON.stringify(response.data);
        let list = JSON.parse(categorias);
        list.forEach(cate => {
            document.querySelector("div.row").innerHTML += `
                <div class="col s6 m6">
                    <div class="card  red lighten-5">
                        <div class="card-content white-text">
                        <span class="card-title red-text">` + cate['name'] + `</span>
                        <p class=" red-text">Info Categoty</p>
                        </div>
                        <div class="card-action">
                        <a href="/category_info2/` + cate['id'] + `">Acceder</a>
                        </div>
                    </div>
                </div>
            `;

        });


    })
    .catch(function(error) {
        window.location.href = '/login';
    });