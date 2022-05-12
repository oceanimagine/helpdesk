<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class hdcasedaftar extends CI_Controller {
    
    public $layout;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_hdcasedaftar');
        $this->layout = new layout('lite');
        Privilege::admin();
    }

    public function get_hdcasedaftar() {
        $this->get_hdcasedaftar->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("hdcasedaftar/get_hdcasedaftar");
    }
    
    public function hapus($id){
        $_GET['id'] = $id;
        
        $this->get_hdcasedaftar->process(array(
            'action' => 'delete',
            'table' => 'hdcasedaftar',
            'where' => 'notiket = \''.$id.'\''
        ));
        redirect('hdcasedaftar');
    }
    
    public function edit($id){
        if($this->input->post('notiket')){
            $_GET['id'] = $id;
            
            $notiket = $this->input->post('notiket');
            $pelaporan_tgl = $this->input->post('pelaporan_tgl');
            $pelaporan_jam = $this->input->post('pelaporan_jam');
            $pelapor_nip = $this->input->post('pelapor_nip');
            $pelapor_satker = $this->input->post('pelapor_satker');
            $kejadian_jenis = $this->input->post('kejadian_jenis');
            $kejadian_deskripsi = $this->input->post('kejadian_deskripsi');
            $prioritas = $this->input->post('prioritas');
            $kejadian_status = $this->input->post('kejadian_status');
            $penyelesaian_keterangan = $this->input->post('penyelesaian_keterangan');
            $penyelesaian_tgl = $this->input->post('penyelesaian_tgl');
            $penyelesaian_nip = $this->input->post('penyelesaian_nip');
            $inputnama = $this->input->post('inputnama');
            $inputtgl = $this->input->post('inputtgl');
            $inputjam = $this->input->post('inputjam');
            $this->get_hdcasedaftar->process(array(
                'action' => 'update',
                'table' => 'hdcasedaftar',
                'column_value' => array(
                    
                    'notiket' => $notiket,
                    'pelaporan_tgl' => $pelaporan_tgl,
                    'pelaporan_jam' => $pelaporan_jam,
                    'pelapor_nip' => $pelapor_nip,
                    'pelapor_satker' => $pelapor_satker,
                    'kejadian_jenis' => $kejadian_jenis,
                    'kejadian_deskripsi' => $kejadian_deskripsi,
                    'prioritas' => $prioritas,
                    'kejadian_status' => $kejadian_status,
                    'penyelesaian_keterangan' => $penyelesaian_keterangan,
                    'penyelesaian_tgl' => $penyelesaian_tgl,
                    'penyelesaian_nip' => $penyelesaian_nip,
                    'inputnama' => $inputnama,
                    'inputtgl' => $inputtgl,
                    'inputjam' => $inputjam
                ),
                'where' => 'notiket = \''.$id.'\''
            ));
            redirect('hdcasedaftar/edit/'.$id.'');
        }
        
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hduser',
            'column_value' => array(
                'inputnama',
                'user_nip'
            )
        ));
        $data_hduser = $this->all;
        
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hdcasejenis',
            'column_value' => array(
                'kejadian_jenis',
                'kejadian_keterangan'
            )
        ));
        $data_kejadian_jenis = $this->all;
        
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hdcasedaftar',
            'column_value' => array(
                
                'notiket',
                'pelaporan_tgl',
                'pelaporan_jam',
                'pelapor_nip',
                'pelapor_satker',
                'kejadian_jenis',
                'kejadian_deskripsi',
                'prioritas',
                'kejadian_status',
                'penyelesaian_keterangan',
                'penyelesaian_tgl',
                'penyelesaian_nip',
                'inputnama',
                'inputtgl',
                'inputjam'
            ),
            'where' => 'notiket = \''.$id.'\''
        ));
        $this->layout->loadView('hdcasedaftar_form', array(
            
            'notiket' => $this->row->{'notiket'},
            'pelaporan_tgl' => $this->row->{'pelaporan_tgl'},
            'pelaporan_jam' => $this->row->{'pelaporan_jam'},
            'pelapor_nip' => $this->row->{'pelapor_nip'},
            'pelapor_satker' => $this->row->{'pelapor_satker'},
            'kejadian_jenis' => $this->row->{'kejadian_jenis'},
            'kejadian_deskripsi' => $this->row->{'kejadian_deskripsi'},
            'prioritas' => $this->row->{'prioritas'},
            'kejadian_status' => $this->row->{'kejadian_status'},
            'penyelesaian_keterangan' => $this->row->{'penyelesaian_keterangan'},
            'penyelesaian_tgl' => $this->row->{'penyelesaian_tgl'},
            'penyelesaian_nip' => $this->row->{'penyelesaian_nip'},
            'inputnama' => $this->row->{'inputnama'},
            'inputtgl' => $this->row->{'inputtgl'},
            'inputjam' => $this->row->{'inputjam'},
            "data_hduser" => $data_hduser,
            "data_kejadian_jenis" => $data_kejadian_jenis
        ));
    }
    
    public function add(){
        if($this->input->post('notiket')){
            
            $notiket = $this->input->post('notiket');
            $pelaporan_tgl = $this->input->post('pelaporan_tgl');
            $pelaporan_jam = $this->input->post('pelaporan_jam');
            $pelapor_nip = $this->input->post('pelapor_nip');
            $pelapor_satker = $this->input->post('pelapor_satker');
            $kejadian_jenis = $this->input->post('kejadian_jenis');
            $kejadian_deskripsi = $this->input->post('kejadian_deskripsi');
            $prioritas = $this->input->post('prioritas');
            $kejadian_status = $this->input->post('kejadian_status');
            $penyelesaian_keterangan = $this->input->post('penyelesaian_keterangan');
            $penyelesaian_tgl = $this->input->post('penyelesaian_tgl');
            $penyelesaian_nip = $this->input->post('penyelesaian_nip');
            $inputnama = $this->input->post('inputnama');
            $inputtgl = $this->input->post('inputtgl');
            $inputjam = $this->input->post('inputjam');
            $this->get_hdcasedaftar->process(array(
                'action' => 'insert',
                'table' => 'hdcasedaftar',
                'column_value' => array(
                    
                    'notiket' => $notiket,
                    'pelaporan_tgl' => $pelaporan_tgl,
                    'pelaporan_jam' => $pelaporan_jam,
                    'pelapor_nip' => $pelapor_nip,
                    'pelapor_satker' => $pelapor_satker,
                    'kejadian_jenis' => $kejadian_jenis,
                    'kejadian_deskripsi' => $kejadian_deskripsi,
                    'prioritas' => $prioritas,
                    'kejadian_status' => $kejadian_status,
                    'penyelesaian_keterangan' => $penyelesaian_keterangan,
                    'penyelesaian_tgl' => $penyelesaian_tgl,
                    'penyelesaian_nip' => $penyelesaian_nip,
                    'inputnama' => $inputnama,
                    'inputtgl' => $inputtgl,
                    'inputjam' => $inputjam,
                )
            ));
            redirect('hdcasedaftar/add');
        }
        
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hduser',
            'column_value' => array(
                'inputnama',
                'user_nip'
            )
        ));
        $data_hduser = $this->all;
        
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hdcasejenis',
            'column_value' => array(
                'kejadian_jenis',
                'kejadian_keterangan'
            )
        ));
        $data_kejadian_jenis = $this->all;
        
        $this->layout->callFunction(array(
            "function_name" => "get_no_tiket",
            "class_active" => $this,
            "variable_return" => "notiket"
        ));
        $this->layout->loadView('hdcasedaftar_form', array(
            "data_hduser" => $data_hduser,
            "data_kejadian_jenis" => $data_kejadian_jenis
        ));
    }
    
    public function get_nama($nip){
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hduser',
            'column_value' => array(
                'inputnama'
            ),
            'where' => 'user_nip = \''.$nip.'\''
        ));
        $data_user = $this->all;
        $nama = "UNDEFINED";
        if(sizeof($data_user) > 0){
            $nama = $data_user[0]->inputnama;
        }
        echo $nama;
    }
    
    public function get_satker($nip){
        $this->get_hdcasedaftar->process(array(
            'action' => 'select',
            'table' => 'hduser',
            'column_value' => array(
                'user_satker'
            ),
            'where' => 'user_nip = \''.$nip.'\''
        ));
        $data_user_satker = $this->all;
        $satker_nama = "UNDEFINED";
        $satker_kode = "UNDEFINED";
        if(sizeof($data_user_satker) > 0){
            $satker_kode = $data_user_satker[0]->user_satker;
            $this->get_hdcasedaftar->process(array(
                'action' => 'select',
                'table' => 'hdsatker',
                'column_value' => array(
                    'satker_nama'
                ),
                'where' => 'satker_kode = \''.$satker_kode.'\''
            ));
            $data_satker = $this->all;
            if(sizeof($data_satker) > 0){
                $satker_nama = $data_satker[0]->satker_nama;
            }
        }
        echo json_encode(array("satker_nama" => $satker_nama, "satker_kode" => $satker_kode));
    }
    
    public function index() {
        $this->layout->loadView(
            'hdcasedaftar_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
    public function inbox(){
        $this->layout->loadView('inbox_view');
    }
}