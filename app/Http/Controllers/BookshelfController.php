<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookshelfController extends Controller
{
    public function index() {
        $bookshelves = Bookshelf::all();
        return view('bookshelf.index', compact('bookshelves'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5', // Tambahkan validasi untuk code
        ]);

        Bookshelf::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->back()->with('success', 'Rak berhasil ditambah');
    }

    public function update(Request $request, Bookshelf $bookshelf) {
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10',
    ]);

    $bookshelf->update($request->all());
    return redirect()->back()->with('success', 'Rak berhasil diupdate');
    }

    public function destroy(Bookshelf $bookshelf) {
        $bookshelf->delete();
        return redirect()->back()->with('success', 'Rak dihapus');
    }
}

