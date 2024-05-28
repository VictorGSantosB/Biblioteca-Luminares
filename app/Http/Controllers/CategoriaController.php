<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $categorias = CategoriaResource::collection(Categoria::with('books')->get());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
