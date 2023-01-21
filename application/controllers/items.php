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
        $this->layout->loadView('items', array(
            "check" => "check",
            'data_lantai' => $data_lantai,
            'data_alat_detail' => $data_alat_detail
        ));
    }
}