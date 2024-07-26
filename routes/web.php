<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $books = Book::latest()->take(5)->get();
    return view('home', compact('books'));
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/koleksi', function (Request $request) {
    $books = Book::query();

    if ($request->has('search')) {
        $keyword = $request->input('search');
        $books->where('title', 'like', "%$keyword%")
            ->orWhere('author', 'like', "%$keyword%")
            ->orWhere('isbn', 'like', "%$keyword%")
            ->orWhere('year', 'like', "%$keyword%");
    }

    $books = $books->paginate(10); 
    return view('koleksi', compact('books'));
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/books', BookController::class)->middleware('auth');

Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit_profile');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update_profile');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);
