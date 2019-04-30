<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public function lista() {
		return (object) [
			'nome' => 'Deividson',
			'tel' => '(31) 99460-9292'
		];
	}
}