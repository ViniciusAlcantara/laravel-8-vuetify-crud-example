<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use App\Models\Unidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UnidadesController extends Controller
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
        $unidades = Unidades::select('unidades.*', 'estacionamentos.nome', 'users.name')
            ->join('estacionamentos', 'unidades.fk_estacionamento', '=', 'estacionamentos.id')
            ->join('users', 'estacionamentos.fk_usuario', '=', 'users.id')
            ->orderBy('unidades.id', 'desc')
            ->where('estacionamentos.fk_usuario', Auth::id())
            ->get();
        return view('unidades.index', ['unidades' => $unidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estacionamento = Estacionamento::select('estacionamentos.*', 'users.name')
            ->join('users', 'estacionamentos.fk_usuario', '=', 'users.id')
            ->orderBy('estacionamentos.id', 'desc')
            ->where('estacionamentos.fk_usuario', Auth::id())
            ->get();
        return view('unidades.formulario', ['lista_estacionamentos' => $estacionamento]);
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
            $validator = Unidades::validate($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $verifyUnidade = Unidades::where("fk_estacionamento", $request->get('fk_estacionamento'))->where("numero_unidade", $request->get('numero_unidade'))->first();

                if ($verifyUnidade) {
                    Session::flash('error', 'Já existe uma unidade cadastrada com este número neste estacionamento'); // . $exception->getMessage());
                    return redirect()->back();
                }

                $result = Unidades::create($request->except('_token'));
                if ($result) {
                    Session::flash('success', 'Unidade cadastrada com sucesso!');
                    return redirect('unidades');
                } else {
                    Session::flash('error', 'Erro ao cadastrar a unidade');
                    return redirect()->back();
                }
            }
        } catch (\Exception $exception) {
            Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte.'); // . $exception->getMessage());
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
        $unidades = Unidades::find($id);
        $estacionamento = Estacionamento::select('estacionamentos.*', 'users.name')
            ->join('users', 'estacionamentos.fk_usuario', '=', 'users.id')
            ->orderBy('estacionamentos.id', 'desc')
            ->where('estacionamentos.fk_usuario', Auth::id())
            ->get();
        return view('unidades.formulario', ['unidade' => $unidades, 'lista_estacionamentos' => $estacionamento]);
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
            $validator = Unidades::validate($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $unidades = Unidades::find($id);
                $verifyUnidade = Unidades::where("fk_estacionamento", $request->get('fk_estacionamento'))
                    ->where("numero_unidade", $request->get('numero_unidade'))
                    ->where("id", "!=", $id)
                    ->first();

                if ($verifyUnidade) {
                    Session::flash('error', 'Já existe uma unidade cadastrada com este número neste estacionamento'); // . $exception->getMessage());
                    return redirect()->back();
                }
                $result = $unidades->update($request->except('_token'));
                if ($result) {
                    Session::flash('success', 'Unidade atualizada com sucesso!');
                    return redirect('unidades');
                } else {
                    Session::flash('error', 'Erro ao atualizar a unidade');
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
        } catch (\Exception $exception) {
            Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte. ' . $exception->getMessage());
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
            $unidade = Unidades::destroy($id);
            if ($unidade) {
                Session::flash('success', 'Unidade deletada com sucesso!');
            } else {
                Session::flash('error', 'Erro ao deletar unidade');
            }
        } catch (\Exception $exception) {
            Session::flash('error', 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte. '); // . $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletaMultiplos(Request $request)
    {
        //
        try {
            $unidade = Unidades::destroy($request->get('ids'));
            if ($unidade) {
                return response()->json([
                    'success' => true,
                    'unidade' => $unidade
                ]);
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte. ', // . $exception->getMessage(),
            ]);
        }
    }

    public function verificarUnidade(Request $request) {
        try {
            $result = Unidades::where('email_morador', $request->get('email'))
                ->where('fk_estacionamento', $request->get('fk_estacionamento'))
                ->first();

            if ($result) {
                return response()->json([
                    'success' => true,
                    'unidade' => $result
                ]);
            }
            return response()->json([
                'success' => false,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Um erro ocorreu ao realizar a operação! Por favor, contate o suporte. ', // . $exception->getMessage(),
            ]);
        }
    }

    public function importar() {
        $estacionamento = Estacionamento::select('estacionamento.*', 'users.name')
            ->join('users', 'estacionamento.fk_usuario', '=', 'users.id')
            ->orderBy('estacionamento.id', 'desc')
            ->where('estacionamento.fk_usuario', Auth::id())
            ->get();
        return view('unidades.importar', ['lista_estacionamentos' => $estacionamento]);
    }

    public function unidadesEstacionamento($idEstacionamento) {
        $unidades = Unidades::select('unidades.*', 'estacionamentos.nome', 'users.name')
            ->join('estacionamentos', 'unidades.fk_estacionamento', '=', 'estacionamentos.id')
            ->join('users', 'estacionamentos.fk_usuario', '=', 'users.id')
            ->orderBy('unidades.id', 'desc')
            ->where('estacionamentos.id', $idEstacionamento)
            ->get();
        return view('unidades.index', ['unidades' => $unidades]);
    }
}
