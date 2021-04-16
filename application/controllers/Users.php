<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Users extends CI_Controller {
	
    public function index(){
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$tabla=$this->carga_tabla();
            $dato["tabla"]=$tabla;
		    $dato["content"] = "view_users";
		    $this->load->view('template/admin_template', $dato);
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				redirect (base_url().'Dashboard');
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

    private function carga_tabla(){
        $json = file_get_contents(base_url().'proyectoapi/Ctrlusers/mostrar');
        $datos = json_decode($json, true);
        
        $tabla="<table class=\"table table-bordered table-hover\" id=\"users\" width=\"100%\" cellspacing=\"0\">";
        $tabla.="<tr>
            <th>ID</th>
            <th>Nombre(s)</th>
            <th>Apellido(s)</th>
			<th>Email</th>
			<th>Contraseña</th>
			<th>Tipo</th>
        </tr>";

        foreach ($datos as $currency => $currency_data) {
            $tabla.= '<tr style="cursor:pointer">';
			$tabla.= '<td>'.$currency_data['id'].'</td>';
			$tabla.=  '<td>'.$currency_data['name'].'</td>';
            $tabla.= '<td>'.$currency_data['lastname'].'</td>';
            $tabla.=  '<td>'.$currency_data['email'].'</td>';
			$tabla.=  '<td>'.$currency_data['password'].'</td>';
			$tabla.=  '<td>'.$currency_data['type'].'</td>';
            $tabla.=  '</tr>';
        }
        $tabla.='</table>';

        return $tabla;
    }
    
    public function agregar(){
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$name=$this->input->post("name");
			$last=$this->input->post("lastname");
			$email=$this->input->post("email");
			$pass=$this->input->post("password");
			$r_pass=$this->input->post("repeatpassword");
			$type=$this->input->post("type");

			if(!empty($name) && !empty($last) && !empty($email) && !empty($pass) && !empty($r_pass) && !empty($type) && strtolower($r_pass) == strtolower($pass)){
				$pass=strtolower($pass);

				$pass_encryption = password_hash($pass, PASSWORD_DEFAULT);

				$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/guardar?name='.$name.'&lastname='.$last.'&email='.$email.'&password='.$pass_encryption.'&type='.$type);
				$datos=json_decode($json,true);

				$tabla=$this->carga_tabla();
				$dato["tabla"]=$tabla;
				$dato["msg"]="<p class='alert alert-success' style='text-align:center;'>USUARIO AGREGADO EXITOSAMENTE</p>";
				$dato["content"] = "view_users";
				$this->load->view('template/admin_template', $dato);
			}else{
				$tabla=$this->carga_tabla();
				$dato["tabla"]=$tabla;
				$dato["msg"]="<p class='alert alert-warning' style='text-align:center;'>NO DEJES CAMPOS EN BLANCO</p>";
				$dato["content"] = "view_users";
				$this->load->view('template/admin_template', $dato);
			}
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				redirect (base_url().'Dashboard');
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
	
	public function actualizar(){
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$id=$this->input->post("id");
			$name=$this->input->post("name");
			$last=$this->input->post("lastname");
			$email=$this->input->post("email");
			$pass=$this->input->post("password");
			$r_pass=$this->input->post("repeatpassword");
			$type=$this->input->post("type");

			if(!empty($id) && !empty($name) && !empty($last) && !empty($email) && empty($pass) && empty($r_pass) && !empty($type)){
				$pass="";
				
				$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/actualizar?id='.$id.'&name='.$name.'&lastname='.$last.'&email='.$email.'&password='.$pass.'&type='.$type);
				$datos=json_decode($json,true);

				$tabla=$this->carga_tabla();
				$dato["tabla"]=$tabla;
				$dato["msg"]="<p class='alert alert-info' style='text-align:center;'>DATOS ACTUALIZADOS EXITOSAMENTE</p>";
				$dato["content"] = "view_users";
				$this->load->view('template/admin_template', $dato);
			}else{
				if(!empty($id) && !empty($name) && !empty($last) && !empty($email) && !empty($pass) && !empty($r_pass) && !empty($type) && strtolower($r_pass) == strtolower($pass)){
					$pass=strtolower($pass);

					$pass_encryption = password_hash($pass, PASSWORD_DEFAULT);
					
					$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/actualizar?id='.$id.'&name='.$name.'&lastname='.$last.'&email='.$email.'&password='.$pass_encryption.'&type='.$type);
					$datos=json_decode($json,true);

					$tabla=$this->carga_tabla();
					$dato["tabla"]=$tabla;
					$dato["msg"]="<p class='alert alert-info' style='text-align:center;'>DATOS ACTUALIZADOS EXITOSAMENTE</p>";
					$dato["content"] = "view_users";
					$this->load->view('template/admin_template', $dato);
				}else{
					$tabla=$this->carga_tabla();
					$dato["tabla"]=$tabla;
					$dato["msg"]="<p class='alert alert-warning' style='text-align:center;'>INTENTALO DE NUEVO</p>";
					$dato["content"] = "view_users";
					$this->load->view('template/admin_template', $dato);
				}
			}
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				redirect (base_url().'Dashboard');
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
	
	public function eliminar(){
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "admin") {
			$id=$this->input->post("id");

			if(!empty($id)){
				$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/eliminar?id='.$id);
				$datos=json_decode($json,true);

				$tabla=$this->carga_tabla();
				$dato["tabla"]=$tabla;
				$dato["msg"]="<p class='alert alert-danger' style='text-align:center;'>USUARIO ELIMINADO EXITOSAMENTE</p>";
				$dato["content"] = "view_users";
				$this->load->view('template/admin_template', $dato);
			}else{
				$tabla=$this->carga_tabla();
				$dato["tabla"]=$tabla;
				$dato["msg"]="<p class='alert alert-warning' style='text-align:center;'>SELECCIONA PRIMERO UN USUARIO</p>";
				$dato["content"] = "view_users";
				$this->load->view('template/admin_template', $dato);
			}
		}else{
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == "user"){
				redirect (base_url().'Dashboard');
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

	public function perfil(){
		$id=$this->input->post("id");
        $name=$this->input->post("name");
        $last=$this->input->post("lastname");
		$email=$this->input->post("email");
		$pass=$this->input->post("password");
		$r_pass=$this->input->post("repeatpassword");
		
		if(!empty($id) && !empty($name) && !empty($last) && !empty($email) && empty($pass) && empty($r_pass)){
			$pass="";
				
			$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/perfil?id='.$id.'&name='.$name.'&lastname='.$last.'&email='.$email.'&password='.$pass);
			$datos=json_decode($json,true);

			$dato["msg"]="<p class='alert alert-info' style='text-align:center;'>DATOS ACTUALIZADOS EXITOSAMENTE</p>";

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

			
		}else{
			if(!empty($id) && !empty($name) && !empty($last) && !empty($email) && !empty($pass) && !empty($r_pass) && strtolower($r_pass) == strtolower($pass)){
				$pass=strtolower($pass);
				
				$pass_encryption = password_hash($pass, PASSWORD_DEFAULT);

				$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/perfil?id='.$id.'&name='.$name.'&lastname='.$last.'&email='.$email.'&password='.$pass_encryption);
				$datos=json_decode($json,true);

				$dato["msg"]="<p class='alert alert-info' style='text-align:center;'>DATOS ACTUALIZADOS EXITOSAMENTE</p>";

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
		}
		$j_son=file_get_contents(base_url().'proyectoapi/Ctrlusers/nuevos_datos_perfil?id='.$id);
		$j_datos=json_decode($j_son,true);

		if(!empty($j_datos)){
			foreach ($j_datos as $currency => $currency_data) {
				$_SESSION['id'] = $currency_data['id'];
				$_SESSION['name'] = $currency_data['name'];
				$_SESSION['lastname'] = $currency_data['lastname'];
				$_SESSION['email'] = $currency_data['email'];
				$_SESSION['password'] = $currency_data['password'];
				$_SESSION['type'] = $currency_data['type'];
			}                    
		}
	}
}