<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SetupModel');
		$this->load->model('UserModel');

		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		if($_SERVER['REQUEST_METHOD'] == "OPTIONS") { die(); }
	}

	public function getSetupInformation($value='')
	{
		$info = $this->SetupModel->getAdminInformation();
		if($info){
			$data['status'] = TRUE;
			$data['message'] = "Setup was successfull!";
			$data['user'] = $info;
		} else {
			$data['status'] = TRUE;
			$data['message'] = "No setup was found!";
			$data['user'] = [];
		}
		echo json_encode($data);
	}

	public function getStoreInformation($value='')
	{
		$info = $this->SetupModel->getStoreInformation();
		if($info){
			$data['status'] = TRUE;
			$data['record'] = $info;
		} else {
			$data['status'] = TRUE;
			$data['message'] = "No store was found!";
			$data['record'] = null;
		}
		echo json_encode($data);
	}

	public function createNewStore($value='')
	{	
		if(isset($_POST)){
			if(
				empty($_POST['name']) || 
				empty($_POST['email']) || 
				empty($_POST['phone']) ||
				empty($_POST['password']) ||
				empty($_POST['store_name']) ||
				empty($_POST['store_addr']) ||
				empty($_POST['store_city']) ||
				empty($_POST['store_state']) ||
				empty($_POST['store_pincode'])
			){
				http_response_code(403);
				$data['status'] = FALSE;
				$data['message'] = "In-sufficient data provided!";
			} else {
				$userdata = [
					'name' => $_POST['name'],
					'email' => $_POST['email'],
					'phone' => $_POST['phone'],
					'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
					'status' => 'active',
					'type' => 'superadmin'
				];

				$check_email = $this->UserModel->getEmailUser($_POST['email']);
				if(!$check_email){
					$last_user_id = $this->SetupModel->createStoreUser($userdata);

					if($last_user_id){
						$storedata = [
							'name' => $_POST['store_name'],
							'address' => $_POST['store_addr'],
							'city' => $_POST['store_city'],
							'state' => $_POST['store_state'],
							'pincode' => $_POST['store_pincode']
						];

						if(!empty($_FILES['store_logo']['name'])){
                    		$config['upload_path'] = '../assets/web/images/brand-logo/';
                    		$config['allowed_types'] = 'gif|jpg|png|jpeg';
                    		$config['encrypt_name'] = TRUE;

		                    $this->load->library('upload', $config);
		                    $this->upload->initialize($config);

	                    	if ($this->upload->do_upload('store_logo')){
	                            $storedata['logo'] = $this->upload->data('file_name');
	                        } else {
	                        	print_r($this->upload->display_errors());
	                        }
                        }
                        
						$last_store_id = $this->SetupModel->createStore($storedata);

						if($last_store_id){
							http_response_code(200);
							$data['status'] = TRUE;
							$data['message'] = "Store setup is completed!";
						} else {
							http_response_code(403);
							$data['status'] = FALSE;
							$data['message'] = "Store not created!";
						}
					} else {
						http_response_code(403);
						$data['status'] = FALSE;
						$data['message'] = "User not created!";
					}
				} else {
					http_response_code(403);
					$data['status'] = FALSE;
					$data['message'] = "Email already exists!";
				}
			}
		} else {
			http_response_code(403);
			$data['status'] = FALSE;
			$data['message'] = "No data provided!";
		}

		echo json_encode($data);
	}

}

/* End of file Setup.php */
/* Location: ./application/controllers/Setup.php */