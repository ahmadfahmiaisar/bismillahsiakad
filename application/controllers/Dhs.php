<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dhs extends CI_Controller {
    public function index() {
       $this->load->view('welcome');
    }

    public function getdhs() {
        $this->db->select('*');
        $this->db->from('dhs');
        $this->db->join('krs', 'dhs.fk_krs = krs.id_krs', 'inner');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');
        $query['dhs'] = $this->db->get()->result_array();
        echo json_encode($query);
    }

    public function getdhsbyid($iduser='') {
        $this->db->select('*');
        $this->db->from('dhs');
        $this->db->where('fk_user', $iduser);
        $this->db->join('Krs', 'dhs.fk_krs = krs.id_krs', 'inner');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');
        $query['dhs'] = $this->db->get()->result_array();
        echo json_encode($query);
    }

    
}