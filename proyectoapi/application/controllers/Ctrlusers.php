<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlusers extends CI_Controller {

	public function index()
	{

	}
	
	public function guardar()
	{
		$name=$this->input->get("name");
        $last=$this->input->get("lastname");
		$email=$this->input->get("email");
		$pass=$this->input->get("password");
		$type=$this->input->get("type");
		if(!empty($name) && !empty($last) && !empty($email) && !empty($pass) && !empty($type)){
			$this->load->model('Modelusers');
			$informe = $this->Modelusers->guardar($name, $last, $email, $pass, $type);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}
	
	public function mostrar()
	{
		$this->load->model('Modelusers');
		$resultado=$this->Modelusers->mostrar();
		echo json_encode($resultado);
	}

    public function eliminar()
    {
		$id=$this->input->get("id");
        if(!empty($id)){
			$this->load->model('Modelusers');
			$informe=$this->Modelusers->eliminar($id);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}

	public function actualizar()
	{
		$id=$this->input->get("id");
		$name=$this->input->get("name");
        $last=$this->input->get("lastname");
		$email=$this->input->get("email");
		$pass=$this->input->get("password");
		$type=$this->input->get("type");
		if(!empty($id) && !empty($name) && !empty($last) && !empty($email) && !empty($type)){
			$this->load->model('Modelusers');
			$informe = $this->Modelusers->actualizar($id, $name, $last, $email, $pass, $type);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}

	public function loguear()
	{
		$email=$this->input->get("email");
		if(!empty($email)){
			
			$this->load->model('Modelusers');
			$resultado=$this->Modelusers->loguear($email);
			echo json_encode($resultado);
		}else{
			echo json_encode("0");
		}
	}

	public function perfil()
	{
		$id=$this->input->get("id");
		$name=$this->input->get("name");
        $last=$this->input->get("lastname");
		$email=$this->input->get("email");
		$pass=$this->input->get("password");
		if(!empty($id) && !empty($name) && !empty($last) && !empty($email)){
			$this->load->model('Modelusers');
			$informe = $this->Modelusers->perfil($id, $name, $last, $email, $pass);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}

	public function nuevos_datos_perfil()
	{
		$id=$this->input->get("id");

		if(!empty($id)){
			$this->load->model('Modelusers');
			$resultado=$this->Modelusers->nuevos_datos_perfil($id);
			echo json_encode($resultado);
		}else{
			echo json_encode("0");
		}
	}

	public function activar()
	{
		$activacion = 'ok';
		$email=$this->input->get("email");
		$hash=$this->input->get("hash");
		$type = "user";
		
		if(!empty($email) && password_verify($activacion, $hash)){
			$this->load->model('Modelusers');
			$informe = $this->Modelusers->activar($email, $type);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}

	public function recuperar()
	{
		$email=$this->input->get("email");
		$pass=$this->input->get("password");
		if(!empty($email) && !empty($pass)){
			$this->load->model('Modelusers');
			$informe = $this->Modelusers->recuperar($email, $pass);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}
}
?>