<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>All Ticket List</title>
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
            window.onload = function(){
	        var tempat_script = document.getElementById("tempat_script");
	        var script = document.createElement("script");
	        script.setAttribute("type","text/javascript");
	        script.innerHTML = tempat_script.innerHTML;
	        document.body.appendChild(script);
                tempat_script.parentNode.removeChild(tempat_script);
                
	    }; 
            function move_url(link){
                document.location = "../../../index.php/" + link;
            }
            function confirm_delete(param){
                var split_ = param.split("index.php/");
                var button_confirm = document.getElementById("button-confirm");
                button_confirm.setAttribute("onclick", "move_url('"+split_[1]+"')");
            }
            
	</script>
</head>
<body>
    
    <script type="text/javascript" id="tempat_script">
    if(typeof $ !== "undefined"){
        <?php echo $script; ?>        
    }
    </script>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-lg-12a">
                <div class="row">
                    <div class="col-lg-6" style="padding-bottom: 15px;">
                        <input type="text" id="tanggal_dari" class="form-control datepicker_from" name="tanggal_dari" placeholder="Tanggal Dari" style="border-radius: 4px;">
                    </div>
                    <div class="col-lg-6" style="padding-bottom: 15px;">
                        <input disabled="" type="text" id="tanggal_sampai" class="form-control datepicker_to" name="tanggal_sampai" placeholder="Tanggal Sampai" style="border-radius: 4px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="padding-bottom: 15px;">
                        <select name="prioritas" id="prioritas" class="form-control">
                            <option value="">PILIH PRIORITAS</option>
                            <option value="rendah">Rendah</option>
                            <option value="sedang">Sedang</option>
                            <option value="tinggi">Tinggi</option>
                        </select>
                    </div>
                    <div class="col-lg-6" style="padding-bottom: 15px;">
                        <select name="kejadian_status" id="kejadian_status" class="form-control">
                            <option value="">PILIH STATUS</option>
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="padding-bottom: 15px;">
                        <button id="filter_data" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #445b6f), color-stop(1, #337ab7)) !important; border-color: #337ab7; color: white; outline: none;" type="button" class="btn btn-default bg-aqua-gradient">Filter Data</button>
                    </div>
                    <div class="col-lg-6" style="padding-bottom: 15px;">
                        <button id="filter_clear" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; outline: none;" type="button" class="btn btn-default bg-aqua-gradient">Filter Clear</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-lg-12a">
                <div class="panel panel-success" style="font-family: consolas, monospace !important; cursor: default; border-color: #adadad;">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="padding-bottom: 10px; color: black; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;">
                        List All Ticket  
                        <?php if((isset($_SESSION['userlevel']) && isset($GLOBALS['privilege_satker'][$_SESSION['userlevel']]) && $GLOBALS['privilege_satker'][$_SESSION['userlevel']]) || ((isset($_SESSION['PRI']) && $_SESSION['PRI'] == "SUPERADMIN") || (isset($_SESSION['PRI']) && $_SESSION['PRI'] == "ADMIN"))){ ?>
                        <a id="addData" href="../../../index.php/allticket/add" class="btn btn-primary btn-xs pull-right hidden-xs bg-green-gradient"><span class="glyphicon glyphicon-plus"></span>&nbsp;New Ticket</a>
                        <?php } ?>
                    </div>
                    <table id="table-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>                                                              
                                <th>Notiket</th>   
                                <th>Tanggal Lapor</th>
                                <th>Pelapor</th>
                                <th>Status</th>
                                <th>Prioritas</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>  
                </div> <!-- end panel  -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    
</body>
</html>