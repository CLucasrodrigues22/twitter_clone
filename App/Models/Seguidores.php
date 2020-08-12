<?php

namespace App\Models;

use MF\Model\Model;

class Seguidores extends Model { 

	private $id_usuario;
	private $id_usuario_seguindo;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	public function getAll() {
		$query = "
			select 
				id, nome, email 
			from 
				usuarios 
			where 
				nome 
			like 
				:nome and id != :id_usuario
			";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	''
	//seguir usuario
	public function seguirUsuarios($id_usuario_seguindo) {
		$query = "insert into usuarios_seguidores(id_usuario, id_usuario_seguindo)values(:id_usuario, :id_usuario_seguindo)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
		$stmt->bindValue(':id_usuario_seguindo', $this->__get('id_usuario_seguindo'));
		$stmt->execute();

		// echo '<pre>';
		// var_dump($stmt);

		return true;

	}

	//deixar de seguir usuario
	public function deixarSeguirUsuario($id_usuario_seguindo) {

		$query = "delete from usuarios_seguidores where id_usuario = :id_usuario and 
				id_usuario_seguidores = :id_usuario_seguindo";
		$stmt = $this->db->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
		$stmt->bindValue(':id_usuario_seguindo', $this->__get('id_usuario_seguindo'));
		$stmt->execute();

		echo 'deixando de seguir usuario';


	}
}