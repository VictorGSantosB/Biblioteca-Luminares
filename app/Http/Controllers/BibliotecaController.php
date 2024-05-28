<?php

namespace App\Http\Controllers;

use App\Http\Resources\BibliotecaResource;
use App\Models\Book;
use App\Models\Categoria;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BibliotecaController extends Controller
{
    public function index()
    {
        $books = BibliotecaResource::collection(Book::with('user')->get());
        $categorias = Categoria::all();
        return view('welcome', [
            'books' => $books,
            'categorias' => $categorias
        ]);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('book.form', [
            'categorias' => $categorias
        ]);
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
            'author' => 'required|string|max:32',
            'descricao' => 'required|string|max:255',
            'user_id' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|numeric'
        ]);

        $book = new Book();

        $book->nome = $validatedData['nome'];
        $book->isbn = $validatedData['isbn'];
        $book->author = $validatedData['author'];
        $book->descricao = $validatedData['descricao'];
        $book->user_id = $validatedData['user_id'];
        $book->categoria_id = $validatedData['categoria_id'];

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
        return redirect()->back()->with('successDelete', 'Livro deletado com sucesso');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|numeric',
            'descricao' => 'required|string'
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
    public function show($id)
    {
        $book = Book::find($id);
        if($book){
            return view('book.show', [
                'book' => $book
            ]);
        }
    }


    public function categoria($id)
    {   
        if(Auth::check()){
            $books = Book::where('categoria_id', $id)->get();
            $categorias = Categoria::all();
            $categoria = Categoria::find($id);
            return view('book.categoria', [
                'books' => $books,
                'categorias' => $categorias,
                'categoria' => $categoria,
            ]);
        }
            return redirect()->route('login.form')->with('noAuth', 'Faça login para acessar todos os recursos do sistema');
        
    }



    public function modalDelete(Request $request)
    {
        if ($request->id) {
            $id = $request->id;
            return redirect()->back()->with('delete', $id);
        }
    }

    public function modalUpdate(Request $request)
    {
        if ($request->id) {
            $id = $request->id;
            return redirect()->back()->with('updateModal', $id);
        } else {
            return redirect()->back();
        }
    }
}
