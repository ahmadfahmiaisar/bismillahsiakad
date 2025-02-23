<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {
    public function index() {
        $this->load->view('welcome');
    }

    public function getkrs() {
        // $this->db->select('User.nomer_induk, User.nama, User.prodi, Krs.id_krs, Matkul.kode_matkul, Matkul.nama_matkul, Matkul.semester, Matkul.total_sks, Kelas.rombel, Dosen.namadosen, Matkul.keterangan, Kelas.ruang, Kelas.hari, Kelas.jam');
        $this->db->select('*');
        $this->db->from('krs');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('kelas', 'matkul.fk_kelas = kelas.id_kelas', 'inner');
        $query['krs'] = $this->db->get()->result_array();
        echo json_encode($query, JSON_NUMERIC_CHECK);
    }


    public function getkrsbyusername($username='') {
        $this->db->select('*');
        $this->db->from('krs');
        $this->db->join('user', 'krs.fk_user = user.id_user', 'inner');
        $this->db->join('matkul', 'krs.fk_matkul = matkul.id_matkul', 'inner');
        $this->db->join('kelas', 'matkul.fk_kelas = kelas.id_kelas', 'inner');
        $this->db->join('dosen', 'matkul.fk_dosen = dosen.id_dosen');
        $this->db->where('username', $username);
        $query['krs'] = $this->db->get()->result_array();
        echo json_encode($query);
    }


    public function getmatkul() {
        /* $this->db->select('*');
        $this->db->from('Matkul, Dosen, Kelas');
        $this->db->where('Matkul.fk_dosen = Dosen.id_dosen');
        $this->db->where('Matkul.fk_kelas = Kelas.id_kelas'); */

        $this->db->select('*');
        $this->db->from('matkul');
        $this->db->join('kelas', 'matkul.fk_kelas = kelas.id_kelas');
        $this->db->join('dosen', 'matkul.fk_dosen = dosen.id_dosen');
        $query['matkul'] = $this->db->get()->result_array();
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
            $randomid = mt_rand(000, 999);
            $input = array();
            $input['id_krs'] = $randomid;
            $input['fk_user'] = $t->fk_user;
            $input['fk_matkul'] = $t->fk_matkul;
            $input['tahun'] = $t->tahun;

            $inputs = array();
            $inputs['fk_krs'] = $randomid;
            $this->db->insert('krs', $input);
            $this->db->insert('dhs', $inputs);
        }
        echo "selesai";
    }

    //gak ada edit, karena nanti behaviornya delete dulu yang di table krs lalu getmatkul untuk pilih kembali krs yang mau di pilih lagi
    public function deletekrs($idkrs='') {
        // $idkrs = $_POST['id_krs'];

        $this->db->where()('id_krs', $idkrs);
        $this->db->delete('krs');
    }

    public function deletesomekrs() {
        $data = file_get_contents("php://input");
        $temp = json_decode($data);
        foreach($temp as $t) {
            $input = array();
            $input['id_krs'] = $t->id_krs;

            $inputs = array();
            $inputs['fk_krs'] = $t->id_krs;
            $this->db->delete('krs', $input);
            $this->db->delete('dhs', $inputs);
        }
        echo "okeh";
    }

    public function poststatuskrs() {
        $idkrs = $_POST['idkrs'];
        $status = $_POST['status'];
        
        $query = array('status' => $status);
        $this->db->where('id_krs', $idkrs);
        $this->db->update('krs', $query);

        echo "okeh";
    }
}