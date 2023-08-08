<?php


Route::middleware('auth', 'is_admin')->prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
      })->name('admin.dashboard.index');
 });