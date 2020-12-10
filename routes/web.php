<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Farm;
use App\MasterInvoiceItem;
use App\PermissionFolder\Models\Role;
use App\PermissionFolder\Models\Permission;
use Illuminate\Support\Facades\Gate;


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
// Principal
Route::get('/', function () {
    return view('welcome');
});
// Fincas
Route::get('/farms', function () {
    return view('farm.farms');
})->name('farms');

// Fincas
Route::get('/clients', function () {
    return view('client.clients');
})->name('clients');

// Compañia
Route::get('/companies', function () {
    return view('company.companies');
})->name('companies');

// Empresa de Logistica
Route::get('/logistics', function () {
    return view('logistic.logistics');
})->name('logistics');

// Factura Master
//Route::get('/masterinvoices/{load}', 'InvoiceHeaderController@index')->name('masterinvoices');

// Variedades de flores
Route::get('/varieties', function () {
    return view('variety.varieties');
})->name('varieties');


// Autenticación
Auth::routes();
// Index
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){
    $user = User::find(2);

    //$user->roles()->sync([2]);
    Gate::authorize('haveaccess', 'role.show');
    return $user;

    //return $user->havePermission('role.index');
});
// Roles
Route::resource('/role', 'RoleController')->names('role');
// Usuarios
Route::resource('/user', 'UserController', ['except' => ['create', 'store']])->names('user');
// Cambio de Contraseña
Route::get('user/password', 'UserController@password')->name('user.password');
Route::post('user/updatepassword', 'UserController@updatePassword')->name('user.updatepassword');
// Cambio de imagen de perfil
Route::post('user/updateprofilepicture', 'UserController@updateProfilePicture');
// Permisos
Route::resource('/permission', 'PermissionController')->names('permission');
// Cargas
Route::resource('/load', 'LoadController')->names('load');
// Cabecera de la factura master
Route::resource('/masterinvoices', 'InvoiceHeaderController')->names('masterinvoices');
// Items de la factura master
Route::resource('/masterinvoicesitems', 'MasterInvoiceItemController', ['except' => ['index']])->names('masterinvoicesitems');
Route::get('/invoicesitems/{id}', function($id){
    /*$invoiceItems = MasterInvoiceItem::with([
        'farm' => function ($q){
            $q->orderBy('name', 'asc');
        }])->with('variety')->where('id_load', $id)->get();*/
    /*$invoiceItems = MasterInvoiceItem::with(['farm' => function($query)
    {
        Farm::orderBy('name', 'ASC');
    }])->get();*/
    //$invoiceItems = Farm::orderBy('name', 'ASC')->get();
    /*$invoiceItems = MasterInvoiceItem::with([
        'farm' => function($q)
        {
            $q->orderBy('name', 'asc');
            //Farm::select('name')->orderBy('name', 'asc');
        }])->get();*/
    $invoiceItems = MasterInvoiceItem::with('farm')->where('id_load', $id)->get();
    /*$invoiceItems = $items::with(['farm' => function($q)
    {
        $q->orderBy('name', 'ASC');
    }])->get();*/
    //dd($id);
    /*$invoiceItems = Farm::orderBy('name', 'ASC')->with(['masterinvoiceitems' => function($query)
    {
        $query->where('id_load', '=', 29);
    }])->get();*/
    // Intentar hacer la consulta al contrario es decir llamando las fincas primero y luego los items de la master invoice.
    return $invoiceItems;
});
