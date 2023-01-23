<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$run = FALSE;
		if($this->input->method() == "post"){
			$this->load->library('form_validation');

			$config = array(
		        array(
		                'field' => 'name',
		                'label' => 'Name',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'trim|required|min_length[8]|max_length[16]',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'passconf',
		                'label' => 'Password Confirmation',
		                'rules' => 'trim|required|matches[password]'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'trim|required|valid_email'
		        ),
		        array(
		                'field' => 'phone',
		                'label' => 'Phone',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'store_name',
		                'label' => 'Store name',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'store_addr',
		                'label' => 'Store address',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'store_city',
		                'label' => 'Store city',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'store_state',
		                'label' => 'Store state',
		                'rules' => 'trim|required'
		        ),
		        array(
		                'field' => 'store_pincode',
		                'label' => 'Store pincode',
		                'rules' => 'trim|required'
		        ),
		        'error_prefix' => '<div class="text-danger">',
		        'error_suffix' => '</div>'
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run()){
				$post = $this->input->post();
				$curl = curl_init();

				if (isset($_FILES) && !empty($_FILES['store_logo']['name'])) {
					$post['store_logo'] = new CurlFile($_FILES['store_logo']['tmp_name'], $_FILES['store_logo']['type'], $_FILES['store_logo']['name']);
				}

				curl_setopt_array($curl, array(
				  CURLOPT_URL => BASEAPIURL . 'setup/createNewStore',
				  CURLOPT_RETURNTRANSFER => TRUE,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS => $post,
				));

				$response = curl_exec($curl);
				curl_close($curl);
				$response_array = json_decode($response, TRUE);

				if($response_array['status']){
					redirect('setup/complete');
				} else {
					redirect('setup/incomplete');
				}
			} else {
				$run = TRUE;
			}
		} else {
			$run = TRUE;
		}

		if($run){
			$apiArray = [
				CURLOPT_URL => BASEAPIURL . 'setup/getSetupInformation',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => 'GET',
			];

			$curl = curl_init();
			curl_setopt_array($curl, $apiArray);
			$response = curl_exec($curl);
			curl_close($curl);
			$output = json_decode($response, true);
			$this->load->view('setup/start-setup', $output);
		}		
	}

	public function complete()
	{
		$this->load->view('setup/setup-complete');
	}

	public function incomplete()
	{
		$this->load->view('setup/setup-incomplete');
	}

}

/* End of file Setup.php */
/* Location: ./application/controllers/Setup.php */