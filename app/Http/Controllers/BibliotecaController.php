<?php

namespace App\Http\Controllers;

use App\Http\Resources\BibliotecaResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BibliotecaController extends Controller
{
    public function index()
    {
        $books = BibliotecaResource::collection(Book::with('user')->get());
        return view('welcome', [
            'books' => $books
        ]);
    }

    public function create()
    {   
        return view('book.form');
    }
    
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.formUpdate', [
            'book' => $book
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'isbn' => 'required|numeric',
            'author' => 'required|string|max:255',
            'user_id' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $book = new Book();

        $book->nome = $validatedData['nome'];
        $book->isbn = $validatedData['isbn'];
        $book->author = $validatedData['author'];
        $book->user_id = $validatedData['user_id'];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request->image->move(public_path('img/books'), $imageName);
            $book->image = $imageName;
        }

        $book->save();

        return redirect('/')->with('successCad', 'Livro cadastrado com sucesso!!');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->back()->with('successDelete','Livro deletado com sucesso');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:books,id',
            'nome' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all(); 

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request->image->move(public_path('img/books'), $imageName);
            $data['image'] = $imageName;
        }

        $book = Book::find($request->id);
        if ($book) {
            $book->update($data);
            return redirect()->route('dashboard')->with('successUpdate', 'Livro atualizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Livro não encontrado.');
        }
    }

    public function modalDelete(Request $request)
    {
        if($request->id){
            $id = $request->id;
            return redirect()->back()->with('delete', $id );
        }
    }
    
    public function modalUpdate(Request $request)
    {
        if($request->id){
            $id = $request->id;
            return redirect()->back()->with('updateModal', $id);
        } else {
            return redirect()->back();
        }
    }
}
