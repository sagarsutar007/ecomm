<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function logout() {
		$this->session->unset_userdata("id");
		$this->session->unset_userdata("api_token");
        $this->session->set_flashdata('error', 'You have successfully logged out.');
        redirect('dashboard/login');
    }

    public function login()
    {
    	$break_script = false;

    	if($this->input->method()=="post"){
    		$postdata = $this->input->post();
    		$postdata['ip_address'] = $this->getIpAddress();
    		$postdata['type'] = "web"; // should be web or app

			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => BASEAPIURL . 'login',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>json_encode($postdata),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$output = json_decode($response, true);
			if($output['status']){		

				if(isset($postdata['remember']) && $postdata['remember'] == 1){
		            set_cookie('email', $output['user']['email'],'262800');
	           	}else{
		            delete_cookie('email');
		        }

		        //check email verification 
		        if(empty($output['user']['email_verified_at'])){
		        	$this->session->set_flashdata('error', "Please verify your email before login to your dashboard.");
		        	$break_script = true;
		        } else if ($output['user']['status'] == "blocked") {
		        	$this->session->set_flashdata('error', "Your account is blocked. Please contact your Admin.");
		        	$break_script = true;
		        } else {
		        	$this->session->set_userdata( $output['user'] );
					$this->session->set_userdata( 'api_token', $output['api_token'] );
		        	redirect("dashboard");
		        }
			} else {
				$this->session->set_flashdata('error', $output['message']);
				$break_script = true;
			}
    	} else {
    		$break_script = true;
    	}

    	if($break_script){
    		if($this->session->has_userdata("id")){
    			redirect("dashboard");
    		} else {
	    		$apiArray = [
					CURLOPT_URL => BASEAPIURL . 'setup/getStoreInformation',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST => 'GET',
				];

				$curl = curl_init();
				curl_setopt_array($curl, $apiArray);
				$response = curl_exec($curl);
				curl_close($curl);
				$output = json_decode($response, true);
	    		$this->load->view('app-backend/login', $output);
    		}
    	}
    }

    public function forgotPassword()
    {
    	if($this->input->method() == "post"){
    		$postdata = $this->input->post();
    		$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => BASEAPIURL . 'authenticate/request-reset-password-link',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>json_encode($postdata),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$output = json_decode($response, true);
			if($output['status']){
				$this->session->set_flashdata('success', $output['message']);
			} else {
				$this->session->set_flashdata('error', $output['message']);
				redirect("dashboard/login");
			}
    	} 

		$apiArray = [
			CURLOPT_URL => BASEAPIURL . 'setup/getStoreInformation',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => 'GET',
		];

		$curl = curl_init();
		curl_setopt_array($curl, $apiArray);
		$response = curl_exec($curl);
		curl_close($curl);
		$output = json_decode($response, true);

		$this->load->view("app-backend/forgot-password", $output);
    }

    public function changePassword($value='')
    {
    	if($this->input->method() == "post"){
    		$postdata = $this->input->post();
    		$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => BASEAPIURL . 'authenticate/change-password',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>json_encode($postdata),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$output = json_decode($response, true);
			if($output['status']){
				$this->session->set_flashdata('success', $output['message']);
			} else {
				$this->session->set_flashdata('error', $output['message']);
			}
			redirect("dashboard/login");
    	} else {
    		$apiArray = [
				CURLOPT_URL => BASEAPIURL . 'setup/getStoreInformation',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => 'GET',
			];

			$curl = curl_init();
			curl_setopt_array($curl, $apiArray);
			$response = curl_exec($curl);
			curl_close($curl);
			$output = json_decode($response, true);

			$this->load->view("app-backend/change-password", $output);
    	}

		
    }

    function getIpAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//whether ip is from proxy
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			//whether ip is from remote address
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		return $ip_address;
	}

}

/* End of file Authentication.php */
/* Location: ./application/controllers/Authentication.php */