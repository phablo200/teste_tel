<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Helper;
use App\Http\Requests\ClienteIstRequest;
use App\Http\Requests\ClienteUptRequest;
use Auth;
use Session;
use App\Models\Telefone;

class ClienteController extends Controller
{
	use Helper;

    protected $cli;
    protected $tel;

    public function __construct()
    {
    	$this->middleware('auth');	
    	$this->cli= new Cliente();
    	$this->tel= new Telefone();
    }

    public function index()
    {
    	$clientes=$this->cli
    				->select("cliente.*", "usuario_cadastrou.nome as nome_cadastrou", "usuario_atualizou.nome as nome_atualizou")
    				->leftJoin("usuario as usuario_cadastrou", "usuario_cadastrou.id", "=", "cliente.id_usuarios_cadastrou")
    				->leftJoin("usuario as usuario_atualizou", "usuario_atualizou.id", "=", "cliente.id_usuarios_atualizou")
    				->orderBy("cliente.id", "desc")->get();
        return view('cliente.inicio', compact('clientes'));
    }

    public function criar()
    {
    	return view('cliente.criar');
    }

    public function salvar(ClienteIstRequest $req)
    {   
    	if ($req->local_nascimento=='SP')
    	{
    		if (!$req->rg)
    		{
	    		Session::flash('message-inner', [
	                'msg'   => 'O campo RG é obrigatório.',
	                'class' => 'alert-danger'
	            ]);
	    		return redirect()->route('cliente.criar');
    		}	
    	} else
    	{
    		$idade=intval(floor((strtotime(date('Y-m-d')) - strtotime($this->dataSql($req->data_nascimento))) / (60 * 60 * 24 * 365)));
    		if ($idade<18)
    		{
    			Session::flash('message-inner', [
                	'msg'   => 'O cliente deve ter mais de 18 anos, ele tem: '.$idade,
                	'class' => 'alert-danger'
	            ]);
	    		return redirect()->route('cliente.criar');	
    		}
    	}
    	$ist=[];
    	$ist["nome"]=$req->nome;
    	$ist["rg"]=$req->rg;
    	$ist["cpf"]=$req->cpf;
    	$ist["local_nascimento"]=$req->local_nascimento;
    	$ist["data_nascimento"]=$this->dataSql($req->data_nascimento);
    	$ist["data_cadastro"]=date('Y-m-d H:i:s');
    	$ist["id_usuarios_cadastrou"]=Auth::user()->id;
    	$this->cli->create($ist);
    	return redirect()->route('cliente.index');
    }

    public function editar(int $id)
    {
        $cliente=$this->cli->find($id);
        return view('cliente.atualizar', compact('cliente', 'id'));
    }

    public function atualizar(ClienteUptRequest $request, $id)
    {
    	if ($request->local_nascimento=='SP')
    	{
    		if (!$request->rg)
    		{
    			Session::flash('message-inner', [
                	'msg'   => 'O campo RG é obrigatório.',
                	'class' => 'alert-danger'
            	]);
    			return redirect()->route('cliente.criar');
    		}		
    	} else
    	{
    		$idade=intval(floor((strtotime(date('Y-m-d')) - strtotime($this->dataSql($request->data_nascimento))) / (60 * 60 * 24 * 365)));
    		if ($idade<18)
    		{
    			Session::flash('message-inner', [
                	'msg'   => 'O cliente deve ter mais de 18 anos, ele tem: '.$idade,
                	'class' => 'alert-danger'
	            ]);
	    		return redirect()->route('cliente.criar');	
    		}
    	}
    	$upt=[];
        $upt['nome']=$request->nome;
        $upt['rg']=$request->rg;
        $upt['cpf']=$request->cpf;
        $upt['local_nascimento']=$request->local_nascimento;
        $upt['data_nascimento']=$this->dataSql($request->data_nascimento);
        $upt['data_atualizacao']=date('Y-m-d H:i:s');
        $upt['id_usuarios_atualizou']=Auth::user()->id;
        $this->cli->find($id)->update($upt);
        return redirect()->route('cliente.index');
    }

    public function excluir($id)
    {
    	$this->cli->find($id)->delete($id);
    	return redirect()->route('cliente.index');
    }

    public function telefones($id_cliente)
    {
    	$cliente=$this->cli->find($id_cliente);
    	$telefones=$this->tel->where("id_cliente", $id_cliente)->get();
    	return view('cliente.telefones', compact('cliente', 'telefones'));
    }

    public function telefonesSalvar(Request $request, $id_cliente)
    {
    	$this->tel->create([
    		"id_cliente"=>$id_cliente,
    		"numero"=>$request->numero
    	]);
    	return redirect()->route('cliente.telefones', [$id_cliente]);
    }

    public function telefonesExcluir($id_cliente, $id)
    {
    	$this->tel->find($id)->delete();
    	return redirect()->route('cliente.telefones', [$id_cliente]);
    }
}
