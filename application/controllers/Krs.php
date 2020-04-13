<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {
    public function index() {
        $this->load->view('welcome');
    }

    public function getkrs() {
        // $this->db->select('User.nomer_induk, User.nama, User.prodi, Krs.id_krs, Matkul.kode_matkul, Matkul.nama_matkul, Matkul.semester, Matkul.total_sks, Kelas.rombel, Dosen.namadosen, Matkul.keterangan, Kelas.ruang, Kelas.hari, Kelas.jam');
        $this->db->select('*');
        $this->db->from('Krs');
        $this->db->join('User', 'Krs.fk_user = User.id_user', 'inner');
        $this->db->join('Matkul', 'Krs.fk_matkul = Matkul.id_matkul', 'inner');
        $query['krs'] = $this->db->get()->result_array();
        echo json_encode($query);
    }


    public function getmatkul() {
        $this->db->select('Matkul.id_matkul, Kelas.id_kelas, Dosen.id_dosen, Matkul.kode_matkul, Matkul.nama_matkul, Matkul.semester, Matkul.total_sks, Kelas.rombel, Dosen.namadosen, Matkul.keterangan, Kelas.ruang, Kelas.hari, Kelas.jam');
        $this->db->from('User, Matkul, Dosen, Kelas');
        $this->db->where('Matkul.fk_dosen = Dosen.id_dosen');
        $this->db->where('Matkul.fk_kelas = Kelas.id_kelas');
        $query = $this->db->get()->result_array();
        echo json_encode($query);
    }

    /*[
        {
            "fk_user": 2,
            "fk_matkul": 1,
            "tahun": "2030"
        },
        {
            "fk_user": 2,
            "fk_matkul": 1,
            "tahun": "2040"
        }
    ] */

    public function insertkrs(){
        $data = file_get_contents("php://input");
        $temp = json_decode($data);
        foreach($temp as $t){
            $input = array();
            $input['fk_user'] = $t->fk_user;
            $input['fk_matkul'] = $t->fk_matkul;
            $input['tahun'] = $t->tahun;
            $this->db->insert('krs', $input);
        }
        echo "selesai";
    }

    public function editkrs() {
        
    }
}