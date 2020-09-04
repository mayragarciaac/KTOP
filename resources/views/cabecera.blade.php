<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
  var delete_cookie = function(name) {
      document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  };
  function Logout(){
    sessionStorage.removeItem('Token');
    delete_cookie('laravel_session');
    delete_cookie('XSRF-TOKEN');
    delete_cookie('PHPSESSID');
  }
</script>

<nav>
   <div class="nav-wrapper">
     <a href="/category_list2" class="brand-logo">KTOP</a>
     <ul id="nav-mobile" class="right hide-on-med-and-down">
       <li><a href="/category_list2">Categorias</a></li>
       <li><a href="" onclick="Logout()">Logout</a></li>
     </ul>
   </div>
 </nav>