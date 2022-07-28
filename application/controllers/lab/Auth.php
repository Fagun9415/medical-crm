<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth  extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function login()
	{	
		$this->load->view('backend/lab/login');
	}

	public function save_user()
	{  
   		$name = $_POST['full_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$pincode = $_POST['pincode'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$labPhoneCode1 = $_POST['phoneNo_phoneCode'];
		$labPhoneNo1 = $_POST['phoneNo'];
		$labPhoneCode2 = $_POST['phoneNo1_phoneCode'];
		$labPhoneNo2 = $_POST['phoneNo1'];
		$labRegistrationNo = $_POST['labRegistrationNo'];
		$file = new CURLFile($_FILES['file']['tmp_name'],$_FILES['file']['type'],$_FILES['file']['name']);


		$data_value = array(
		'name' => $name,
		'email' => $email,
		'password' => $password,
		'address' => $address,
		'pincode' => $pincode,
		'lat' => $lat,
		'lng' => $lng,
		'labPhoneCode1' => $labPhoneCode1,
		'labPhoneNo1' => $labPhoneNo1,
		'labRegistrationNo' => $labRegistrationNo,
		'file' => $file
		);

		if ($labPhoneNo2!='') 
		{
			$data_value['labPhoneCode2'] = $labPhoneCode2;
			$data_value['labPhoneNo2'] = $labPhoneNo2;
		}
		else
		{}	



		$formdata = $data_value;


        $result = methodPost('api/lab/register', $header, $formdata);
        $result_array = json_decode($result);

        $error = $result_array->error;
        $message = $result_array->message;
        $status = $result_array->status;


        if ($status == 200) 
        {
            $data['status'] = "success";
            $data['message'] = $message;
        } else {
            $data['status'] = "unsuccess";
            $data['message'] = $message;
        }
        echo json_encode($data);

	}

	function check_login()
    {   
        $this->form_validation->set_rules('email','Email','required');

        $this->form_validation->set_rules('password','Password','required|callback_check_database');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->login();
        }   
        else
        {   
            if ($this->session->userdata('logged_in_lab')) 
            {
                redirect('lab/Dashboard','refresh');
            }
            else{
                $this->load->view('lab/Auth/login');
            }
        }
    }

    function check_database()
    {
        $email = $this->input->post('email');
        $password =$this->input->post('password');

        $parameters = array('email' => $email,"password" => $password,'loginType' => 'lab');
        $json_param = json_encode($parameters);
        $header = array("content-type: application/json");
        $result = methodPost("api/auth/login",$header,$json_param);
        
        $result_array = json_decode($result);
        
        $status = $result_array->status;
        $message = $result_array->message;


        if ($status==200) 
        {
            $token = $result_array->accessToken;
              
            $result1 = methodGet("api/lab/profile",$token);
            $result_array1 = json_decode($result1);
            $clientdata = $result_array1->user;

            $sess_array = array(
                    'token' => $token,
                    'profile' => $clientdata
                );

            $this->session->set_userdata('logged_in_lab', $sess_array);
            
            return true;    
        }
        else
        {
            $this->form_validation->set_message('check_database', '<p style="color:red;">'.$message.'</p>');
            return false;
        }
    }

    function edit_profile()
    {
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $user = $this->session->userdata('logged_in_lab')['profile'];
            
            $data['user'] = $user;
            $this->load->view('backend/lab/template/header');
            $this->load->view('backend/lab/template/edit_profile',$data);
            $this->load->view('backend/lab/template/footer');
        } 
        else 
        {
            redirect('lab/Auth/logout', 'refresh');
        }
    }

    function edit_save_profile()
    {
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];
            $name = $_POST['name'];
            $pincode = $_POST['pincode'];
            $labPhoneNo1 = $_POST['phoneNo'];
            $labPhoneCode1 = !empty($_POST['phoneNo_phoneCode']) ? $_POST['phoneNo_phoneCode'] : $_POST['countrycode'];
            $paddress = !empty($_POST['paddress']) ? $_POST['paddress'] : $_POST['address'];
            $latitude = !empty($_POST['lat']) ? $_POST['lat'] : $_POST['lat1'];
            $longitude = !empty($_POST['lng']) ? $_POST['lng'] : $_POST['lng1'];
            $labPhoneNo2 = $_POST['phoneNo1'];
            $labPhoneCode2 = !empty($_POST['phoneNo1_phoneCode']) ? $_POST['phoneNo1_phoneCode'] : $_POST['countrycode1'];

            $data_value = array(
            'name' => $name,
            'address' => $paddress,
            'pincode' => $pincode,
            'lat' => $latitude,
            'lng' => $longitude,
            'labPhoneCode1' => $labPhoneCode1,
            'labPhoneNo1' => $labPhoneNo1,
            'labPhoneCode2' => $labPhoneCode2,
            'labPhoneNo2' => $labPhoneNo2
            );

            $formdata = json_encode($data_value);
            

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPatch('api/lab/editProfile', $header, $formdata);
            $result_array = json_decode($result);

            $error = $result_array->error;
            $message = $result_array->message;
            $status = $result_array->status;


            if ($status == 200) 
            {

                $result1 = methodGet("api/lab/profile",$token);
                $result_array1 = json_decode($result1);
                $clientdata = $result_array1->user;
 
                $sess_array = array(
                        'token' => $token,
                        'profile' => $clientdata
                    );

                $this->session->set_userdata('logged_in_lab', $sess_array);

                $data['status'] = "success";
                $data['message'] = $message;
            } 
            else 
            {
                $data['status'] = "unsuccess";
                $data['message'] = $message;
            }
            echo json_encode($data);
        } 
        else 
        {
            redirect('lab/Auth/logout', 'refresh');
        }
    }

    function change_password()
    {
        if ($this->session->userdata('logged_in_lab')) 
        {   
            $token = $this->session->userdata('logged_in_lab')['token'];
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $data_value = array(
            'oldPassword' => $oldPassword,
            'newPassword' => $newPassword,
            'confirmPassword' => $confirmPassword
            );

            $formdata = json_encode($data_value);

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPatch('api/auth/login/changePasswordProfile', $header, $formdata);
            $result_array = json_decode($result);
            $error = $result_array->error;
            $message = $result_array->message;
            $status = $result_array->status;


            if ($status == 200) 
            {
                $data['status'] = "success";
                $data['message'] = $message;
            } 
            else 
            {
                $data['status'] = "unsuccess";
                $data['message'] = $message;
            }
            echo json_encode($data);


            
        } 
        else 
        {
            redirect('lab/Auth/logout', 'refresh');
        }
    }   


    function logout()
    {
        $this->session->unset_userdata('logged_in_lab');
        redirect('lab/Auth/login','refresh');
    }

	public function forgot_password()
	{	
		$this->load->view('backend/lab/forgot_password');
	}

    public function forgot_password_verify()
    {  

        $email = $_POST['email'];
        $loginType = $_POST['loginType'];

        $data_value = array(
        'email' => $email,
        'loginType' => $loginType
        );

        $formdata = json_encode($data_value);

        $header = ["authorization: Bearer " . $token, "content-type: application/json"];

        $result = methodPost('api/auth/login/forgotpassword', $header, $formdata);
        $result_array = json_decode($result);

        $error = $result_array->error;
        $message = $result_array->message;
        $status = $result_array->status;

        if ($status == 404) {
            $data['status'] = "unsuccess";
            $data['message'] = $message;
        } else {
            $data['status'] = "success";
            $data['message'] = "Forgot Password email is sent to your id".$email;
        }
        echo json_encode($data);

    }

	public function register()
	{	
		$this->load->view('backend/lab/register');
	}
}