<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function index() {
       $this->load->view('welcome');
    }

    public function getuser(){
        $getuser = $this->db->get('user')->result_array();
        $output['pesan'] = "data semua user";
        $output['user'] = $getuser;
        echo json_encode($output);
    }

    public function getuserbyid($id=''){
        $this->db->where('id_user', $id);
        $getuserbyid = $this->db->get('user')->row_array();
        echo json_encode($getuserbyid);
    }

    public function edituser(){
        
    }

    //tidak ada adduser karena android hanya get dan edit saja, sifat itu hanya ada di web admin
    /* public function adduser(){
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $roles = $_POST['roles'];
        $prodi = $_POST['prodi'];
        $photo = $_FILES['photo']['name'];

        $tmpname = $_FILES['photo']['tmp_name'];
        $target_dir = "public/pict/";
        move_uploaded_file($tmpname, $target_dir.$photo);
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        echo "data user and photo ". basename($_FILES["photo"]["name"]). " sukses ditambahkan";

        $adduser = array('nama' => $nama, 'nim' => $nim, 'email' => $email, 'password' => $password, 'roles'=> $roles, 'prodi' => $prodi, 'photo' => $photo);
        $this->db->insert('user', $adduser);
    } */
}