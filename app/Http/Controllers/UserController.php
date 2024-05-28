<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.users', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formLogin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
    ]);

    $messages = [
        'name.required' => 'O campo nome é obrigatório.',
        'email.required' => 'O campo email é obrigatório.',
        'email.email' => 'O formato do email é inválido.',
        'email.unique' => 'Este email já está em uso.',
        'password.required' => 'O campo senha é obrigatório.',
        
    ];

    $validator->setCustomMessages($messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = $request->only(['name', 'email', 'password', 'cpf', 'telefone']);
    $user['password'] = bcrypt($request->password);

    $user = User::create($user);
    Auth::login($user); 

    return redirect()->route('dashboard');
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