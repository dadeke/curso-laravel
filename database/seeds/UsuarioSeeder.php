<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $dados = [
        'name' => 'Deividson Damasio',
        'email' => 'deividsondamasio@yahoo.com.br',
        'password' => bcrypt('123#123')
      ];

      $user = User::where('email', '=', $dados['email']);
      if($user->count() > 0) {
        $usuario = $user->first();
        $usuario->update($dados);
      }
      else {
        User::create($dados);
      }
    }
}
