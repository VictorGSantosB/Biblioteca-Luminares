<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BibliotecaController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('welcome', [
            'books' => $books
        ]);
    }

    public function form(){
        return view('cad');
    }

    public function store(Request $request){
       $book = $request->all();

       $book = Book::create($book);

       return redirect()->route('dashboard');
    }
}