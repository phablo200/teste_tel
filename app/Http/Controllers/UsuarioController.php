<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioIstRequest;
use App\Http\Requests\UsuarioUptRequest;
use Hash, Auth, Session, Validator;


class UsuarioController extends Controller
{

	protected $usr;
    public function __construct()
    {
        $this->middleware('auth');
    	$this->usr= new Usuario();
    }

    public function index()
    {
        $usuarios=$this->usr->orderByDesc('id')->get();
        return view('usuario.index', compact('usuarios'));
    }

    public function criar()
    {
    	return view('usuario.criar');
    }

    public function salvar(UsuarioIstRequest $req)
    {       
        if ($req->senha<>$req->confirmarSenha)
        {
            Session::flash('message-inner', [
                'msg'   => 'A confirmação de senha falhou',
                'class' => 'alert-danger'
            ]);
            return redirect()->route('usuario.criar');
        }
        $ist=[];
        $ist["nome"]=$req->nome;
        $ist["email"]=$req->email;
        $ist["senha"]=Hash::make($req->senha);
        $this->usr->create($ist);

        return redirect()->route('usuario.index');
    }

    public function editar(int $id)
    {
        $usuario=$this->usr->find($id);
        return view('usuario.atualizar', compact('usuario', 'id'));
    }

    public function atualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:usuario,email,'.$id
        ], [
            'required' => 'O :attribute é necessario.',
            'unique'=> 'O :attribute deve ser único'
        ]);
        if ($validator->fails())
        {
            Session::flash('message-inner', [
                'msg'   => implode("\n", $validator->messages()->messages()["email"]),
                'class' => 'alert-danger'
            ]);
            return redirect()->route('usuario.editar', [$id]);
        } else
        {
            $upt=[];
            $upt["nome"]=$request->nome;
            $upt["email"]=$request->email;
            $error=false;
            if ($request->senha || $request->confirmarSenha)
            {
                if ($request->senha==$request->confirmarSenha)
                {
                    $upt["senha"]=Hash::make($request->senha);
                } else
                {
                    Session::flash('message-inner', [
                        'msg'   => 'A confirmação de senha falhou',
                        'class' => 'alert-danger'
                    ]);
                    return redirect()->route('usuario.editar', [$id]);
                }
            }
            $this->usr->find($id)->update($upt);
            return redirect()->route('usuario.index');
        }
    }

    public function excluir ($id)
    {
        $this->usr->find($id)->delete();
        return redirect()->route('usuario.index');
    }
}
