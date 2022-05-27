<?php 

class get_tiketopen extends CI_Model {

    function __construct(){
        $this->param = new process_param();
        parent::__construct();
    }

    /* Process Database */
    function process($param){
        return $this->param->process($param);
    }

    function get_data(){

        $process_table = new process_table();

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : '0';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 10;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : '';

        $clouse = " where b.kejadian_status = 'open'";
        
        if(isset($_SESSION['id']) && $_SESSION['id'] != "" && isset($_SESSION['PRI']) && $_SESSION['PRI'] == "HDUSER"){
            $clouse = $clouse . " and b.pelapor_nip = '" . $_SESSION['id'] . "'";
        }
        
        if ($sSearch != '') {
            $clouse = $clouse . " and b.notiket like '%" . $sSearch . "%' ";
        }

        $sql_total = "select b.notiket, b.pelaporan_tgl, b.pelaporan_jam, b.pelapor_nip, b.pelapor_satker, b.kejadian_jenis, b.kejadian_deskripsi, b.prioritas, b.kejadian_status, b.penyelesaian_keterangan, b.penyelesaian_tgl, b.penyelesaian_nip, b.inputnama, b.inputtgl, b.inputjam from hdcasedaftar b" . $clouse . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();
        
        if((isset($_SESSION['userlevel']) && isset($GLOBALS['privilege_ti'][$_SESSION['userlevel']]) && $GLOBALS['privilege_ti'][$_SESSION['userlevel']])){
            $sql = "
                select
                    b.notiket as id,
                    b.notiket,
                    b.pelaporan_tgl, 
                    b.pelaporan_jam, 
                    b.pelapor_nip, 
                    b.pelapor_satker, 
                    b.kejadian_jenis,
                    b.penyelesaian_tgl, 
                    b.penyelesaian_nip, 
                    b.inputnama, 
                    b.inputtgl, 
                    b.inputjam 
                from 
                    hdcasedaftar b".$clouse." 
                order by b.notiket asc limit $iDisplayStart , $iDisplayLength
            ";
        }
        
        if((isset($_SESSION['userlevel']) && isset($GLOBALS['privilege_satker'][$_SESSION['userlevel']]) && $GLOBALS['privilege_satker'][$_SESSION['userlevel']])){
            $sql = "
                select 
                    b.notiket as id,
                    b.notiket,
                    b.pelaporan_tgl, 
                    b.pelaporan_jam, 
                    b.pelapor_nip, 
                    b.pelapor_satker, 
                    b.kejadian_jenis,
                    b.prioritas, 
                    b.kejadian_status,
                    b.inputtgl, 
                    b.inputjam 
                from 
                    hdcasedaftar b".$clouse." 
                order by b.notiket asc limit $iDisplayStart , $iDisplayLength
            ";
        }
        
        if(((isset($_SESSION['PRI']) && $_SESSION['PRI'] == "SUPERADMIN") || (isset($_SESSION['PRI']) && $_SESSION['PRI'] == "ADMIN"))){
            $sql = "
                select 
                    b.notiket as id,
                    b.notiket, 
                    b.pelaporan_tgl, 
                    b.pelaporan_jam, 
                    b.pelapor_nip, 
                    b.pelapor_satker, 
                    b.kejadian_jenis,
                    b.prioritas, 
                    b.kejadian_status, 
                    b.penyelesaian_tgl, 
                    b.penyelesaian_nip, 
                    b.inputnama, 
                    b.inputtgl, 
                    b.inputjam 
                from 
                    hdcasedaftar b".$clouse." 
                order by b.notiket asc limit $iDisplayStart , $iDisplayLength       
            ";
        }
        
        $sql = "
            select 
                b.notiket as id,
                b.notiket, 
                b.pelaporan_tgl,  
                (select a.inputnama from hduser a where a.user_nip = pelapor_nip) pelapor_nip, 
                b.kejadian_status,
                (select a.kejadian_keterangan from hdcasejenis a where a.kejadian_jenis = b.kejadian_jenis) kejadian_jenis
            from 
                hdcasedaftar b".$clouse." 
            order by b.kejadian_status desc, b.notiket asc limit $iDisplayStart , $iDisplayLength       
        ";
        $page = ($iDisplayStart / $iDisplayLength);

        $resuld = $process_table->coba_db($sql, $page, $iDisplayLength, true, "../../../index.php/tiketopen/edit", "../../../index.php/tiketopen/hapus");

        $output = array(
            'sEcho' => $sEcho,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $resuld
        );

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

}