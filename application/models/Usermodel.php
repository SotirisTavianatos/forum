<?php

class Usermodel extends CI_Model{
    public $email;
    public function __construct()
    {
        parent::__construct();
    }
    public function login($useremail,$password,$type){
            $ok=0;
            $user = $this->db->get_where('users',['email' => $useremail])->row();//we get the row with the email=$useremail
            if(($user->is_admin == 0 && $type=="admin") || ($user->is_admin == 1 && $type=="customer")){//if user on wrong log in page eg customer trying to log in as admin
                $ok=1;
			}
            if($type=="customer"){
                if(!password_verify($password,$user->password)) {//if password verify fails passwrod is wrong
                    $ok=1;
                }
            }
            else{
                if($password!=$user->password && !password_verify($password,$user->password)){//admin passwrod is wrong
                    $ok=1;
                }
            }
            if($ok==0){
                $data = array('last_interactive' => date("Y-m-d"));//update last interactive
                $this->db->where('email', $useremail)->update('users', $data);
                return $user;
            }
            else
                return null;
    }

	public function registration($data){
        $this->db->insert('users',$data);
        return true;
    }

	public function update($data,$id){//update user with id=$id with data 
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return true;
    }

    public function getallcustomers(){//we get all customers using the is_admin boolean
        return $this->db->get_where('users',['is_admin' => '0'])->result();
    }

    public function delete($id){//we delete user with id=$id and his posts
        $this->db->delete('users', array('id' => $id)); 
        $this->db->delete('posts', array('user_id' => $id)); 
        return true;
    }
}