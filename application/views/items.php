<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Items</title>
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
            /* Script Goes Here */
            
            var FileReader = typeof FileReader !== "undefined" ? FileReader : {};
            function readURL(input) {
                if (typeof input === "object" && typeof input.files !== "undefined" && input.files && input.files[0] && typeof FileReader !== "undefined") {
                    var reader = new FileReader();
                    if(typeof reader.onload !== "undefined"){
                        reader.onload = function(e) {
                            var tampil_gambar = document.getElementById('tampil_gambar');
                            var gambar_photo = tampil_gambar.getElementsByTagName("img")[0];
                            if(e.target.result.substr(0,10) === "data:image"){
                                gambar_photo.src = e.target.result;
                                gambar_photo.style.display = "";
                                gambar_photo.style.width = "250px";
                                tampil_gambar.style.display = "";
                            } else {
                                gambar_photo.src = "";
                                gambar_photo.style.display = "none";
                                gambar_photo.style.marginTop = "";
                                gambar_photo.style.width = "";
                                tampil_gambar.style.display = "";
                                tampil_gambar.innerHTML = input.files[0]['name'];
                            }
                            base_image_64 = "";
                        };
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        alert("Something Wrong With File Reader.");
                    }
                } else {
                    alert("Something Wrong With File Reader.");
                }
            }
            
            window.addEventListener("load", function(){
                var pemakai_alat = document.getElementById("pemakai_alat");
                var sudah_ada_divisi = false;
                pemakai_alat.onchange = function(){
                    var nilai = this.value;
                    if(nilai === "PERSONAL"){
                        var input_pic = document.getElementById("input_pic");
                        input_pic.style.display = "";
                        var input_divisi = document.getElementById("input_divisi");
                        input_divisi.style.display = "none";
                        var div_input_divisi_lainnya = document.getElementById("div_input_divisi_lainnya");
                        div_input_divisi_lainnya.style.display = "none";
                    }
                    else if(nilai === "DIVISI"){
                        console.log(sudah_ada_divisi);
                        if(sudah_ada_divisi){
                            var input_divisi = document.getElementById("input_divisi");
                            input_divisi.style.display = "";
                        }
                        var input_pic = document.getElementById("input_pic");
                        input_pic.style.display = "none";
                        var div_input_divisi_lainnya = document.getElementById("div_input_divisi_lainnya");
                        div_input_divisi_lainnya.style.display = "none";
                    }
                    else if(nilai === "DIVISILAINNYA"){
                        var input_pic = document.getElementById("input_pic");
                        input_pic.style.display = "none";
                        var input_divisi = document.getElementById("input_divisi");
                        input_divisi.style.display = "none";
                        var div_input_divisi_lainnya = document.getElementById("div_input_divisi_lainnya");
                        div_input_divisi_lainnya.style.display = "";
                    }
                    else {
                        var input_divisi = document.getElementById("input_divisi");
                        input_divisi.style.display = "none";
                        var input_pic = document.getElementById("input_pic");
                        input_pic.style.display = "none";
                    }
                };
                var pilih_divisi = document.getElementById("pilih_divisi");
                var html_awal_pilih_divisi = pilih_divisi.innerHTML;
                var posisi_lantai = document.getElementById("posisi_lantai");
                posisi_lantai.onchange = function(){
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function(){
                        if(this.status === 200 && this.readyState === 4){
                            // console.log(JSON.parse(this.responseText));
                            sudah_ada_divisi = true;
                            var hasil = JSON.parse(this.responseText);
                            pilih_divisi.innerHTML = "";
                            var select_pilih_divisi = "<option value=''>PILIH DIVISI</option>";
                            if(pemakai_alat.value === "DIVISI"){
                                var input_divisi = document.getElementById("input_divisi");
                                input_divisi.style.display = "";
                            }
                            for(var i = 0; i < hasil.length; i++){
                                select_pilih_divisi = select_pilih_divisi + "<option value='"+hasil[i].id+"'>"+hasil[i].satker_kode+"</option>"
                            }
                            pilih_divisi.innerHTML = select_pilih_divisi;
                            if(hasil.length === 0){
                                sudah_ada_divisi = false;
                                pilih_divisi.innerHTML = html_awal_pilih_divisi;
                                var input_divisi = document.getElementById("input_divisi");
                                input_divisi.style.display = "none";
                            }
                        }
                    };
                    xmlhttp.open("GET", "../../../index.php/items/get_divisi/" + posisi_lantai.value);
                    xmlhttp.send(null);
                };
                var jenis_alat = document.getElementById("jenis_alat");
                jenis_alat.onchange = function(){
                    var nilai = this.value;
                    if(nilai === "99999"){
                        // Lainnya
                        var div_input_jenis_alat = document.getElementById("div_input_jenis_alat");
                        div_input_jenis_alat.style.display = "";
                        
                        // PC
                        var div_physical_address = document.getElementById("div_physical_address");
                        div_physical_address.style.display = "none";
                        var div_jenis_os = document.getElementById("div_jenis_os");
                        div_jenis_os.style.display = "none";
                        var div_ip_address = document.getElementById("div_ip_address");
                        div_ip_address.style.display = "none";
                        var table_detail_alat = document.getElementById("table_detail_alat");
                        var get_tr_punya_pc = table_detail_alat.getElementsByTagName("tr");
                        for(var i = 0; i < get_tr_punya_pc.length; i++){
                            if(get_tr_punya_pc[i].getAttribute("class") === "tr_punya_pc"){
                                get_tr_punya_pc[i].style.display = "none";
                            }
                        }
                    }
                    else if(nilai === "1"){
                        // Lainnya
                        var div_input_jenis_alat = document.getElementById("div_input_jenis_alat");
                        div_input_jenis_alat.style.display = "none";
                        
                        // PC
                        var div_physical_address = document.getElementById("div_physical_address");
                        div_physical_address.style.display = "";
                        var div_jenis_os = document.getElementById("div_jenis_os");
                        div_jenis_os.style.display = "";
                        var div_ip_address = document.getElementById("div_ip_address");
                        div_ip_address.style.display = "";
                        var table_detail_alat = document.getElementById("table_detail_alat");
                        var get_tr_punya_pc = table_detail_alat.getElementsByTagName("tr");
                        for(var i = 0; i < get_tr_punya_pc.length; i++){
                            if(get_tr_punya_pc[i].getAttribute("class") === "tr_punya_pc"){
                                get_tr_punya_pc[i].style.display = "";
                            }
                        }
                    }
                    else if(nilai === "2"){
                        // Lainnya
                        var div_input_jenis_alat = document.getElementById("div_input_jenis_alat");
                        div_input_jenis_alat.style.display = "none";
                        
                        // PC
                        var div_physical_address = document.getElementById("div_physical_address");
                        div_physical_address.style.display = "none";
                        var div_jenis_os = document.getElementById("div_jenis_os");
                        div_jenis_os.style.display = "none";
                        var div_ip_address = document.getElementById("div_ip_address");
                        div_ip_address.style.display = "none";
                        var table_detail_alat = document.getElementById("table_detail_alat");
                        var get_tr_punya_pc = table_detail_alat.getElementsByTagName("tr");
                        for(var i = 0; i < get_tr_punya_pc.length; i++){
                            if(get_tr_punya_pc[i].getAttribute("class") === "tr_punya_pc"){
                                get_tr_punya_pc[i].style.display = "none";
                            }
                        }
                        
                        // Printer
                        var div_ip_address_ = document.getElementById("div_ip_address");
                        div_ip_address_.style.display = "";
                    }
                    else {
                        // Lainnya
                        var div_input_jenis_alat = document.getElementById("div_input_jenis_alat");
                        div_input_jenis_alat.style.display = "none";
                        
                        // PC and Printer
                        var div_physical_address = document.getElementById("div_physical_address");
                        div_physical_address.style.display = "none";
                        var div_jenis_os = document.getElementById("div_jenis_os");
                        div_jenis_os.style.display = "none";
                        var div_ip_address = document.getElementById("div_ip_address");
                        div_ip_address.style.display = "none";
                        var table_detail_alat = document.getElementById("table_detail_alat");
                        var get_tr_punya_pc = table_detail_alat.getElementsByTagName("tr");
                        for(var i = 0; i < get_tr_punya_pc.length; i++){
                            if(get_tr_punya_pc[i].getAttribute("class") === "tr_punya_pc"){
                                get_tr_punya_pc[i].style.display = "none";
                            }
                        }
                    }
                };
                var jenis_os = document.getElementById("jenis_os");
                jenis_os.onchange = function(){
                    var nilai = this.value;
                    if(nilai === "99999"){
                        var div_input_jenis_os = document.getElementById("div_input_jenis_os");
                        div_input_jenis_os.style.display = "";
                    } else {
                        var div_input_jenis_os = document.getElementById("div_input_jenis_os");
                        div_input_jenis_os.style.display = "none";
                    }
                };
                
                var table_detail_alat_ = document.getElementById("table_detail_alat");
                var get_tr_input_ = table_detail_alat_.getElementsByTagName("input");
                for(var i = 0; i < get_tr_input_.length; i++){
                    if(get_tr_input_[i].getAttribute("type") === "checkbox"){
                        get_tr_input_[i].onclick = function(){
                            if(this.checked){
                                var get_parent = this.parentNode.parentNode.parentNode;
                                var get_parent_input_ = get_parent.getElementsByTagName("input");
                                get_parent_input_[1].checked = false;
                                get_parent_input_[2].checked = true;
                                var table_detail_alat_ = document.getElementById("table_detail_alat");
                                var get_tr_ = table_detail_alat_.getElementsByTagName("tr");
                                for(var i = 0; i < get_tr_.length; i++){
                                    if(get_tr_[i].getAttribute("class") === "tr_punya_lainnya"){
                                        get_tr_[i].getElementsByTagName("input")[0].checked = false;
                                    }
                                }
                                var div_masukkan_detail = document.getElementById("div_masukkan_detail");
                                div_masukkan_detail.style.display = "none";
                            } else {
                                var get_parent = this.parentNode.parentNode.parentNode;
                                var get_parent_input_ = get_parent.getElementsByTagName("input");
                                get_parent_input_[1].checked = false;
                                get_parent_input_[2].checked = false;
                            }
                        };
                    }
                }
                
                var get_tr_radio_pc = table_detail_alat_.getElementsByTagName("tr");
                for(var i = 0; i < get_tr_radio_pc.length; i++){
                    if(get_tr_radio_pc[i].getAttribute("class") === "tr_punya_pc"){
                        get_tr_radio_pc[i].getElementsByTagName("input")[1].onclick = function(){
                            if(this.checked){
                                var get_parent = this.parentNode.parentNode.parentNode;
                                var get_parent_input_ = get_parent.getElementsByTagName("input");
                                get_parent_input_[0].checked = true;
                                var div_masukkan_detail = document.getElementById("div_masukkan_detail");
                                div_masukkan_detail.style.display = "none";
                                var table_detail_alat_ = document.getElementById("table_detail_alat");
                                var get_tr_ = table_detail_alat_.getElementsByTagName("tr");
                                for(var i = 0; i < get_tr_.length; i++){
                                    if(get_tr_[i].getAttribute("class") === "tr_punya_lainnya"){
                                        get_tr_[i].getElementsByTagName("input")[0].checked = false;
                                    }
                                }
                            }
                        };
                        get_tr_radio_pc[i].getElementsByTagName("input")[2].onclick = function(){
                            if(this.checked){
                                var get_parent = this.parentNode.parentNode.parentNode;
                                var get_parent_input_ = get_parent.getElementsByTagName("input");
                                get_parent_input_[0].checked = true;
                                var div_masukkan_detail = document.getElementById("div_masukkan_detail");
                                div_masukkan_detail.style.display = "none";
                                var table_detail_alat_ = document.getElementById("table_detail_alat");
                                var get_tr_ = table_detail_alat_.getElementsByTagName("tr");
                                for(var i = 0; i < get_tr_.length; i++){
                                    if(get_tr_[i].getAttribute("class") === "tr_punya_lainnya"){
                                        get_tr_[i].getElementsByTagName("input")[0].checked = false;
                                    }
                                }
                            }
                        };
                    }
                }
                
                var get_tr_ = table_detail_alat_.getElementsByTagName("tr");
                for(var i = 0; i < get_tr_.length; i++){
                    if(get_tr_[i].getAttribute("class") === "tr_punya_lainnya"){
                        get_tr_[i].getElementsByTagName("input")[0].onclick = function(){
                            if(this.checked){
                                var table_detail_alat_ = document.getElementById("table_detail_alat");
                                var get_tr_ = table_detail_alat_.getElementsByTagName("tr");
                                for(var i = 0; i < get_tr_.length; i++){
                                    if(get_tr_[i].getAttribute("class") === "tr_punya_pc"){
                                        get_tr_[i].getElementsByTagName("input")[0].checked = false;
                                        get_tr_[i].getElementsByTagName("input")[1].checked = false;
                                        get_tr_[i].getElementsByTagName("input")[2].checked = false;
                                    }
                                }
                                if(this.value === "99999"){
                                    var div_masukkan_detail = document.getElementById("div_masukkan_detail");
                                    div_masukkan_detail.style.display = "";
                                } else {
                                    var div_masukkan_detail = document.getElementById("div_masukkan_detail");
                                    div_masukkan_detail.style.display = "none";
                                }
                            }
                        };
                    }
                }
            });
        </script>
    </head>
    <body>
        <div align="center">
            <img src="image/LOGOYKKBI FRONT.png" /><br />
            <b><font style="color: red;">S</font></b>istem <b><font style="color: red;">I</font></b>nformasi <b><font style="color: red;">R</font></b>ekam <b><font style="color: red;">I</font></b>tem<br /><br />
        </div>
        <form>
            <div class="form-group row" style="text-align: left;">
                <label for="posisi_lantai" class="col-sm-2 col-form-label">Posisi Alat</label>
                <div class="col-sm-10">
                    <select id="posisi_lantai" name="posisi_lantai" class="form-control">
                        <option value="">PILIH</option>
                        <?php 
                        foreach($data_lantai as $lantai){
                            echo "<option value='".$lantai->id."'>".$lantai->nama_lantai."</option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="pemakai_alat" class="col-sm-2 col-form-label">Pemakai Alat</label>
                <div class="col-sm-10">
                    <select id="pemakai_alat" name="pemakai_alat" class="form-control">
                        <option value="">PILIH</option>
                        <option value="PERSONAL">PERSONAL</option>
                        <option value="DIVISI">DIVISI</option>
                        <option value="DIVISILAINNYA">DIVISI LAINNYA</option>
                    </select>
                </div>
            </div>
            <div id="input_pic" class="form-group row" style="text-align: left; display: none;">
                <label for="nama_pic" class="col-sm-2 col-form-label">Nama PIC</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pic" name="nama_pic" placeholder="Nama PIC">
                </div>
            </div>
            <div id="input_divisi" class="form-group row" style="text-align: left; display: none;">
                <label for="pilih_divisi" class="col-sm-2 col-form-label">Divisi</label>
                <div class="col-sm-10">
                    <select id="pilih_divisi" name="pilih_divisi" class="form-control">
                        <option value="">PILIH</option>
                        <option value="">SILAHKAN PILIH LANTAI TERLEBIH DULU</option>
                    </select>
                </div>
            </div>
            <div id="div_input_divisi_lainnya" class="form-group row" style="text-align: left; display: none;">
                <label for="pilih_divisi_lainnya" class="col-sm-2 col-form-label">Divisi Lainnya</label>
                <div class="col-sm-10">
                    <select size="5" id="pilih_divisi_lainnya" multiple="multiple" name="pilih_divisi_lainnya" class="form-control">
                        <?php 
                        
                        foreach($divisi as $data_divisi){
                            echo "<option value='".$data_divisi->id."'>".$data_divisi->satker_nama." (".$data_divisi->satker_kode.")"."</option>\n";
                        }
                        
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="jenis_alat" class="col-sm-2 col-form-label">Jenis Alat</label>
                <div class="col-sm-10">
                    <select id="jenis_alat" name="jenis_alat" class="form-control">
                        <option value="">PILIH</option>
                        <?php 
                        
                        foreach($data_alat as $alat){
                            echo '<option value="'.$alat->id .'">'.$alat->nama_alat .'</option>';
                        }
                        
                        ?>
                        <option value="99999">Lainnya</option>
                    </select>
                </div>
            </div>
            <div id="div_input_jenis_alat" class="form-group row" style="text-align: left; display: none;">
                <label for="input_jenis_alat" class="col-sm-2 col-form-label">Input Jenis Alat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input_jenis_alat" name="input_jenis_alat" placeholder="Input Jenis Alat">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="merk_alat" class="col-sm-2 col-form-label">Merk Alat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="merk_alat" name="merk_alat" placeholder="Merk Alat">
                </div>
            </div>
            <div id="div_physical_address" class="form-group row" style="text-align: left; display: none;">
                <label for="physical_address" class="col-sm-2 col-form-label">Physical Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="physical_address" name="physical_address" placeholder="Physical Address">
                </div>
            </div>
            <div id="div_jenis_os" class="form-group row" style="text-align: left; display: none;">
                <label for="jenis_os" class="col-sm-2 col-form-label">Jenis OS</label>
                <div class="col-sm-10">
                    <select id="jenis_os" name="jenis_os" class="form-control">
                        <option value="">PILIH</option>
                        <?php 
                        
                        foreach($jenis_os as $os){
                            echo "<option value='".$os->id."'>".$os->nama_os."</option>";
                        }
                        
                        ?>
                        <option value="99999">Lainnya</option>
                    </select>
                </div>
            </div>
            <div id="div_input_jenis_os" class="form-group row" style="text-align: left; display: none;">
                <label for="input_jenis_os" class="col-sm-2 col-form-label">Input Jenis OS</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input_jenis_os" name="input_jenis_os" placeholder="Input Jenis OS">
                </div>
            </div>
            <div id="div_ip_address" class="form-group row" style="text-align: left; display: none;">
                <label for="ip_address" class="col-sm-2 col-form-label">IP Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="IP Address">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="photo_alat" class="col-sm-2 col-form-label">Photo Alat</label>
                <div class="col-sm-10">
                    <div id="tampil_gambar" style="display: none; margin-bottom: 1rem; border-radius: 0.25rem; width: 100%; margin-top: 4px; border-top: #d0d0d0 1px solid; border-bottom: #d0d0d0 1px solid; border-right: #d0d0d0 1px solid; border-left: #d0d0d0 1px solid; padding: 5px;" align="center">
                        <img src="" style="width: 250px;">
                    </div>
                    <div class="custom-file">
                        <input onchange="readURL(this);" type="file" class="custom-file-input" id="photo_alat" name="photo_alat">
                        <label class="custom-file-label" for="photo_alat">Choose file...</label>
                    </div>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="detail_alat" class="col-sm-2 col-form-label">Detail Alat</label>
                <div class="col-sm-10">
                    <div style="width: 100%; overflow-y: hidden; overflow-x: auto;">
                        <table id="table_detail_alat" border="0">
                            <?php $count = 1; ?>
                            <?php foreach($data_alat_detail as $detail){ ?>
                            <tr class="tr_punya_pc" style="display: none;">
                                <td>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customControlValidation<?php echo $count; ?>1">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>1"><?php echo $detail->nama_alat_detail; ?></label>
                                    </div>
                                </td>
                                <td style="padding-left: 10px;">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="pilihan<?php echo $count; ?>" class="custom-control-input" id="customControlValidation<?php echo $count; ?>2">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>2">Wireless</label>
                                    </div>
                                </td>
                                <td style="padding-left: 10px;">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="pilihan<?php echo $count; ?>" class="custom-control-input" id="customControlValidation<?php echo $count; ?>3">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>3">Cable</label>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++; ?>
                            <?php } ?>
                            <tr class="tr_punya_lainnya">
                                <td>
                                    <div class="custom-control custom-radio mb-3">
                                        <input value="NONE" type="radio" name="pilihan<?php echo $count; ?>" class="custom-control-input" id="customControlValidation<?php echo $count; ?>1">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>1">Tidak Ada Detail</label>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++; ?>
                            <tr class="tr_punya_lainnya">
                                <td>
                                    <div class="custom-control custom-radio mb-3">
                                        <input value="99999" type="radio" name="pilihan<?php echo $count - 1; ?>" class="custom-control-input" id="customControlValidation<?php echo $count; ?>1">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>1">Lainnya</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div id="div_masukkan_detail" class="form-group row" style="text-align: left; display: none;">
                <label for="masukkan_detail" class="col-sm-2 col-form-label">Masukkan Detail</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="masukkan_detail" name="masukkan_detail" placeholder="Masukkan Detail Pisahkan dengan Koma">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="tombol_submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-5" style="margin-bottom: 1rem;">
                    <button class="btn btn-secondary" style="border-color: #a0a4a4;background-color: rgba(90, 98, 104, 0.6);" type="button">Show Data</button>
                </div>
                <div class="col-sm-5">
                    <button class="btn btn-primary" type="submit">Submit Form</button>
                </div>
            </div>
        </form>
    </body>
</html>