<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $categorias = Categoria::all();
        return view('categorias.categorias', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.formCategoria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // dd($request->nome);
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Categoria::create(['nome' => $request->nome]);

        
        return redirect()->back()->with('successCategoria', 'Sucesso ao cadastrar a categoria');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    if ($request->id) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $categoria = Categoria::findOrFail($request->id);

        $categoria->nome = $request->nome;

        $categoria->save();

        return redirect()->route('categoria.index')->with('succesCategoriaUpdate', 'Categoria editada com sucesso');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::id() === 1){
            $categoria = Categoria::find($id);
            $categoria->delete();
            return redirect()->back()->with('successDelete', 'Categoria deletada com sucesso');
            }else{
                return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
            }
    }


    public function modalDelete(Request $request)
    {   if(Auth::id() === 1){
        
        if ($request->id) {
            $id = $request->id;
            return redirect()->back()->with('deleteCategoria', $id);
        }else{
            return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
        }
    }else{
        return redirect()->back()->with('admInvalid', 'Você não tem permissão para acessar essa pagina');
    }
    }
}
