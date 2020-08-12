<?php

// es importante para poder ver las consultas que se realizan a la base de datos
// DB::listen(function($query){
//     var_dump($query->sql);
// });

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// // clase-5---------------------------------------------------- // //

// Route::get('/', function () {
//     return "hola desde la pagina de inicio";
// });

// // clase-6---------------------------------------------------- // //

// Route::get('contacto', function () {
//     return "hola desde la pagina de contacto";
// });

// Route::get('saludar/{nombre?}', function($nombre = "invitado"){
//     return"saludos ". $nombre;
// });


// // clase-7---------------------------------------------------- // //


// Route::get('contactame', function() {
//     return "seccion de contactos";
// })->name('contactos');

// Route::get('/', function() {
//     echo "<a href='" .route('contactos'). "'>Contactanos 1</a><br>";
//     echo "<a href='" .route('contactos'). "'>Contactanos 2</a><br>";
//     echo "<a href='" .route('contactos'). "'>Contactanos 3</a><br>";
//     echo "<a href='" .route('contactos'). "'>Contactanos 4</a><br>";
//     echo "<a href='" .route('contactos'). "'>Contactanos 5</a><br>";
// });


// // clase-8---------------------------------------------------- // //

// Route::get('/', function () {
//     // pasar variables a a las vistas
//     $nombre = ' luis';
//     return view("home")->with('nombre', $nombre);
//     // return view("home")->with(['nombre '=> $nombre]);
//     // return view("home", ['nombre '=> $nombre]);
//     // return view("home", compact('nombre'));
// })->name('home');

// Route::view('/', 'home'); //politcas de privacidad, terminos y condiciones

// Route::view('/', 'home')->name('home');


// Route::view('/', 'home')->name('home');
// Route::view('/about', 'about')->name('about');
// Route::view('/portfolio', 'portfolio')->name('portfolio');
// Route::view('/contact', 'contact')->name('contact');

// // clase-10-------------------- // //
// no es bueno usar variables en las rutas para eso estan los controladores
//  $portfolio = [
//     ['title' => 'proyecto #1'],
//     ['title' => 'proyecto #2'],
//     ['title' => 'proyecto #3'],
//     ['title' => 'proyecto #4']
//  ];

// // clase-11-------------------- // //

// Route::view('/', 'home')->name('home');
// Route::view('/about', 'about')->name('about');
// Route::get('/portfolio', 'PortfolioController@index')->name('portfolio');

// Route::view('/contact', 'contact')->name('contact');

// Route::resource('projects', 'PortfolioController');


// App::setlocale('es'); dependiendo la localidad se puede colorar en español o en ingles

use Illuminate\Support\Facades\Route;


Route::view('/', 'home')->name('home');
Route::view('/quienes-somos', 'about')->name('about');

Route::resource('portafolio', 'ProjectController')->names('projects')->parameters(['portafolio' => 'project']);


Route::patch('portafolio/{project}/restore', 'ProjectController@restore')->name('projects.restore');
Route::delete('portafolio/{project}/forceDelete', 'ProjectController@forceDelete')->name('projects.forceDelete');


Route::get('categorias/{category}','CategoryController@show')->name('categories.show');

//  Route::get('/portafolio', 'ProjectController@index')->name('projects.index');
//  Route::get('/portafolio/crear', 'ProjectController@create')->name('projects.create');
//  Route::get('/portafolio/{project}/editar', 'ProjectController@edit')->name('projects.edit');
//  Route::patch('/portafolio/{project}/editar', 'ProjectController@update')->name('projects.update');
//  Route::post('/portafolio', 'ProjectController@store')->name('projects.store');
//  Route::get('/portafolio/{project}', 'ProjectController@show')->name('projects.show');
//  Route::delete('/portafolio/{project}', 'ProjectController@destroy')->name('projects.destroy');

Route::view('/contacto', 'contact')->name('contact');
Route::post('contact', 'MessageController@store')->name('messages.store');

Auth::routes();

