<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = new layout('items');
        $this->load->model('get_items');
    }
    public function index(){
        $this->get_items->process(array(
            'action' => 'select',
            'table' => 'tbl_lantai',
            'column_value' => array(
                'id',
                'nama_lantai'
            ),
            'order' => 'id asc'
        ));
        $data_lantai = $this->all;
        $this->get_items->process(array(
            'action' => 'select',
            'table' => 'tbl_alat_detail',
            'column_value' => array(
                'id',
                'nama_alat_detail'
            ),
            'order' => 'id asc'
        ));
        $data_alat_detail = $this->all;
        
        $this->get_items->process(array(
            'action' => 'select',
            'table' => 'tbl_alat',
            'column_value' => array(
                'id',
                'nama_alat'
            ),
            'order' => 'id asc'
        ));
        $data_alat = $this->all;
        
        $this->get_items->process(array(
            'action' => 'select',
            'table' => 'tbl_jenis_os',
            'column_value' => array(
                'id',
                'nama_os'
            ),
            'order' => 'id asc'
        ));
        $jenis_os = $this->all;
        
        $this->get_items->process(array(
            'action' => 'select',
            'table' => 'hdsatker',
            'column_value' => array(
                'id',
                'satker_kode',
                'satker_nama'
            ),
            'order' => 'id asc'
        ));
        $divisi = $this->all;
        
        $this->layout->loadView('items', array(
            "check" => "check",
            'data_lantai' => $data_lantai,
            'data_alat_detail' => $data_alat_detail,
            'data_alat' => $data_alat,
            'jenis_os' => $jenis_os,
            'divisi' => $divisi
        ));
    }
    
    public function get_divisi($id_lantai = ""){
        header('Content-Type: application/json; charset=utf-8');
        $data_divisi = array();
        if($id_lantai != ""){
            $this->get_items->process(array(
                'action' => 'select',
                'table' => 'hdsatker',
                'column_value' => array(
                    'id',
                    'satker_kode'
                ),
                'where' => 'id_lantai like \''.$id_lantai.',%\' or id_lantai like \'%,'.$id_lantai.'%\' or id_lantai = \''.$id_lantai.'\'',
                'order' => 'id asc'
            ));

            $data_divisi = $this->all;
        }
        echo json_encode($data_divisi);
    }
}