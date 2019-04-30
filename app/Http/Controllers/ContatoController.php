<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contato;

class ContatoController extends Controller
{
   public function index() {
	   $contatos = [
			(object)['nome' => 'Maria', 'tel' => '(31) 98888-8888'],
			(object)['nome' => 'Pedro', 'tel' => '(31) 97777-7777']
	   ];
     	   
	   return view('contato.index', compact('contatos'));
   }

   public function create(Request $req) {
	   dd($req->all());
	   return "Esse é o Criar do ContatoController";
   }

   public function edit() {
	   return "Esse é o Editar do ContatoController";
   }
}
