<?php

class Messagemodel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function post($data){
        $this->db->insert('posts',$data);//insert new post to table posts with the data
        return true;
    }

    public function getmessages($id){
        return $this->db->get_where('posts',['user_id' => $id])->result();//we get all messages where user id is $id
    }

    public function getallmessages(){//select all users and then join with table posts on ids 
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('posts', 'users.id = posts.user_id');
        $query = $this->db->get();
        return $query->result();
    }
}