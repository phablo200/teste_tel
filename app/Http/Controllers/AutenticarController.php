<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Session, Hash, Auth;

class AutenticarController extends Controller
{

	protected $usr;
	public function __construct()
	{
		$this->middleware('auth', ["only"=> "admin"]);
		$this->usr= new Usuario();
	}

	public function entrar()
	{
		return view('login');		
	}

	public function autenticar(Request $request)
	{
		$logarUser =
           	$this->usr
            	->where("email", $request->get('email'))
    			->first();
        
		if (!is_null($logarUser)) {
			if ($logarUser && Hash::check($request->get('senha'), $logarUser->senha)) {
				$rememberToken = false;
				Auth::login($logarUser);
				return redirect()->route('admin');
			} else {
				Session::flash('message', ['msg' => 'Login ou senha incorreto', 'class' => 'alert-danger']);
				return redirect()->route('entrar');
			}
        } else {
			Session::flash('message', [
                'msg'   => 'Login incorreto',
                'class' => 'alert-danger'
            ]);
            return redirect()->route('entrar');
		}
	}

	public function sair()
	{
		Auth::logout();
		return redirect()->route('entrar');
	}

	public function admin()
	{
		return view('admin');
	}

	public function recuperarPassword()
	{

	}
}
