<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {
    public function index() {
        $this->load->view('welcome');
    }

    public function getkrs() {
        $this->db->select('*');
        $this->db->from('Krs');
        $this->db->join('User', 'Krs.fk_user = User.id_user', 'inner');
        $this->db->join('Matkul', 'Krs.fk_matkul = Matkul.id_matkul', 'inner');
        $query = $this->db->get()->result_array();
        echo json_encode($query);
    }
}