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

    public function getdhsbyusername($username='') {
        $this->db->select('*');
        $this->db->from('dhs');
        $this->db->join('Krs', 'dhs.fk_krs = krs.id_krs', 'inner');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');
        $this->db->where('username', $username);
        $query['dhs'] = $this->db->get()->result_array();
        echo json_encode($query);
    }

    public function getdhsbymatkul($fk_matkul='') {
        $this->db->select('*');
        $this->db->from('dhs');
        $this->db->where('fk_matkul', $fk_matkul);
        $this->db->join('krs', 'dhs.fk_krs = krs.id_krs', 'inner');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');

        $query['dhs'] = $this->db->get()->result_array();
        echo json_encode($query);
    }

    public function insertdhs() {
        $data = $file_get_content("php://input");
        $temp = json_decode($data);
        foreach($temp as $t) {
            $input = array();
            $input['id_dhs'] = $t->id_dhs;
            $input['fk_krs'] = $t->fk_krs;
            $input[]
        }
    }

    public function insertnilai($iddhs='') {
        $huruf = $_POST['huruf'];
        $huruf == "A";
        switch ($huruf) {
            case "A":
                $bobotnilai = "4.00";
                break;
            case "A-":
                $bobotnilai = "4.67";
                break;
            case "B+":
                $bobotnilai = "3.33";
                break;
            case "B":
                $bobotnilai = "3.33";
                break;
            case "B-":
                $bobotnilai = "2.67";
                break;
            case "C+":
                $bobotnilai = "2.33";
            break;
            case "C":
                $bobotnilai = "2.00";
            break;
            case "D":
                $bobotnilai = "1.00";
            break;
            case "E":
                $bobotnilai = "0.00";
            break;
            case "K":
                $bobotnilai = "0.00";
            break;
            default:
                $bobotnilai = "0.00";
        }

        $query = array('bobot_nilai' => $bobotnilai, 'huruf' => $huruf);
        $this->db->where('id_dhs', $iddhs);
        $this->db->update('dhs', $query);
    }
}