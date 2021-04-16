<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Login extends CI_Controller {

	public function index()
	{
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			redirect (base_url().'Dashboard');
		}else{
			$dato["content"] = "view_login";
			$this->load->view('template/logreg_template', $dato);
		}
	}

	public function registrar(){
        $name=$this->input->post("name");
        $last=$this->input->post("lastname");
		$email=$this->input->post("email");
		$pass=$this->input->post("password");
		$r_pass=$this->input->post("repeatpassword");
		$type="disab";

		if(!empty($name) && !empty($last) && !empty($email) && !empty($pass) &&!empty($r_pass) && !empty($type) && strtolower($r_pass) == strtolower($pass)){
			$pass=strtolower($pass);

			$pass_encryption = password_hash($pass, PASSWORD_DEFAULT);

			$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/guardar?name='.$name.'&lastname='.$last.'&email='.$email.'&password='.$pass_encryption.'&type='.$type);
			$datos=json_decode($json,true);
			
			if(!empty($datos)){
				$activacion = 'ok';
				$hash = password_hash($activacion, PASSWORD_DEFAULT);

				$this->load->library('PHPMailer_lib');
				$mail = $this->phpmailer_lib->load();
				
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPAuth = true;
				$mail->Username = "soporte.homeweather@gmail.com";
				$mail->Password = "H0m3We@ther2021";
				$mail->setFrom('soporte.homeweather@gmail.com', 'HomeWeather');
				$mail->addAddress($email, $name." ".$last);
				$mail->Subject = 'Registro | Verificación - HOMEWEATHER';
				$mail->Body = "
								<p style='text-align:center;'>¡GRACIAS POR REGISTRARTE!</p>
								Tu cuenta ha sido creada con éxito, para concluir tu registro deberas activarla dando click en el link de abajo<br>
								=====================================<br>
								Nombre: ".$name." ".$last."<br>
								Correo: ".$email."<br>
								=====================================<br>
								<br>
								Haga click en el enlace para activar su cuenta:<br>
								".base_url()."Login/activar?email=".$email."&hash=".$hash."
								";
				$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
				$mail->IsHTML(true);

				if (!$mail->send()){
					session_destroy();
    				$dato["msg"] = "<p class='alert alert-danger' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
    				$dato["content"] = "view_register";
    				$this->load->view('template/logreg_template', $dato);
				}
				else{
					$dato["msg"] = "<p class='alert alert-success' style='text-align:center;'>Se ha enviado un correo para la activación de su cuenta, verifique su buzón de entrada</p>";
					$dato["content"] = "view_confirmacion";
					$this->load->view('template/logreg_template', $dato);;
				}
				//ENVIO DE CORREO ELECTRONICO
			}else{
				session_destroy();
				$dato["msg"] = "<p class='alert alert-danger' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
				$dato["content"] = "view_register";
				$this->load->view('template/logreg_template', $dato);
			}
		}else{
			session_destroy();
			$dato["content"] = "view_register";
			$this->load->view('template/logreg_template', $dato);
		}
    }
	
	public function loguear(){
		$email=$this->input->post("email");
		$pass=$this->input->post("password");

		if(!empty($email) && !empty($pass)){
			$pass=strtolower($pass);

			$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/loguear?email='.$email);
			$datos=json_decode($json,true);

			if(!empty($datos)){
				$_SESSION['loggedin'] = true;
				foreach ($datos as $currency => $currency_data) {
					$_SESSION['id'] = $currency_data['id'];
					$_SESSION['name'] = $currency_data['name'];
					$_SESSION['lastname'] = $currency_data['lastname'];
					$_SESSION['email'] = $currency_data['email'];
					$_SESSION['password'] = $currency_data['password'];
					$_SESSION['type'] = $currency_data['type'];
				}

				if($email == $_SESSION['email'] && password_verify($pass, $_SESSION['password'])){
					if($_SESSION['type'] == "disab"){
						session_destroy();
						$dato["msg"] = "<p class='alert alert-info' style='text-align:center;'>Su cuenta está deshabilitada</p>";
						$dato["content"] = "view_login";
						$this->load->view('template/logreg_template', $dato);
					}else{
						redirect (base_url().'Dashboard');
					}
				}else{
					session_destroy();
					$dato["msg"] = "<p class='alert alert-danger' style='text-align:center;'>Email o contraseña incorrectos</p>";
					$dato["content"] = "view_login";
					$this->load->view('template/logreg_template', $dato);
				}
			}else{
				session_destroy();
				$dato["msg"] = "<p class='alert alert-warning' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
				$dato["content"] = "view_login";
				$this->load->view('template/logreg_template', $dato);
			}
		}else{
			session_destroy();
			$dato["content"] = "view_login";
			$this->load->view('template/logreg_template', $dato);
		}
	}

	public function cerrar(){
		unset ($_SESSION['email']);
		session_destroy();
		$dato["content"] = "view_login";
		$this->load->view('template/logreg_template', $dato);
	}

	public function activar(){
		$email=$this->input->get("email");
		$hash=$this->input->get("hash");

		if(!empty($email) && !empty($hash)){
			$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/activar?email='.$email.'&hash='.$hash);
			$datos=json_decode($json,true);

			if(!empty($datos)){
				$dato["msg"] = "<p class='alert alert-success' style='text-align:center;'>Se ha activado su cuenta correctamente</p>";
				$dato["content"] = "view_confirmacion";
				$this->load->view('template/logreg_template', $dato);
			}else{
				session_destroy();
				$dato["msg"] = "<p class='alert alert-warning' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
				$dato["content"] = "view_confirmacion";
				$this->load->view('template/logreg_template', $dato);
			}
		}else{
			session_destroy();
			$dato["msg"] = "<p class='alert alert-warning' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
			$dato["content"] = "view_confirmacion";
			$this->load->view('template/logreg_template', $dato);
		}
	}

	public function formemail(){
		$dato["content"] = "view_recovery";
		$this->load->view('template/logreg_template', $dato);
	}

	public function correo(){
		$email=$this->input->post("email");

		if(!empty($email)){
			
			$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/loguear?email='.$email);
			$datos=json_decode($json,true);

			if(!empty($datos)){
				$activacion = 'yes';
				$hash = password_hash($activacion, PASSWORD_DEFAULT);

				$this->load->library('PHPMailer_lib');
				$mail = $this->phpmailer_lib->load();
				
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPAuth = true;
				$mail->Username = "soporte.homeweather@gmail.com";
				$mail->Password = "H0m3We@ther2021";
				$mail->setFrom('soporte.homeweather@gmail.com', 'HomeWeather');
				$mail->addAddress($email);
				$mail->Subject = 'Soporte | Nueva contraseña - HOMEWEATHER';
				$mail->Body = "
								<p style='text-align:center;'>¡RECUPERACIÓN DE CONTRASEÑA!</p>
								Este es un correo de confirmación para la renovación de contraseña. Sino no lo ha solicitado usted por favor contactenos al correo: soporte.homeweather@gmail.com<br>
								=====================================<br>
								Correo: ".$email."<br>
								=====================================<br>
								<br>
								Haga click en el enlace para cambiar su contraseña:<br>
								".base_url()."Login/recuperar?email=".$email."&hash=".$hash."
								";
				$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
				$mail->IsHTML(true);

				if (!$mail->send()){
					session_destroy();
    				$dato["msg"] = "<p class='alert alert-danger' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
    				$dato["content"] = "view_recovery";
					$this->load->view('template/logreg_template', $dato);
				}
				else{
					$dato["msg"] = "<p class='alert alert-success' style='text-align:center;'>Se ha enviado un correo para cambiar su contraseña, verifique su buzón de entrada</p>";
					$dato["content"] = "view_confirmacion";
					$this->load->view('template/logreg_template', $dato);;
				}

			}else{
				session_destroy();
				$dato["msg"] = "<p class='alert alert-warning' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
				$dato["content"] = "view_recovery";
				$this->load->view('template/logreg_template', $dato);
			}
		}else{
			session_destroy();
			$dato["content"] = "view_recovery";
			$this->load->view('template/logreg_template', $dato);
		}
	}

	public function recuperar(){
		$dato["content"] = "view_password";
		$this->load->view('template/logreg_template', $dato);
	}

	public function enviar(){
		$activacion = 'yes';
		$email=$this->input->post("email");
		$pass=$this->input->post("password");
		$r_pass=$this->input->post("repeatpassword");
		$hash=$this->input->post("hash");

		if(!empty($pass) &&!empty($r_pass) && strtolower($r_pass) == strtolower($pass) && password_verify($activacion, $hash)){
			$pass=strtolower($pass);

			$pass_encryption = password_hash($pass, PASSWORD_DEFAULT);

			$json=file_get_contents(base_url().'proyectoapi/Ctrlusers/recuperar?email='.$email.'&password='.$pass_encryption);
			$datos=json_decode($json,true);

			if(!empty($datos)){
				$dato["msg"] = "<p class='alert alert-success' style='text-align:center;'>Se ha cambiado su contraseña correctamente</p>";
				$dato["content"] = "view_confirmacion";
				$this->load->view('template/logreg_template', $dato);;
			}else{
				session_destroy();
				$dato["msg"] = "<p class='alert alert-warning' style='text-align:center;'>Ha ocurrido un erro, por favor vuelva a intentarlo</p>";
				$dato["content"] = "view_password";
				$this->load->view('template/logreg_template', $dato);
			}
		}else{
			session_destroy();
			$dato["msg"] = "<p class='alert alert-danger' style='text-align:center;'>Ingrese la misma contraseña ambas veces</p>";
			$dato["content"] = "view_password";
			$this->load->view('template/logreg_template', $dato);
		}
	}
}