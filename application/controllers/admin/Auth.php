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
		$this->load->view('backend/admin/login');
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
            if ($this->session->userdata('logged_in_admin')) 
            {
                redirect('admin/Dashboard','refresh');
            }
            else{
                $this->load->view('admin/Auth/login');
            }
        }
    }

    function check_database()
    {
        $email = $this->input->post('email');
        $password =$this->input->post('password');

        $parameters = array('email' => $email,"password" => $password,'loginType' => 'admin');
        $json_param = json_encode($parameters);
        $header = array("content-type: application/json");
        $result = methodPost("api/auth/login",$header,$json_param);
        
        $result_array = json_decode($result);
        
        $status = $result_array->status;
        $message = $result_array->message;


        if ($status==200) 
        {
            $token = $result_array->accessToken;
              
            $result1 = methodGet("api/admin/profile",$token);
            $result_array1 = json_decode($result1);
            $clientdata = $result_array1->user;

            $sess_array = array(
                    'token' => $token,
                    'profile' => $clientdata
                );

            $this->session->set_userdata('logged_in_admin', $sess_array);
            
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
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $user = $this->session->userdata('logged_in_admin')['profile'];
            
            $data['user'] = $user;
            $this->load->view('backend/admin/template/header');
            $this->load->view('backend/admin/template/edit_profile',$data);
            $this->load->view('backend/admin/template/footer');
        } 
        else 
        {
            redirect('admin/Auth/logout', 'refresh');
        }
    }

    function edit_save_profile()
    {
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];
            $name = $_POST['name'];
            $pincode = $_POST['pincode'];
            $adminPhoneNo1 = $_POST['phoneNo'];
            $adminPhoneCode1 = !empty($_POST['phoneNo_phoneCode']) ? $_POST['phoneNo_phoneCode'] : $_POST['countrycode'];
            $paddress = !empty($_POST['paddress']) ? $_POST['paddress'] : $_POST['address'];
            $latitude = !empty($_POST['lat']) ? $_POST['lat'] : $_POST['lat1'];
            $longitude = !empty($_POST['lng']) ? $_POST['lng'] : $_POST['lng1'];
            $adminPhoneNo2 = $_POST['phoneNo1'];
            $adminPhoneCode2 = !empty($_POST['phoneNo1_phoneCode']) ? $_POST['phoneNo1_phoneCode'] : $_POST['countrycode1'];

            $data_value = array(
            'name' => $name,
            'address' => $paddress,
            'pincode' => $pincode,
            'lat' => $latitude,
            'lng' => $longitude,
            'adminPhoneCode1' => $adminPhoneCode1,
            'adminPhoneNo1' => $adminPhoneNo1,
            'adminPhoneCode2' => $adminPhoneCode2,
            'adminPhoneNo2' => $adminPhoneNo2
            );

            $formdata = json_encode($data_value);
            

            $header = ["authorization: Bearer " . $token, "content-type: application/json"];

            $result = methodPatch('api/admin/editProfile', $header, $formdata);
            $result_array = json_decode($result);

            $error = $result_array->error;
            $message = $result_array->message;
            $status = $result_array->status;


            if ($status == 200) 
            {

                $result1 = methodGet("api/admin/profile",$token);
                $result_array1 = json_decode($result1);
                $clientdata = $result_array1->user;
 
                $sess_array = array(
                        'token' => $token,
                        'profile' => $clientdata
                    );

                $this->session->set_userdata('logged_in_admin', $sess_array);

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
            redirect('admin/Auth/logout', 'refresh');
        }
    }

    function change_password()
    {
        if ($this->session->userdata('logged_in_admin')) 
        {   
            $token = $this->session->userdata('logged_in_admin')['token'];
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
            redirect('admin/Auth/logout', 'refresh');
        }
    }   


    function logout()
    {
        $this->session->unset_userdata('logged_in_admin');
        redirect('admin/Auth/login','refresh');
    }

	
}