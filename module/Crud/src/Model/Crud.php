<?php

namespace Crud\Model;

/**
 * 
 */
class Crud
{
	
	protected $id;
	protected $nombre;
	protected $correo;
	protected $contrasena;

	public function exchangeArray($data){
		$this->id = $data['id'];
		$this->nombre = $data['nombre'];
		$this->correo = $data['correo'];
		$this->contrasena = $data['contrasena'];

	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getCorreo(){
		return $this->correo;
	}

	public function getContrasena(){
		return $this->contrasena;
	}
	public function getArrayCopy(){
		return[
		'id' => $this -> id,
		'nombre' => $this -> nombre,
		'correo' => $this -> correo,
		'contrasena' => $this -> contrasena,
		];
	}
}

?>