<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlsensors extends CI_Controller {

	public function index()
	{

	}
	
	public function guardar()
	{
		date_default_timezone_set('America/Mexico_City');
		$timedate=date('y-m-d H:i:s');
        $temp=$this->input->get("temp");
		$hum=$this->input->get("hum");
		$rain=$this->input->get("rain");
		$light=$this->input->get("light");
		if(!empty($timedate) && !empty($temp) && !empty($hum) && !empty($rain) && !empty($light)){
			$this->load->model('Modelsensors');
			$informe = $this->Modelsensors->guardar($timedate, $temp, $hum, $rain, $light);
			echo json_encode("1");
		}else{
			echo json_encode("0");
		}
	}
	
	public function mostrar()
	{
		$this->load->model('Modelsensors');
		$resultado=$this->Modelsensors->mostrar();
		echo json_encode($resultado);
	}

	public function ultimo()
	{
		$this->load->model('Modelsensors');
		$resultado=$this->Modelsensors->ultimo();
		echo json_encode($resultado);
	}

	public function grafica_temperatura()
    {
        $this->load->model('Modelsensors');
		$resultado=$this->Modelsensors->grafica_temperatura();
		echo json_encode($resultado);
	}
	
	public function grafica_humedad()
    {
        $this->load->model('Modelsensors');
		$resultado=$this->Modelsensors->grafica_humedad();
		echo json_encode($resultado);
	}
	
	public function grafica_luminosidad()
    {
        $this->load->model('Modelsensors');
		$resultado=$this->Modelsensors->grafica_luminosidad();
		echo json_encode($resultado);
	}
}
?>