<?php
class Modelusers extends CI_Model {

    public function _construct(){
        parent::_construct();
    }

	public function guardar($name, $last, $email, $pass, $type)
	{
        $data = array(
            'name' =>  $name,
            'lastname' => $last,
            'email' => $email,
            'password' => $pass,
            'type' => $type
        );
        $this->db->insert('users', $data);
    }

    public function mostrar()
    {
        $this->db->select('id, name, lastname, email, password, type');
        $this->db->from('users');
        $this->db->order_by('id', 'asc');
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }

    public function eliminar($id)
	{
        $this->db->delete('users', array('id'=>$id));
    }

    public function actualizar($id, $name, $last, $email, $pass, $type)
    {
        if(empty($pass)){
            $data = array(
                'name' =>  $name,
                'lastname' => $last,
                'email' => $email,
                'type' => $type
            );
            $this->db->where('id', $id);
            $this->db->update('users', $data);
        }else{
            if(!empty($pass)){
                $data = array(
                    'name' =>  $name,
                    'lastname' => $last,
                    'email' => $email,
                    'password' => $pass,
                    'type' => $type
                );
                $this->db->where('id', $id);
                $this->db->update('users', $data);
            }
        }
    }

    public function loguear($email)
    {
        $this->db->select('id, name, lastname, email, password, type');
        $this->db->from('users');
        $this->db->where('email', $email);
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }

    public function perfil($id, $name, $last, $email, $pass)
    {
        if(empty($pass)){
            $data = array(
            'name' =>  $name,
            'lastname' => $last,
            'email' => $email,
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        }else{
            if(!empty($pass)){
                $data = array(
                    'name' =>  $name,
                    'lastname' => $last,
                    'email' => $email,
                    'password' => $pass,
                );
                $this->db->where('id', $id);
                $this->db->update('users', $data);
            }
        }
    }

    public function nuevos_datos_perfil($id)
    {
        $this->db->select('id, name, lastname, email, password, type');
        $this->db->from('users');
        $this->db->where('id', $id);
        $consulta=$this->db->get();
        $resultado=$consulta->result();
        return $resultado;
    }

    public function activar($email, $type)
    {
        if(!empty($email)){
            $data = array(
                'type' => $type
            );
            $this->db->where('email', $email);
            $this->db->update('users', $data);
        }
    }

    public function recuperar($email, $pass)
    {
        if(!empty($email) && !empty($pass)){
            $data = array(
                'password' => $pass
            );
            $this->db->where('email', $email);
            $this->db->update('users', $data);
        }
    }
}
?>