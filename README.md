# Laravel

###### Creació d'una ruta amb pas de paràmetres
~~~
Route::get('/post/{id}/{name}', function ($id,$name){
    return "Este es el post numº $id de $name";
});
~~~
###### Creació d'una ruta amb pas de paràmetres i filtrat dels mateixos
~~~
Route::get('/post/{id}/{name}', function ($id,$name){
    return "Este es el post nº $id de $name";
})->where('name', '[a-zA-Z]+');
~~~
* namespace (S'utilitza per no crear conflicte en altres classes, mètodes o variables que vaiguin crear les altres usuaris)
* Si la App es mol complexa, utilitzarem els controladors per a gestionar les rutes.
###### Per enllaçar l'arxiu de les rutes amb el contolador creat
~~~
Route::get('/start','ExampleController@start');

    * Primer argument: URL
    * Segon argument: Nom del controlador@nomDeLaFuncioQueUtilitzarem
~~~
* php artisan make:controller nomControlador (Per crear un controlador de forma automàtica (hem d'estar dintre la carpeta del projecte!!!))
* php artisan make:controller --resource nomControlador (Per crear un controlador de forma automàtica amb una serie de recursos predefinits (hem d'estar dintre la carpeta del projecte!!!))
* php artisan route:list (Llista totes les URL's que tenim creades)
* Si els mètodes que ens crea el "php artisan make:controller --resource" ens serveixen per la nostra web, si dintre el fitxer de rutes afegim "Route::resource("post","Example3Controller");", ens crea totes les rutes automàticament
* Bootstrap (Framework CSS, permet donar format a un lloc Web utilitzant llibreries CSS)
* Per utilitzar Bootstrap, reemplaçar carpetes /public/css i /public/js per les que ens descargarem de la Web de [Bootstrap](http://getbootstrap.com/).
* compact("nomArray") (Permet pasar un número de elements variable)
* php artisan migrate (executa les migracions)
* php artisan make:migration create_nomTaula(opcional)_table --create="nomTaula"
* php artisan migrate:rollback (Tira un pas enrere)
* php artisan migrate:reset (Fa un reset de totes les migracions)
* php artisan migrate:refresh (Elimina i executa TOTES les migracions)
* php artisan migrate:status (Per saber si hem executat els arxius migrate)
* php artisan dump-server (Per que surtin els xivatos per consola)
* php artisan serve (Per obrir servidor Laravel)
* laravel new nomApp (Per crear una App Laravel)
* $this->withoutExceptionHandling(); (Mostra errors en el test al PHPStorm)
* php artisan make:model nomModel (Per crear un model)
* php artisan make:model -a nomModel (Per crear un model, factoria, migració i controlador)
* use RefreshDatabase; (Sempre avans de fer un test que use bases de dades)
* php artisan tinker (Provar App)
###### Crear un formulari bàsic
~~~
<form action="/tasks" method="POST">
    {{--Label--}}
    @csrf
    <input name="name" type="text" placeholder="Nova tasca">
    <input hidden name="token" value="MY_TOKEN" type="text">
    <button>Afegir</button>
</form>
~~~

# Tasques per fer
* Modificar i completar tasques