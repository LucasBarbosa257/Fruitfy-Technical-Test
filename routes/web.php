<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

Route::get('/', function() {
    return redirect()->route('contacts.index');
});

Route::prefix('/contacts')->middleware(['web'])->group(function () {
    Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');
    Route::get('/create', [ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/', [ContactsController::class, 'store'])->name('contacts.store');
    Route::get('/{id}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
    Route::put('/{id}', [ContactsController::class, 'update'])->name('contacts.update');
    Route::delete('/{id}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
});

