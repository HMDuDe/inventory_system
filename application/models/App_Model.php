<?php 

    class App_Model extends CI_Model{

        public function authenticate_admin($email, $password){
            $this->db->select('*');
            $this->db->from(tbl_users());
            $this->db->where([
                "email" => $email,
                "password" => md5($password)

            ]);

            $qresult = $this->db->get();
            $result = $qresult->row();

            if(!empty($result)){
                return true;
            }

            return false;
        }
    }
?>