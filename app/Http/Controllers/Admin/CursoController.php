<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Curso;

class CursoController extends Controller
{
    public function index() {
			$registros = Curso::all();
			return view('admin.cursos.index', compact('registros'));
		}

		public function adicionar() {
			return view('admin.cursos.adicionar');
		}

		public function salvar(Request $req) {
			$dados = $req->all();

			if($req->hasFile('imagem')) {
				$dir = 'img/cursos/';

				$imagem = $req->file('imagem');
				$ex = $imagem->guessClientExtension();
				$num = rand(1, 10000000);
				$nome_imagem = 'imagem_' . $num . '.' . $ex;
				$imagem->move($dir, $nome_imagem);

				$dados['imagem'] = $dir . $nome_imagem;
			}

			if(!isset($dados['publicado'])) {
				$dados['publicado'] = 'nao';
			}

			Curso::create($dados);
			return redirect()->route('admin.cursos');
		}

		public function editar($id) {
			$registro = Curso::find($id);
			return view('admin.cursos.editar', compact('registro'));
		}

		public function atualizar(Request $req, $id) {
			$dados = $req->all();

      $curso = Curso::find($id);

			if($req->hasFile('imagem')) {
				$dir = 'img/cursos/';

				$imagem = $req->file('imagem');
				$ex = $imagem->guessClientExtension();
				$num = rand(1, 10000000);
				$nome_imagem = 'imagem_' . $num . '.' . $ex;
				$imagem->move($dir, $nome_imagem);

				$dados['imagem'] = $dir . $nome_imagem;

        // Apaga do disco a imagem antiga.
        @unlink(public_path() . '/' . $curso->imagem);
			}

			if(!isset($dados['publicado'])) {
				$dados['publicado'] = 'nao';
			}

			$curso->update($dados);
			return redirect()->route('admin.cursos');
		}

		public function deletar($id) {
			$curso = Curso::find($id);
			$imagem = $curso->imagem;
			$curso->delete();

      // Apaga do disco a imagem.
			@unlink(public_path() . '/' . $imagem);

			return redirect()->route('admin.cursos');
		}
}
