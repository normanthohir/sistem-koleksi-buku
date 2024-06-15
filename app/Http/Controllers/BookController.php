<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('search')) {
            $keyword = $request->input('search');

            $books->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('author', 'like', "%$keyword%")
                    ->orWhere('isbn', 'like', "%$keyword%")
                    ->orWhere('year', 'like', "%$keyword%");
            });
        }

        $books = $books->paginate(6);

        return view('dashboard.books.index', compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'year' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Menyimpan gambar Cover 
        $file = $request->file('cover_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/cover_image'), $fileName);

        // Menggabungkan data request dengan path gambar yang diunggah
        $data = $request->all();
        $data['cover_image'] = $fileName;

        Book::create($data);

        return redirect('/dashboard/books')->with('success', 'Book created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {

        return view('dashboard.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'year' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Menyimpan gambar Cover baru jika diunggah
        if ($file = $request->file('cover_image')) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cover_image'), $fileName);
            // Hapus gambar lama jika ada
            if ($book->cover_image) {
                unlink(public_path('uploads/cover_image/' . $book->cover_image));
            }
            $data['cover_image'] = $fileName;
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $data['cover_image'] = $book->cover_image;
        }

        $book->update($data);

        return redirect('/dashboard/books')->with('success', 'Book updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Hapus gambar jika ada
        if ($book->cover_image) {
            $imagePath = public_path('uploads/cover_image/' . $book->cover_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $book->delete();

        return redirect('/dashboard/books')->with('success', 'Book deleted successfully.');
    }
}
