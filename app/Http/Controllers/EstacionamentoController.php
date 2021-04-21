<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EstacionamentoController extends Controller
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
        $estacionamentos = Estacionamento::select('estacionamentos.*', 'users.name')
            ->join('users', 'estacionamentos.fk_usuario', '=', 'users.id')
            ->orderBy('estacionamentos.id', 'desc')
            ->where('estacionamentos.fk_usuario', Auth::id())
            ->get();
        return view('estacionamento.index', ['estacionamentos' => $estacionamentos]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerenciar()
    {
        //
        $estacionamentos = Estacionamento::select('estacionamentos.*', 'users.name')
            ->join('users', 'estacionamentos.fk_usuario', '=', 'users.id')
            ->orderBy('estacionamentos.id', 'desc')
            ->get();
        return view('estacionamento.index', ['estacionamentos' => $estacionamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $usuarios = User::all();
        $dados = [];
        foreach ($usuarios as $usuario) {
            $usuario['autocomplete'] = $usuario['name'] . ' - ' . $usuario['email'];
        }
        return view('estacionamento.formulario', ['usuarios' => $usuarios]);
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
            $validator = Estacionamento::validate($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $result = Estacionamento::create($request->except('_token'));
                if ($result) {
                    \Session::flash('success', 'Estacionamento cadastrado com sucesso!');
                    return redirect()->back();
                } else {
                    \Session::flash('error', 'Erro ao cadastrar o estacionamentos');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
        } catch (\Exception $exception) {
            \Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.'. $exception->getMessage()); // . $exception->getMessage());
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
        $estacionamento = Estacionamento::find($id);
        $usuarios = User::all();

        $dados = [];
        foreach ($usuarios as $usuario) {
            $usuario['autocomplete'] = $usuario['name'] . ' - ' . $usuario['email'];
            array_push($dados, $usuario);
        }
        return view('estacionamento.formulario', ['estacionamento' => $estacionamento, 'usuarios' => $dados]);
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
            /*$validator = Estacionamento::validate($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {*/
            $estacionamento = Estacionamento::find($id);
            $result = $estacionamento->update($request->except('_token'));
            if ($result) {
                \Session::flash('success', 'Estacionamento atualizado com sucesso!');
                return redirect()->back();
            } else {
                \Session::flash('error', 'Erro ao atualizar o estacionamentos');
                return redirect()->back();
            }
            //}
        } catch (\Exception $exception) {
            \Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.');// . $exception->getMessage());
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
        try {
            $estacionamento = Estacionamento::destroy($id);
            if ($estacionamento) {
                \Session::flash('success', 'Estacionamento deletado com sucesso!');
            } else {
                \Session::flash('error', 'Erro ao deletar estacionamentos');
            }
        } catch (\Exception $exception) {
            \Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.'); // . $exception->getMessage());
        }
    }
}
