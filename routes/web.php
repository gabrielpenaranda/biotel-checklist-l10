<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistModelController;
use App\Http\Controllers\ElementModelController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;

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

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); */

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group( function() {

    // Route::resource('checklist-model', ChecklistModelController::class);

    Route::prefix('checklist-model')->group(function () {
        Route::get('/', [ChecklistModelController::class, 'index'])->name('checklist-model.index')
            ->middleware('permission:checklist-model.index');
        Route::get('/create', [ChecklistModelController::class, 'create'])->name('checklist-model.create')
            ->middleware('permission:checklist-model.create');
        Route::post('/store', [ChecklistModelController::class, 'store'])->name('checklist-model.store')
            ->middleware('permission:checklist-model.create');
        Route::get('/show/{checklist_model}', [ChecklistModelController::class, 'show'])->name('checklist-model.show')
            ->middleware('permission:checklist-model.show');
        Route::get('/show-destroy/{checklist_model}', [ChecklistModelController::class, 'show_destroy'])->name('checklist-model.show-destroy')
        ->middleware('permission:checklist-model.destroy');
        Route::delete('/destroy/{checklist_model}', [ChecklistModelController::class, 'destroy'])->name('checklist-model.destroy')
            ->middleware('permission:checklist-model.destroy');
        Route::get('/edit/{checklist_model}', [ChecklistModelController::class, 'edit'])->name('checklist-model.edit')
            ->middleware('permission:checklist-model.edit');
        Route::put('/update/{checklist_model}', [ChecklistModelController::class, 'update'])->name('checklist-model.update')
            ->middleware('permission:checklist-model.edit');
        Route::get('/show-clone/{checklist_model}', [ChecklistModelController::class, 'show_clone'])->name('checklist-model.show_clone')
        ->middleware('permission:checklist-model.clone');
        Route::post('/clone/{checklist_model}', [ChecklistModelController::class, 'clone'])->name('checklist-model.clone')
        ->middleware('permission:checklist-model.clone');
    });

    Route::prefix('element-model')->group(function () {
        Route::get('/{checklist_model}/{element_num}', [ElementModelController::class, 'index'])->name('element-model.index')
            ->middleware('permission:element-model.index');
        Route::get('/create/{checklist_model}', [ElementModelController::class, 'create'])->name('element-model.create')
            ->middleware('permission:element-model.create');
        Route::post('/store', [ElementModelController::class, 'store'])->name('element-model.store')
            ->middleware('permission:element-model.create');
        Route::delete('/destroy/{element_model}', [ElementModelController::class, 'destroy'])->name('element-model.destroy')
            ->middleware('permission:element-model.destroy');
        Route::get('/edit/{element_model}/{checklist_model}/{element_num}', [ElementModelController::class, 'edit'])->name('element-model.edit')
            ->middleware('permission:element-model.edit');
        Route::put('/update/{element_model}/{element_num}', [ElementModelController::class, 'update'])->name('element-model.update')
            ->middleware('permission:element-model.edit');
    });

    Route::prefix('checklist')->group(function () {
        Route::get('/', [ChecklistController::class, 'index'])->name('checklist.index')
            ->middleware('permission:checklist.index');
        Route::get('/create/{checklist_model}', [ChecklistController::class, 'create'])->name('checklist.create')
            ->middleware('permission:checklist.create');
        Route::post('/store', [ChecklistController::class, 'store'])->name('checklist.store')
            ->middleware('permission:checklist.create');
        Route::get('/show/{checklist}', [ChecklistController::class, 'show'])->name('checklist.show')
            ->middleware('permission:checklist.show');
        Route::get('/edit/{checklist}', [ChecklistController::class, 'edit'])->name('checklist.edit')
            ->middleware('permission:checklist.edit');
        Route::put('/update/{checklist}', [ChecklistController::class, 'update'])->name('checklist.update')
         ->middleware('permission:checklist.edit');
        // First Edit
        Route::get('/first-edit/{checklist}', [ChecklistController::class, 'first_edit'])->name('checklist.first-edit')
        ->middleware('permission:checklist.first-edit');
        Route::put('/first-update/{checklist}', [ChecklistController::class, 'first_update'])->name('checklist.first-update')
        ->middleware('permission:checklist.first-edit');
        // Second Edit
        Route::get('/second-edit/{checklist}', [ChecklistController::class, 'second_edit'])->name('checklist.second-edit')
        ->middleware('permission:checklist.second-edit');
        Route::put('/second-update/{checklist}', [ChecklistController::class, 'second_update'])->name('checklist.second-update')
        ->middleware('permission:checklist.second-edit');
        // First Verify
        Route::get('/first-verify-edit/{checklist}', [ChecklistController::class, 'first_verify_edit'])->name('checklist.first-verify-edit')
        ->middleware('permission:checklist.first-verify-edit');
        Route::put('/first-verify-update/{checklist}', [ChecklistController::class, 'first_verify_update'])->name('checklist.first-verify-update')
        ->middleware('permission:checklist.first-verify-edit');
        // Second Verify
        Route::get('/second-verify-edit/{checklist}', [ChecklistController::class, 'second_verify_edit'])->name('checklist.second-verify-edit')
        ->middleware('permission:checklist.second-verify-edit');
        Route::put('/second-verify-update/{checklist}', [ChecklistController::class, 'second_verify_update'])->name('checklist.second-verify-update')
        ->middleware('permission:checklist.second-verify-edit');
        // Interchange
        Route::get('/interchange/{checklist}', [ChecklistController::class, 'interchange'])->name('checklist.interchange')
        ->middleware('permission:checklist.interchange');
        // By Users
        Route::get('/checklist-by-users', [ChecklistController::class, 'checklist_by_users'])->name('checklist.checklist-by-users')
        ->middleware('permission:checklist.checklist-by-user');
        Route::get('/checklists-by-user/{user}', [ChecklistController::class, 'checklists_by_user'])->name('checklist.checklists-by-user')
        ->middleware('permission:checklist.checklist-by-user');
        Route::get('/checklist-by-user/{checklist}/{user}', [ChecklistController::class, 'checklist_by_user'])->name('checklist.checklist-by-user')
        ->middleware('permission:checklist.show');
        // Generate PDF
        Route::get('/pdf/{checklist}', [ChecklistController::class, 'generate_pdf'])->name('checklist.pdf')
        ->middleware('permission:checklist.pdf');
        // Expired
        Route::get('/checklist-expired', [ChecklistController::class, 'checklist_expired'])->name('checklist.expired')
        ->middleware('permission:checklist.expired');
    });


    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index')
        ->middleware('permission:user.index');
        Route::get('/create/', [UserController::class, 'create'])->name('user.create')
        ->middleware('permission:user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store')
        ->middleware('permission:user.create');
        /* Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show')
        ->middleware('permission:user.show'); */
        Route::get('/show-destroy/{user}', [UserController::class, 'show_destroy'])->name('user.show-destroy')
        ->middleware('permission:user.destroy');
        Route::put('/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy')
        ->middleware('permission:user.destroy');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit')
        ->middleware('permission:user.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('user.update')
        ->middleware('permission:user.edit');

        Route::get('/edit-password/{user}', [UserController::class, 'edit_password'])->name('user.edit-password')
        ->middleware('permission:user.edit-password');
        Route::put('/update-password/{user}', [UserController::class, 'update_password'])->name('user.update-password')
        ->middleware('permission:user.edit-password');


        Route::get('/edit-permission/{user}', [UserController::class, 'edit_permission'])->name('user.edit-permission')
        ->middleware('permission:user.edit-permission');
        Route::put('/update-permission/{user}', [UserController::class, 'update_permission'])->name('user.update-permission')
        ->middleware('permission:user.edit-permission');

        Route::get('/show-deleted-user', [UserController::class, 'show_deleted_users'])->name('user.show-deleted-user')
        ->middleware('permission:user.show-deleted-user');
    });

    Route::prefix('log')->group(function () {
        Route::get('/show', [LogController::class, 'show'])->name('log.show')
            ->middleware('permission:log.show');
        Route::match(['get', 'post'], '/generate-show', [LogController::class, 'generate_show'])->name('log.generate-show')
            ->middleware('permission:log.show');
    });

});

require __DIR__.'/auth.php';
