<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilAdmin;
use App\Http\Controllers\CliController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LienceController;
use App\Http\Controllers\CoureurController;
use App\Http\Middleware\EtudiantMiddleware;
use App\Http\Controllers\EtudiantController;
use PHPUnit\Event\Test\ConsideredRiskySubscriber;
use App\Http\Controllers\ReinsiliseBaseController;
use App\Http\Controllers\Auth\EquipeLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/', function () {
    return view('auth.login-client');
});


//insertion client manuel
Route::get('/insertAd', [\App\Http\Controllers\AuthController::class, 'insertAd']);
Route::get('/insertCli', [\App\Http\Controllers\AuthController::class, 'inscription']);


//login etudiant 
Route::get('/etudiant', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::get('/ajout',[AdminController::class, 'create'])->name('ajout');
Route::post('ajout/etu',[AdminController::class, 'ajouterEtu'])->name('ajout.etu');


//semestre 
Route::get('/semestre/{id_etudiant}',[AdminController::class, 'semetre'])->name('semestre');
Route::get('/semestre/note/{id_etudiant}/{id_semestre}',[AdminController::class, 'resulat_semestre'])->name('semestre.note');


//client route 
Route::get('/semestre/notes/{id_etudiant}/{id_semestre}',[EtudiantController::class, 'resultat_semestre_etu'])->name('semestre.notes');
Route::get('/semestreetu/{id_etudiant}',[EtudiantController::class, 'noteEtu'])->name('semestre.etu');

/// pour l'admin
Route::get('/admin/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/admin/login', [\App\Http\Controllers\AuthController::class, 'doLogin'])->name('auth.doLogin');
Route::get('/home',[AdminController::class, 'index'])->name('home');
Route::get('/note',[AdminController::class, 'note'])->name('note');
Route::post('/note/ajout',[AdminController::class,'ajouterNote'])->name('note.ajout');
Route::get('/search', [AdminController::class, 'search'])->name('etudiant.search');
Route::get('/bord',[AdminController::class, 'bord'])->name('admin.bord');
Route::get('/bord1',[AdminController::class, 'liste_admis'])->name('admin.liste_admis');

Route::get('/voir/semstre/{id_etudiant}',[NoteController::class, 'annee'])->name('voir.semestre');
Route::get('/annee/semestre/{id_etudiant}/{anne?}',[NoteController::class, 'semestre_anne'])->name('annee.semestre');
//authentification

//import csv 
Route::get('/import',[ImportController::class, 'index'])->name('import');
Route::post('/import/csv',[ImportController::class, 'importCsv'])->name('import.csv');
Route::post('/import/note',[ImportController::class, 'import_note'])->name('import.note');


Route::post('/etudiant/logina', [EtudiantController::class, 'doLoginEtu'])->name('etudianty');


Route::middleware([EtudiantMiddleware::class])->group(function () {
});



Route::get('reinsialise',[ReinsiliseBaseController::class, 'reset_database'])->name('reinsialise');