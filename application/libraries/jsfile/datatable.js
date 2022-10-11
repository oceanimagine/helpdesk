var url__ = typeof url__ !== "undefined" && url__ !== "" ? url__ : "";
var ajax_ = 0;

function check_exist(img_url, img_object) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            change_to_image(img_object);
        }
    };
    xhttp.open("GET", img_url, true);
    xhttp.send();
}

function change_to_image(img_object){
    var get_id = img_object.getAttribute("id");
    var get_split = get_id.split("_");
    var get_number = get_split[1];
    document.getElementById("image_" + get_number).style.visibility = "";
    document.getElementById("font_image" + get_number).style.display = "none";
    document.getElementById("br_" + get_number).style.display = "none";
}

var oTable = {};
$(document).ready(function () {
    
    var url_ = url__;
    var url_data = url_;
    var url_temp = url_data;
    loadData();

    var resize = false;
    function loadData() {
        $('#table-data').dataTable().fnDestroy();
        var url = '';
        url = url_data;

        oTable = $('#table-data').on('draw.dt', function () {
            /* on draw table datatables */
        }).dataTable({
            "autoWidth": false,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": url,
            "ordering": false,
            "scrollY": 300,
            "scrollX": true,
            "paging": true,
            "searching": true,
            "info": false,
            "aoColumnDefs": [
                {"aTargets": [1], "bVisible": false}, //idx
            ],
            "initComplete": function () {
                /* on complete render table datatables */
            }
        });
        
        if(!resize){
            window.update_size = function () {
                $(oTable).css({width: $(oTable).parent().width()});
                oTable.fnAdjustColumnSizing();
            };

            $(window).resize(function () {
                clearTimeout(window.refresh_size);
                window.refresh_size = setTimeout(function () {
                    update_size();
                }, 250);
            });
        }
        resize = true;
    }
    if(document.getElementById("filter_data")){
        var filter_data = document.getElementById("filter_data");
        var filter_clear = document.getElementById("filter_clear");
        var tanggal_dari = document.getElementById("tanggal_dari");
        var tanggal_sampai = document.getElementById("tanggal_sampai");
        var prioritas = document.getElementById("prioritas");
        var kejadian_status = document.getElementById("kejadian_status");
        filter_data.onclick = function(){
            var all_params = "";
            var symbol = "";
            if(tanggal_dari.value !== ""){
                all_params = all_params + symbol + "tanggal_dari=" + tanggal_dari.value;
                symbol = "&";
            }
            if(tanggal_sampai.value !== ""){
                all_params = all_params + symbol + "tanggal_sampai=" + tanggal_sampai.value;
                symbol = "&";
            }
            if(prioritas.value !== ""){
                all_params = all_params + symbol + "prioritas=" + prioritas.value;
            }
            if(kejadian_status.value !== ""){
                all_params = all_params + symbol + "kejadian_status=" + kejadian_status.value;
            }
            url_data = url_temp + (all_params !== "" ? "?" + all_params : "");
            console.log(url_data);
            console.log("Load Data");
            loadData();
        };
        filter_clear.onclick = function(){
            tanggal_dari.value = "";
            tanggal_sampai.value = "";
            $("div.row select").val("");
            $('.datepicker_to').attr("disabled","");
            url_data = url_temp;
            console.log(url_data);
            loadData();
        };
         $('.datepicker_from').datepicker({
            changeYear: true,
            changeMonth: true,
            minDate: $('.datepicker_from').val() !== "" ? new Date($('.datepicker_from').val()) : -720,
            dateFormat: "yy-mm-dd",
            yearRange: "-100:+20",
            onClose: function () {
                $(".datepicker_to").datepicker("change", {
                    minDate: $('.datepicker_from').val() !== "" ? new Date(new Date($('.datepicker_from').val()).setDate(new Date($('.datepicker_from').val()).getDate() + 1)) : -719
                });
                
                if($('.datepicker_from').val() !== ""){
                    $(".datepicker_to").val(new Date(new Date($('.datepicker_from').val()).setDate(new Date($('.datepicker_from').val()).getDate() + 1)).toISOString().slice(0, 10));
                    $(".datepicker_to").removeAttr("disabled");
                }
            }
        });

        $('.datepicker_to').datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-100:+20",
            minDate: $('.datepicker_from').val() !== "" ? new Date(new Date($('.datepicker_from').val()).setDate(new Date($('.datepicker_from').val()).getDate() + 1)) : -719
        });
    }
});

$( document ).ajaxComplete(function() {
    if(!ajax_){
        var table_data = document.getElementById("table-data");
        var get_image = table_data.getElementsByTagName("img");
        count = get_image.length;
        for(var i = 0; i < get_image.length; i++){
            var id_image = get_image[i].getAttribute("id");
            if(id_image !== null){
                var split_ = id_image.split("_");
                if(split_[0] === "image"){
                    var get_url = get_image[i].getAttribute("src");
                    check_exist(get_url, get_image[i]);
                }
            }
        }
    }
});