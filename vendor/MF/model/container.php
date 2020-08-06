<?php

namespace MF\Model; 

use App\Connection;

class Container {

	public static function getModel($model) {

		$class = "\\App\\Models\\".ucfirst($model);
		//instância de conexão
		$conn = Connection::getDb();
		//retornar o modela solicitado já instânciado, inclusive comm a conexão estabelecida
		return new $class($conn);

	}
}