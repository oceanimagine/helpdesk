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
            window.addEventListener("load", function(){
                var pemakai_alat = document.getElementById("pemakai_alat");
                pemakai_alat.onchange = function(){
                    var nilai = this.value;
                    
                };
            });
        </script>
    </head>
    <body>
        <div align="center">
            <img src="image/LOGOYKKBI FRONT.png" /><br />
            Aplikasi Rekam Item<br /><br />
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
                    </select>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="nama_pic" class="col-sm-2 col-form-label">Nama PIC</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_pic" name="nama_pic" placeholder="Nama PIC">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="pilih_divisi" class="col-sm-2 col-form-label">Divisi</label>
                <div class="col-sm-10">
                    <select id="pilih_divisi" name="pilih_divisi" class="form-control">
                        <option value="">PILIH</option>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="jenis_alat" class="col-sm-2 col-form-label">Jenis Alat</label>
                <div class="col-sm-10">
                    <select id="jenis_alat" name="jenis_alat" class="form-control">
                        <option value="">PILIH</option>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
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
            <div class="form-group row" style="text-align: left;">
                <label for="physical_address" class="col-sm-2 col-form-label">Physical Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="physical_address" name="physical_address" placeholder="Physical Address">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="jenis_os" class="col-sm-2 col-form-label">Jenis OS</label>
                <div class="col-sm-10">
                    <select id="jenis_os" name="jenis_os" class="form-control">
                        <option value="">PILIH</option>
                    </select>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="ip_address" class="col-sm-2 col-form-label">IP Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="IP Address">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="photo_alat" class="col-sm-2 col-form-label">Photo Alat</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo_alat" name="photo_alat">
                        <label class="custom-file-label" for="photo_alat">Choose file...</label>
                    </div>
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="detail_alat" class="col-sm-2 col-form-label">Detail Alat</label>
                <div class="col-sm-10">
                    <div style="width: 100%; overflow-y: hidden; overflow-x: auto;">
                        <table border="0">
                            <?php $count = 1; ?>
                            <?php foreach($data_alat_detail as $detail){ ?>
                            <tr>
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
                            <tr>
                                <td>
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="pilihan<?php echo $count; ?>" class="custom-control-input" id="customControlValidation<?php echo $count; ?>1">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>1">Tidak Ada Detail</label>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++; ?>
                            <tr>
                                <td>
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="pilihan<?php echo $count - 1; ?>" class="custom-control-input" id="customControlValidation<?php echo $count; ?>1">
                                        <label class="custom-control-label" for="customControlValidation<?php echo $count; ?>1">Lainnya</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="masukkan_detail" class="col-sm-2 col-form-label">Masukkan Detail</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="masukkan_detail" name="masukkan_detail" placeholder="Masukkan Detail Pisahkan dengan Koma">
                </div>
            </div>
            <div class="form-group row" style="text-align: left;">
                <label for="tombol_submit" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Submit Form</button>
                </div>
            </div>
        </form>
    </body>
</html>