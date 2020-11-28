<?php 

    class Admin extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("app_model");
        }

        public function index(){
            if($this->session->userdata("is_active") == 1){
                $this->load->view("pages/dashboard");

            }else{
               $this->load->view("pages/login"); 
            }
        }

        public function validate_login_details(){
            $loginDetails = $this->input->post();

            $email = isset($loginDetails['email']) ? $loginDetails['email'] : "";
            $password = isset($loginDetails['password']) ? $loginDetails['password'] : "";

            if($this->app_model->authenticate_admin($email, $password)){
                $this->session->set_userdata([
                    "is_active" => 1,
                    "email" => $email
                ]);

                redirect('admin/index');
            }else{
                $data = array();
                $data['msg_err'] = "<b style='color:red'>INCORRECT LOGIN DETAILS ENTERED!</b><br/>";

                $this->session->set_flashdata($data);
                redirect('admin/index');
            }
        }
    }
?>