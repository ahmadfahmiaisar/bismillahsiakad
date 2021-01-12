<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs extends CI_Controller {
    public function index() {
        $this->load->view('welcome');
    }
    
    public function getkhsbyuserandsemester(){
        $username = $_POST['username'];
        $semester = $_POST['semester'];

        // $dhs = array('username' => $username, 'semester' => $semester);
        $this->db->select('*');
        $this->db->from('dhs');
        $this->db->join('krs', 'dhs.fk_krs = krs.id_krs', 'inner');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');
        $this->db->where('username', $username);
        $this->db->where('semester', $semester);

        $query['khs'] = $this->db->get()->result_array();
        echo json_encode($query, JSON_NUMERIC_CHECK);
    }
}