<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ContrataController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\RiscController;
use App\Http\Controllers\TreballadorController;
use App\Http\Controllers\DocumentacioPersonalTreballadorController;

Route::get('/locale/{locale}', function ($locale) {
    if (!in_array($locale, ['es', 'en', 'ca'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    App::setLocale($locale);

    if (Auth::check()) {
        $user = Auth::user();
        $user->locale = $locale;
        $user->save();
    }

    return redirect()->back();
})->name('locale.switch');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');

Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Empresas
    Route::resource('companies', CompanyController::class);
    Route::get('get-companies', [CompanyController::class, 'getCompanies'])->name('get.companies');

    // Contratas
    Route::resource('contratas', ContrataController::class);
    Route::get('get-contratas', [ContrataController::class, 'getContratas'])->name('get.contratas');


    // Gestión de Obras
    Route::resource('obras', ObraController::class);

    // Dashboard de Obras
    Route::get('/dashboard-obras', [ObraController::class, 'dashboard'])->name('dashboard.obras');
    Route::get('/dashboard-obras/data', [ObraController::class, 'dashboard'])->name('dashboard.obras.data');

    // Gestión de Obras por Empresa
    Route::get('/company/{company}/obras', [ObraController::class, 'indexByCompany'])->name('company.obras.index');
    Route::get('/company/{company}/obra/{obra}', [ObraController::class, 'showByCompany'])->name('company.obras.show');
    Route::get('/company/{company}/obras', [CompanyController::class, 'showObras'])->name('company.obras.index');

    // Recursos adicionales
    Route::resource('riscos', RiscController::class);
    Route::resource('treballadors', TreballadorController::class);
    Route::resource('documents', DocumentacioPersonalTreballadorController::class);
});

require __DIR__ . '/auth.php';
