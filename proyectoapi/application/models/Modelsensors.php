<?php
class Modelsensors extends CI_Model {

    public function _construct(){
        parent::_construct();
    }

	public function guardar($timedate, $temp, $hum, $rain, $light)
	{
        $data = array(
            'timedate' =>  $timedate,
            'temperature' => $temp,
            'humidity' => $hum,
            'rain' => $rain,
            'light' => $light
        );
        $this->db->insert('sensors', $data);
    }

    public function mostrar()
    {
        $this->db->select('id, timedate, temperature, humidity, rain, light');
        $this->db->from('sensors');
        $this->db->order_by('id', 'asc');
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }

    public function ultimo()
    {
        $this->db->select('id, timedate, temperature, humidity, rain, light');
        $this->db->from('sensors');
        $this->db->where('id=(select max(id) from sensors)');
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }

    public function grafica_temperatura()
    {
        date_default_timezone_set('America/Mexico_City');
        $this->db->select('time(timedate) as hour, temperature');
        $this->db->from('sensors');
        $date=date("Y")."-".date("m")."-".date("d");
        $this->db->where('date(timedate)',$date);
        $this->db->order_by('id','asc');
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }

    public function grafica_humedad()
    {
        date_default_timezone_set('America/Mexico_City');
        $this->db->select('time(timedate) as hour, humidity');
        $this->db->from('sensors');
        $date=date("Y")."-".date("m")."-".date("d");
        $this->db->where('date(timedate)',$date);
        $this->db->order_by('id','asc');
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }
    
    public function grafica_luminosidad()
    {
        date_default_timezone_set('America/Mexico_City');
        $this->db->select('time(timedate) as hour, light');
        $this->db->from('sensors');
        $date=date("Y")."-".date("m")."-".date("d");
        $this->db->where('date(timedate)',$date);
        $this->db->order_by('id','asc');
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }
}
?>