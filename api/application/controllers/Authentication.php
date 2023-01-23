<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthenticationModel');
		$this->load->model('UserModel');
		$this->load->model('SetupModel');

		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		if($_SERVER['REQUEST_METHOD'] == "OPTIONS") { die(); }
	}

	/*
	* Login user 
	* requires email, password in plain text or not hashed in json format
	* returns json response
	*/
	public function authenticateUser()
	{
		$data = json_decode($this->input->raw_input_stream, true);

		if(!empty($data)){
			if( ( isset($data['email']) && !empty($data['email']) ) && ( isset($data['password']) && !empty(isset($data['password']) ) ) ) {
				$userinfo = $this->UserModel->getEmailUser($data['email']);
				if(!empty($userinfo)){
					if(password_verify($data['password'], $userinfo['password'])) {
						if( $this->AuthenticationModel->fetchApiToken($userinfo['id'], $data['type']??"web") ) {
							$token = $this->AuthenticationModel->updateApiToken($userinfo['id'], $data['type']??"web", $data['ip_address']??"");
						} else {
							$token = $this->AuthenticationModel->generateApiToken($userinfo['id'], $data['type']??"web", $data['ip_address']??"");
						}
				    	http_response_code(200);
						$response = [
							"status" => true,
							"message" => "User found!",
							"user" => $this->UserModel->get($userinfo['id']),
							"api_token" => $token
						];
					} else {
						http_response_code(400);
						$response = [
							"status" => false,
							"message" => "Incorrect password!"
						];
					}
				} else {
					http_response_code(400);
					$response = [
						"status" => false,
						"message" => "This email is not registered!"
					];
				}
			} else {
				http_response_code(400);
				$response = [
					"status" => false,
					"message" => "Email and Password fields are required!"
				];
			}
		} else {
			http_response_code(400);
			$response = [
				"status" => false,
				"message" => "Couldn't process empty data!"
			];
		}

		echo json_encode($response);
	}

	/*
	* Generates reset password link and sends user an email 
	* requires email in plain text in json format
	* returns json response
	*/
	public function requestResetPasswordLink()
	{
		$data = json_decode($this->input->raw_input_stream, true);
		if(!empty($data)){
			if( isset($data['email']) && !empty($data['email']) ) {
				$userinfo = $this->UserModel->getEmailUser($data['email']);
				if($userinfo){
					$authtoken = str_shuffle(uniqid() . rand(1000000, 9999999));
					if($this->UserModel->setAuthtoken($userinfo['id'], $authtoken)){
						$store = $this->SetupModel->getStoreInformation();
						$data['url'] = base_url('authenticate/reset-password?token=') . $authtoken;
						$data['name'] = $userinfo['name'];
						$data['app'] = $store['name'];
						$data['logo'] = $store['logo'];
						$data['address'] = $store['address'] . "," . $store['city'] . "," . $store['pincode'];
						$htmlContent = $this->load->view("email/reset-password", $data, true);

						$config = [
                            "protocol" => "smtp", 
                            "smtp_host" => "", 
                            "smtp_port" => 587, 
                            "smtp_user" => "", 
                            "smtp_pass" => "", 
                            "mailtype" => "html", 
                            "charset" => "utf-8"
                        ];

                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
						$this->email->from($config["smtp_user"], $data["app"] . " Support");
						$this->email->to($data['email']);
						$this->email->subject('Here is your password reset link!');
						$this->email->message($htmlContent);
						if($this->email->send()){
							http_response_code(200);
							$response = [
								"status" => true,
								"message" => "Please check your inbox for reset password link!"
							];
						} else {
							// echo $this->email->print_debugger();
							http_response_code(400);
							$response = [
								"status" => false,
								"message" => "Something went wrong!"
							];
						}
					} else {
						http_response_code(400);
						$response = [
							"status" => false,
							"message" => "Token generation failed!"
						];
					}
				} else {
					http_response_code(400);
					$response = [
						"status" => false,
						"message" => "This email is not registered with us!"
					];
				}
			} else {
				http_response_code(400);
				$response = [
					"status" => false,
					"message" => "A valid Email is required!"
				];
			}
		} else {
			http_response_code(400);
			$response = [
				"status" => false,
				"message" => "Couldn't process empty data!"
			];
		}
		echo json_encode($response);
	}

	/*
	* Chnage password and send email notification to user 
	* requires new password and authtoken in plain text in json format
	* returns json response
	*/
	public function changePassword()
	{
		$data = json_decode($this->input->raw_input_stream, true);
		if(!empty($data)){
			if( (isset($data['password']) && !empty($data['password'])) && (isset($data['authtoken']) && !empty($data['authtoken'])) ) {
				$userinfo = $this->UserModel->getAuthUser($data['authtoken']);
				if($userinfo){
					if($this->UserModel->changeAuthtokenPassword($data['password'], $authtoken)){
						$this->UserModel->removeAuthtoken($authtoken);
						$store = $this->SetupModel->getStoreInformation();
						$data['url'] = base_url('authenticate/reset-password?token=') . $authtoken;
						$data['name'] = $userinfo['name'];
						$data['app'] = $store['name'];
						$data['logo'] = $store['logo'];
						$data['address'] = $store['address'] . "," . $store['city'] . "," . $store['pincode'];
						$htmlContent = $this->load->view("email/changed-password", $data, true);

						$config = [
                            "protocol" => "smtp", 
                            "smtp_host" => "", 
                            "smtp_port" => 587, 
                            "smtp_user" => "", 
                            "smtp_pass" => "", 
                            "mailtype" => "html", 
                            "charset" => "utf-8"
                        ];

                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
						$this->email->from($config["smtp_user"], $data["app"] . " Support");
						$this->email->to($data['email']);
						$this->email->subject('Your password has been changed successfully!');
						$this->email->message($htmlContent);
						if($this->email->send()){
							http_response_code(200);
							$response = [
								"status" => true,
								"message" => "Password changed successfully!"
							];
						} else {
							// echo $this->email->print_debugger();
							http_response_code(400);
							$response = [
								"status" => false,
								"message" => "Something went wrong!"
							];
						}
					} else {
						http_response_code(400);
						$response = [
							"status" => false,
							"message" => "Changing of password failed!"
						];
					}
				} else {
					http_response_code(400);
					$response = [
						"status" => false,
						"message" => "This authtoken is not valid!"
					];
				}
			} else {
				http_response_code(400);
				$response = [
					"status" => false,
					"message" => "A valid password and authtoken are required!"
				];
			}
		} else {
			http_response_code(400);
			$response = [
				"status" => false,
				"message" => "Couldn't process empty data!"
			];
		}
		echo json_encode($response);
	}

}

/* End of file Authentication.php */
/* Location: ./application/controllers/Authentication.php */