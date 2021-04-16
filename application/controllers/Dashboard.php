<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Dashboard extends CI_Controller {

	public function index()	{
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$img=$this->carga_img();
        	$dato["img"]=$img;
			$dato["content"] = "view_dashboard";
			$this->load->view('template/admin_template', $dato);
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				$img=$this->carga_img();
        		$dato["img"]=$img;
				$dato["content"] = "view_dashboard";
				$this->load->view('template/master_template', $dato);
			}else{
				if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "disab"){
					session_destroy();
					redirect (base_url().'Login');
				}else{
					session_destroy();
					redirect (base_url().'Login');
				}
			}
		}
	}

	public function perfil()
	{
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$dato["content"] = "view_profile";
			$this->load->view('template/admin_template', $dato);
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				$dato["content"] = "view_profile";
				$this->load->view('template/master_template', $dato);
			}else{
				if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "disab"){
					session_destroy();
					redirect (base_url().'Login');
				}else{
					session_destroy();
					redirect (base_url().'Login');
				}
			}
		}
	}

	public function graficas()
	{
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$dato["content"] = "view_charts";
			$this->load->view('template/admin_template', $dato);
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				$dato["content"] = "view_charts";
				$this->load->view('template/master_template', $dato);
			}else{
				if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "disab"){
					session_destroy();
					redirect (base_url().'Login');
				}else{
					session_destroy();
					redirect (base_url().'Login');
				}
			}
		}
	}

	private function carga_img(){
        $json = file_get_contents(base_url().'proyectoapi/Ctrlsensors/mostrar');
		$datos = json_decode($json, true);
		
        foreach ($datos as $currency => $currency_data) {
			$id = $currency_data['id'];
			$timed = $currency_data['timedate'];
            $temp = $currency_data['temperature'];
            $hum = $currency_data['humidity'];
			$rain = $currency_data['rain'];
			$light = $currency_data['light'];
		}
		
        $img="<div class=\"form-group col-md-4\" style=\"text-align: center;\">";

		//noche
		if($light > 0 && $light <= 100){
			$img.= "<img src=\"".base_url()."assets/img/noche.png\" width=\"50%\" style=\"width:45%;display:block;margin:0 auto\">
			<h4>Noche</h4></div>";
		}else{
			//dia
			if($light > 100 && $light <= (pow(10, 6))){
				$img.= "<img src=\"".base_url()."assets/img/dia.png\" width=\"50%\" style=\"width:45%;display:block;margin:0 auto\">
				<h4>Día</h4></div>";
			}
		}
		$img.= "<div class=\"form-group col-md-4\" style=\"text-align: center;\">";
		//lluvia intensa
		if($rain < 300){
			$img.= "<img src=\"".base_url()."assets/img/intensa.png\" width=\"50%\" style=\"width:45%;display:block;margin:0 auto\">
			<h4>Lluvia intensa</h4></div>";
		}else{
			//lluvia moderada
			if($rain < 550){
				$img.= "<img src=\"".base_url()."assets/img/moderada.png\" width=\"50%\" style=\"width:45%;display:block;margin:0 auto\">
				<h4>Lluvia moderada</h4></div>";
			}else{
				//lluvia leve
			  	if($rain < 800){
					$img.= "<img src=\"".base_url()."assets/img/leve.png\" width=\"50%\" style=\"width:45%;display:block;margin:0 auto\">
					<h4>Lluvia leve</h4></div>";
				}else{
					//no hay lluvia
					$img.= "<img src=\"".base_url()."assets/img/nolluvia.png\" width=\"50%\" style=\"width:45%;display:block;margin:0 auto\">
					<h4>No llueve</h4></div>";
				}
			}
		}
        return $img;
	}
}
