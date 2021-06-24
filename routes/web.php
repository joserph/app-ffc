<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Farm;
use App\Coordination;
use App\MasterInvoiceItem;
use App\InvoiceHeader;
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
    $invoiceItems = MasterInvoiceItem::where('id_load', '=', $id)
        ->with('variety')
        ->with('invoiceh')
        ->with('client')
        ->join('farms', 'master_invoice_items.id_farm', '=', 'farms.id')
        ->select('master_invoice_items.*', 'farms.name')
        ->orderBy('farms.name', 'ASC')
        ->get();

    return $invoiceItems;
});

// Coordinacion
Route::resource('/coordination', 'CoordinationController')->names('coordination');

Route::get('/getcoordination/{id}', function($id){
    $coordination = Coordination::where('id_load', '=', $id)->get();

    return $coordination;
});
Route::get('/invoiceheader/{id}', function($id){
    $invoiceHeader = InvoiceHeader::where('id_load', '=', $id)->first();

    return $invoiceHeader;
});
// Factura Master
Route::get('comercial-invoice-pdf', 'InvoiceHeaderController@masterInvoicePdf')->name('comercial-invoice.pdf');
Route::get('comercial-invoice-excel', 'InvoiceHeaderController@masterInvoiceExcel')->name('comercial-invoice.excel');
// Shiptment Confirmation
Route::get('shiptment-confirmation-pdf', 'InvoiceHeaderController@shiptmentConfirmation')->name('shiptment-confirmation.pdf');
// Confirmacion de despacho
Route::get('shiptment-confirmation-internal-use-pdf', 'InvoiceHeaderController@shiptmentConfirmationInternalUse')->name('shiptment-confirmation-internal-use.pdf');
// ISF
Route::resource('/isf', 'ISFController')->names('isf');
// ISF Farms
Route::get('isf-pdf', 'ISFController@isfPdf')->name('isf.pdf');
// ISF 10 + 2
Route::get('isf10_2Pdf', 'ISFController@isf10_2Pdf')->name('isf.isf10_2Pdf');
// Loading Plane
Route::resource('/loadingplane', 'LoadingPlaneController')->names('loadingplane');
// Coordination PDF
Route::get('coordination-Pdf', 'CoordinationController@coordinationPdf')->name('coordination.pdf');
// Pallets
Route::resource('/pallets', 'PalletController')->names('pallets');
// Pallets Items
Route::resource('/palletitems', 'PalletItemController')->names('palletitems');
// Pallets Items PDF
Route::get('palletitems-Pdf', 'PalletItemController@palletitemsPdf')->name('palletitems.pdf');
// Pallets Items
Route::resource('/sketches', 'SketchController')->names('sketches');
// infoCoordination
Route::get('info-coordination', 'InvoiceHeaderController@infoCoordination')->name('info-coordination');
// Farms Invoice
Route::get('farms-invoice-pdf', 'InvoiceHeaderController@farmsInvoicePdf')->name('farms-invoice.pdf');
