<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Ticket Form</title>
    <style type="text/css">
        html, body {
            font-family: consolas, monospace;
            cursor: default;
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
        }
        pre {
            font-family: consolas, monospace;
        }
    </style>
    <script type="text/javascript">
        /* Put JS Here */ 
        function move_url(link){
            document.location = "../../../index.php/" + link;
        }
        function get_satker(object_select){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.status === 200 && this.readyState === 4){
                    var pelapor_satker_display = document.getElementById("pelapor_satker_display");
                    var pelapor_satker = document.getElementById("pelapor_satker");
                    var result = JSON.parse(this.responseText);
                    pelapor_satker_display.value = result.satker_nama;
                    pelapor_satker.value = result.satker_kode;
                }
            };
            xmlhttp.open("GET", "../../../index.php/hdcasedaftar/get_satker/" + object_select.value);
            xmlhttp.send(null);
        }
        function get_nama(object_select){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.status === 200 && this.readyState === 4){
                    var inputnama = document.getElementById("inputnama");
                    inputnama.value = this.responseText;
                }
            };
            xmlhttp.open("GET", "../../../index.php/hdcasedaftar/get_nama/" + object_select.value);
            xmlhttp.send(null);
        }
        /* JS Latlong Here */ 

    </script>
</head>
<body>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="box-body">
                                                            
            <div class="form-group">
                <label for="notiket_display" class="col-lg-2 control-label">Nomor Tiket</label>
                <div class="col-lg-10">
                    <input disabled type="text" id="notiket_display" class="form-control" name="notiket_display" placeholder="Notiket" value="<?php echo isset($notiket) ? $notiket : ""; ?>">
                    <input type="hidden" id="notiket" class="form-control" name="notiket" value="<?php echo isset($notiket) ? $notiket : ""; ?>">
                </div>
            </div>
                     
            <!-- User Satker dan Admin -->
            <?php if((isset($_SESSION['userlevel']) && isset($GLOBALS['privilege_satker'][$_SESSION['userlevel']]) && $GLOBALS['privilege_satker'][$_SESSION['userlevel']]) || ((isset($_SESSION['PRI']) && $_SESSION['PRI'] == "SUPERADMIN") || (isset($_SESSION['PRI']) && $_SESSION['PRI'] == "ADMIN"))){ ?>
            <div class="form-group">
                <label for="pelapor_nip" class="col-lg-2 control-label">Pelapor Nip</label>
                <div class="col-lg-10">
                    <select onchange="get_satker(this);" name="pelapor_nip" id="pelapor_nip" class="form-control" <?php echo isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] != "" ? " disabled" : ""; ?>>
                        <option value="">PILIH NIP</option>
                        <?php foreach($data_hduser as $data){ ?>
                        <?php if($data->user_level == 2){ ?>
                        <?php $selected = (isset($pelapor_nip) && $pelapor_nip == $data->user_nip) || (isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] == $data->user_nip) ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->user_nip; ?>" <?php echo $selected; ?>><?php echo $data->inputnama . " :: " . $data->user_nip; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if(isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] != "" && !isset($penyelesaian_nip)){ ?>
                    <script type="text/javascript">
                    get_satker({"value" : "<?php echo $_SESSION['nomor_karyawan']; ?>"});
                    </script>
                    <input type="hidden" name="pelapor_nip" value="<?php echo $_SESSION['nomor_karyawan']; ?>" />
                    <?php } ?>
                    <?php if(isset($penyelesaian_nip)){ ?>
                    <script type="text/javascript">
                    get_nama({"value" : "<?php echo $penyelesaian_nip; ?>"});
                    </script>
                    <input type="hidden" name="penyelesaian_nip" value="<?php echo $penyelesaian_nip; ?>" />
                    <?php } ?>
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="pelapor_satker" class="col-lg-2 control-label">Pelapor Satker</label>
                <div class="col-lg-10">
                    <input disabled type="text" id="pelapor_satker_display" class="form-control" name="pelapor_satker_display" placeholder="Pelapor Satker">
                    <input type="hidden" id="pelapor_satker" name="pelapor_satker" value="<?php echo isset($pelapor_satker) ? $pelapor_satker : ""; ?>">
                </div>
            </div>
            
            <?php 
            if(isset($pelapor_nip) && $pelapor_nip != ""){
                ?>
                <script type="text/javascript">
                get_satker({"value" : "<?php echo $pelapor_nip; ?>"});
                </script>
                <?php
            }
            ?>
            
            <div class="form-group">
                <label for="pelaporan_tgl" class="col-lg-2 control-label">Pelaporan Tanggal</label>
                <div class="col-lg-10">
                    <input type="text" id="pelaporan_tgl" class="form-control tanggal_pilih" name="pelaporan_tgl" placeholder="Pelaporan Tanggal" value="<?php echo isset($pelaporan_tgl) ? $pelaporan_tgl : date("Y-m-d"); ?>">
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="pelaporan_jam" class="col-lg-2 control-label">Pelaporan Jam</label>
                <div class="col-lg-10">
                    <input type="text" id="pelaporan_jam" class="form-control jam" name="pelaporan_jam" placeholder="Pelaporan Jam" value="<?php echo isset($pelaporan_jam) ? $pelaporan_jam : date("H:i:s"); ?>">
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="kejadian_jenis" class="col-lg-2 control-label">Kejadian Jenis</label>
                <div class="col-lg-10">
                    <select name="kejadian_jenis" id="kejadian_jenis" class="form-control">
                        <?php foreach($data_kejadian_jenis as $data){ ?>
                        <?php $selected = isset($kejadian_jenis) && $kejadian_jenis == $data->kejadian_jenis ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->kejadian_jenis; ?>" <?php echo $selected; ?>><?php echo $data->kejadian_keterangan; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="prioritas" class="col-lg-2 control-label">Prioritas</label>
                <div class="col-lg-10">
                    <select name="prioritas" id="prioritas" class="form-control">
                        <option value="rendah" <?php echo isset($prioritas) && $prioritas == "rendah" ? " selected" : ""; ?>>Rendah</option>
                        <option value="sedang" <?php echo isset($prioritas) && $prioritas == "sedang" ? " selected" : ""; ?>>Sedang</option>
                        <option value="tinggi" <?php echo isset($prioritas) && $prioritas == "tinggi" ? " selected" : ""; ?>>Tinggi</option>
                    </select>
                </div>
            </div> 
                                                                                                                                                                                    
            <div class="form-group">
                <label for="kejadian_deskripsi" class="col-lg-2 control-label">Kejadian Deskripsi</label>
                <div class="col-lg-10">
                    <textarea class="form-control texteditor" id="kejadian_deskripsi" name="kejadian_deskripsi" placeholder="Kejadian Deskripsi"><?php echo isset($kejadian_deskripsi) ? $kejadian_deskripsi : ""; ?></textarea>
                </div>
            </div>  
            <?php } ?>
            <?php $disabled_ = ""; ?>
            <!-- User TI dan Admin -->
            <?php if((isset($_SESSION['userlevel']) && isset($GLOBALS['privilege_ti'][$_SESSION['userlevel']]) && $GLOBALS['privilege_ti'][$_SESSION['userlevel']]) || ((isset($_SESSION['PRI']) && $_SESSION['PRI'] == "SUPERADMIN") || (isset($_SESSION['PRI']) && $_SESSION['PRI'] == "ADMIN"))){ ?>
            <div class="form-group">
                <label for="penyelesaian_nip" class="col-lg-2 control-label">Penyelesaian Nip</label>
                <div class="col-lg-10">
                    <select onchange="get_nama(this);" name="penyelesaian_nip" id="penyelesaian_nip" class="form-control" <?php echo isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] != "" ? " disabled" : ""; ?>>
                        <option value="">PILIH NIP</option>
                        <?php foreach($data_hduser as $data){ ?>
                        <?php if($data->user_level == 3){ ?>
                        <?php $selected = ((isset($penyelesaian_nip) && $penyelesaian_nip == $data->user_nip) || (isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] == $data->user_nip)) ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->user_nip; ?>" <?php echo $selected; ?>><?php echo $data->inputnama . " :: " . $data->user_nip; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if(isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] != ""){ ?>
                    <script type="text/javascript">
                    get_nama({"value" : "<?php echo $_SESSION['nomor_karyawan']; ?>"});
                    </script>
                    <input type="hidden" name="penyelesaian_nip" value="<?php echo $_SESSION['nomor_karyawan']; ?>" />
                    <?php } ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputnama" class="col-lg-2 control-label">Penyelesaian Nama Lengkap</label>
                <div class="col-lg-10">
                    <input readonly="" type="text" id="inputnama" class="form-control" name="inputnama" placeholder="Penyelesaian Nama Lengkap" value="<?php echo isset($inputnama) ? $inputnama : ""; ?>">
                </div>
            </div>
            
            <!-- User TI Only -->
            <?php if((isset($_SESSION['userlevel']) && isset($GLOBALS['privilege_ti'][$_SESSION['userlevel']]) && $GLOBALS['privilege_ti'][$_SESSION['userlevel']])){ ?>
            <div class="form-group">
                <label for="pelapor_nip" class="col-lg-2 control-label">Pelapor Nip</label>
                <div class="col-lg-10">
                    <select onchange="get_satker(this);" name="pelapor_nip" id="pelapor_nip" class="form-control" <?php echo isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] != "" ? " disabled" : ""; ?>>
                        <option value="">PILIH NIP</option>
                        <?php foreach($data_hduser as $data){ ?>
                        <?php if($data->user_level == 2){ ?>
                        <?php $selected = (isset($pelapor_nip) && $pelapor_nip == $data->user_nip) || (isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] == $data->user_nip) ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->user_nip; ?>" <?php echo $selected; ?>><?php echo $data->inputnama . " :: " . $data->user_nip; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php if(isset($_SESSION['nomor_karyawan']) && $_SESSION['nomor_karyawan'] != ""){ ?>
                    <script type="text/javascript">
                    get_satker({"value" : "<?php echo $_SESSION['nomor_karyawan']; ?>"});
                    </script>
                    <input type="hidden" name="pelapor_nip" value="<?php echo $_SESSION['nomor_karyawan']; ?>" />
                    <?php } ?>
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="pelapor_satker" class="col-lg-2 control-label">Pelapor Satker</label>
                <div class="col-lg-10">
                    <input disabled type="text" id="pelapor_satker_display" class="form-control" name="pelapor_satker_display" placeholder="Pelapor Satker">
                    <input type="hidden" id="pelapor_satker" name="pelapor_satker" value="<?php echo isset($pelapor_satker) ? $pelapor_satker : ""; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="kejadian_jenis" class="col-lg-2 control-label">Kejadian Jenis</label>
                <div class="col-lg-10">
                    <select disabled name="kejadian_jenis" id="kejadian_jenis" class="form-control">
                        <?php foreach($data_kejadian_jenis as $data){ ?>
                        <?php $selected = isset($kejadian_jenis) && $kejadian_jenis == $data->kejadian_jenis ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->kejadian_jenis; ?>" <?php echo $selected; ?>><?php echo $data->kejadian_keterangan; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <?php if(isset($kejadian_status) && $kejadian_status == "close" && $penyelesaian_nip != $_SESSION['nomor_karyawan']){ $disabled_ = " disabled=''"; } ?>
            <div class="form-group">
                <label for="prioritas" class="col-lg-2 control-label">Prioritas</label>
                <div class="col-lg-10">
                    <select <?php echo $disabled_; ?> name="prioritas" id="prioritas" class="form-control">
                        <option value="rendah" <?php echo isset($prioritas) && $prioritas == "rendah" ? " selected" : ""; ?>>Rendah</option>
                        <option value="sedang" <?php echo isset($prioritas) && $prioritas == "sedang" ? " selected" : ""; ?>>Sedang</option>
                        <option value="tinggi" <?php echo isset($prioritas) && $prioritas == "tinggi" ? " selected" : ""; ?>>Tinggi</option>
                    </select>
                </div>
            </div>    
            
            <div class="form-group">
                <label for="kejadian_deskripsi" class="col-lg-2 control-label">Kejadian Deskripsi</label>
                <div class="col-lg-10">
                    <textarea class="form-control texteditor" id="kejadian_deskripsi" name="kejadian_deskripsi" placeholder="Kejadian Deskripsi"><?php echo isset($kejadian_deskripsi) ? $kejadian_deskripsi : ""; ?></textarea>
                </div>
            </div>  
            
            <script type="text/javascript">
            var disabled_textarea = {
                "kejadian_deskripsi" : true,
                <?php if(isset($kejadian_status) && $kejadian_status == "close" && $penyelesaian_nip != $_SESSION['nomor_karyawan']){ $disabled_ = " disabled=''"; ?>
                "penyelesaian_keterangan" : true,      
                <?php } ?>
            };
            </script>
            
            <?php } ?>
            
            <div class="form-group">
                <label for="kejadian_status" class="col-lg-2 control-label">Kejadian Status</label>
                <div class="col-lg-10">
                    <select <?php echo $disabled_; ?> name="kejadian_status" id="kejadian_status" class="form-control">
                        <option value="open" <?php echo isset($kejadian_status) && $kejadian_status == "open" ? " selected" : ""; ?>>Open</option>
                        <option value="close" <?php echo isset($kejadian_status) && $kejadian_status == "close" ? " selected" : ""; ?>>Close</option>
                        <option value="pending" <?php echo isset($kejadian_status) && $kejadian_status == "pending" ? " selected" : ""; ?>>Pending</option>
                    </select>
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="penyelesaian_keterangan" class="col-lg-2 control-label">Penyelesaian Keterangan</label>
                <div class="col-lg-10">
                    <textarea class="form-control texteditor" id="penyelesaian_keterangan" name="penyelesaian_keterangan" placeholder="Penyelesaian Keterangan"><?php echo isset($penyelesaian_keterangan) ? $penyelesaian_keterangan : ""; ?></textarea>
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="penyelesaian_tgl" class="col-lg-2 control-label">Penyelesaian Tanggal</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled_; ?> type="text" id="penyelesaian_tgl" class="form-control tanggal_pilih" name="penyelesaian_tgl" placeholder="Penyelesaian Tanggal" value="<?php echo isset($penyelesaian_tgl) && $penyelesaian_tgl != "" ? $penyelesaian_tgl : date("Y-m-d"); ?>">
                </div>
            </div>
            <?php } ?>
            
            <div class="form-group">
                <label for="inputtgl_display" class="col-lg-2 control-label">Input Tanggal</label>
                <div class="col-lg-10">
                    <input disabled type="text" id="inputtgl_display" class="form-control tanggal_pilih" name="inputtgl_display" placeholder="Input Tanggal" value="<?php echo isset($inputtgl) ? $inputtgl : date("Y-m-d"); ?>">
                    <input type="hidden" id="inputtgl" name="inputtgl" value="<?php echo isset($inputtgl) ? $inputtgl : date("Y-m-d"); ?>">
                </div>
            </div>
                                                                                                                                                                                    
            <div class="form-group">
                <label for="inputjam_display" class="col-lg-2 control-label">Input Jam</label>
                <div class="col-lg-10">
                    <input disabled type="text" id="inputjam_display" class="form-control jam" name="inputjam_display" placeholder="Input Jam" value="<?php echo isset($inputjam) ? $inputjam : date("H:i:s"); ?>">
                    <input type="hidden" id="inputjam" name="inputjam" value="<?php echo isset($inputjam) ? $inputjam : date("H:i:s"); ?>">
                </div>
            </div>
                                                                                                                                                            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled_; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_hdcasedaftar" value="Input Hdcasedaftar">Input Hdcasedaftar</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('allticket');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
    
    </body>
</html>