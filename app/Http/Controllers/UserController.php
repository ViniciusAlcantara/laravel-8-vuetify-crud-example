<?php

namespace App\Http\Controllers;

use App\Estacionamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = User::all();
        return view('users.index', ['usuarios' => $usuarios]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerenciar()
    {
        //
        $usuarios = User::all();
        return view('users.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = User::validate($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $request['password'] = Hash::make($request['password']);
                $result = User::create($request->except('_token'));
                if ($result) {
                    \Session::flash('success', 'Usuário cadastrado com sucesso!');
                    return redirect()->back();
                } else {
                    \Session::flash('error', 'Erro ao cadastrar novo usuário');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
        } catch (\Exception $exception) {
            \Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.'); // . $exception->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuario = User::find($id);
        return view('users.formulario', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $user = User::find($id);
            $user->name = $request->get('name');
            if ($user->save()) {
                \Session::flash('success', 'Usuário editado com sucesso!');
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.'); // . $exception->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function alteraSenha() {
        return view('users.alterarsenha');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function alterarSenha(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required | min:8 | confirmed',
            ], [
                'password.required' => 'A senha é obrigatória',
                'password.min' => 'A senha precisa ter no mínimo 8 caracteres',
                'password.confirmed' => 'A confirmação da senha precisa ser igual a senha',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.', //. $exception->getMessage(),
                    'errors' => $validator->errors()
                ]);
            }
            $user = User::find($request->get('id'));
            $user->password = Hash::make($request['password']);
            if ($user->save()) {
                return response()->json([
                    'success' => true,
                    'mensagem' => 'Senha alterada com sucesso!',
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.', //. $exception->getMessage(),
                'exception' => $e->getMessage()
            ]);
        }
    }
}
