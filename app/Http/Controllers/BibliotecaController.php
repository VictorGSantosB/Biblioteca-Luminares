<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BibliotecaController extends Controller
{
    public function index()
    {
        $books = Book::all();
       
        return view('welcome', [
            'books' => $books,
            
        ]);
    }

    public function create()
    {
       if(Auth::id() === 1){
        $categorias = Categoria::all();
        return view('book.form', [
            'categorias' => $categorias
        ]);
       }else{
        return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
       }
    }

    public function edit($id)
    {
        if (Auth::id() === 1) {
            $book = Book::find($id);
            return view('book.formUpdate', [
                'book' => $book
            ]);
        }else{
            return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
        }
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nome' => 'required|string|max:255',
        'isbn' => 'required|numeric',
        'author' => 'required|string|max:32',
        'descricao' => 'required|string|max:255',
        'user_id' => 'required|numeric',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'categoria_id' => 'required|numeric'
    ]);

    if ($validator->fails()) {
        return redirect('/')
                    ->withErrors($validator)
                    ->withInput();
    }

    $book = new Book();

    $book->nome = $request->input('nome');
    $book->isbn = $request->input('isbn');
    $book->author = $request->input('author');
    $book->descricao = $request->input('descricao');
    $book->user_id = $request->input('user_id');
    $book->categoria_id = $request->input('categoria_id');

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
        if(Auth::id() === 1){
        $book = Book::find($id);
        $book->delete();
        return redirect()->back()->with('successDelete', 'Livro deletado com sucesso');
        }else{
            return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
        }
        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|numeric',
            'descricao' => 'required|string'
        ]);
    
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $book = Book::find($request->id);
    
        if ($book) {
            $data = $request->all();
    
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $request->image->move(public_path('img/books'), $imageName);
                $data['image'] = $imageName;
            }
    
            $book->update($data);
    
            return redirect()->route('dashboard')->with('successUpdate', 'Livro atualizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Livro não encontrado.');
        }
    }
    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            return view('book.show', [
                'book' => $book
            ]);
        }
    }


    public function categoria($id)
    {
     
            $books = Book::where('categoria_id', $id)->get();

            $categoria = Categoria::find($id);
            return view('book.categoria', [
                'books' => $books,

                'categoria' => $categoria,
            ]);

        return redirect()->route('login.form')->with('noAuth', 'Faça login para acessar todos os recursos do sistema');
    }



    public function modalDelete(Request $request)
    {   if(Auth::id() === 1){
        
        if ($request->id) {
            $id = $request->id;
            return redirect()->back()->with('delete', $id);
        }else{
            return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
        }
    }else{
        return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
    }
    }


}
