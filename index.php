<?php
    require 'connection.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Klasifikasi Penentuan Pengajuan Kartu Kredit</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.min.js"></script>
    <script type="text/javascript" src="js/fnPagingInfo.js"></script>
    <script src="https://kit.fontawesome.com/018e8a6afd.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container main">
        <div class="card">
            <div class="card-header">
                <h3>Aplikasi Klasifikasi Penentuan Pengajuan Kartu Kredit dengan Naive Bayes</h3>
            </div>
            <div class="card-body">
                <div id="notification" style="display:none;" class="alert alert-success">
                    <span></span>
                </div>
                <div id="hasil"  class="alert alert-primary" style="display: none;">
                </div>
                <table class="table table_train" id="data_train">
                    <thead>
                        <tr align="center">
                            <th class="align-middle">Jenis Kelamin</th>
                            <th class="align-middle">Status Rumah</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle">Jumlah Tanggungan</th>
                            <th class="align-middle">Profesi</th>
                            <th class="align-middle">Penghasilan Per tahun</th>
                            <th class="align-middle">Kartu Kredit</th>
                            <th class="align-middle">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="body_data_train">
                        <?php
                            $query="SELECT * FROM data_train";
                            $result=mysqli_query($conn,$query);
                            if(mysqli_num_rows($result)>0){
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<tr>".
                                            "<td>".$row['jenis_kelamin']."</td>".
                                            "<td>".$row['status_rumah']."</td>".
                                            "<td>".$row['status']."</td>".
                                            "<td>".$row['jumlah_tanggungan']."</td>".
                                            "<td>".$row['profesi']."</td>".
                                            "<td>".$row['penghasilan']."</td>".
                                            "<td>".$row['kartu_kredit']."</td>".
                                            "<td><button class='btn btn-danger fas fa-trash' onclick='delete_data(".$row['id'].");'></button></td>".
                                        "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <table class="table table_input">
                    <thead>
                        <tr>
                            <th colspan="5" style="text-align: right;">Laplace Smoothing : </th>
                            <th colspan="1">
                                <label class="switch">
                                    <input type="checkbox" id="laplace" onchange="calculate()">
                                    <span class="slider round"></span>
                                </label>
                            </th>
                            <th colspan="2">Hasil Prediksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <tr><form action="#" method="post" id="calculate">
                                <td>
                                    <select id="input_jk" name="jk" class="form-control input" onchange="calculate()">
                                        <option value="-">--Pilih--</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="input_sr" name="sr" class="form-control input" onchange="calculate()">
                                        <option value="-">--Pilih--</option>
                                        <option value="Milik Sendiri">Milik Sendiri</option>
                                        <option value="Milik Keluarga">Milik Keluarga</option>
                                        <option value="Sewa">Sewa</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="input_status" name="status" class="form-control input" onchange="calculate()">
                                        <option value="-">--Pilih--</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="input_jt" name="jt" class="form-control input" onchange="calculate()">
                                        <option value="-">--Pilih--</option>
                                        <option value="0">0(Tidak ada)</option>
                                        <option value="1-2">1 sampai 2</option>
                                        <option value=">2">lebih dari 2</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="input_prof" name="profesi" class="form-control input" onchange="calculate()">
                                        <option value="-">--Pilih--</option>
                                        <option value="PNS">PNS</option>
                                        <option value="BUMN">BUMN</option>
                                        <option value="SWASTA">SWASTA</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="input_penghasilan" name="ppt" class="form-control input" onchange="calculate()">
                                        <option value="-">--Pilih--</option>
                                        <option value="Rendah">Rendah</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Tinggi">Tinggi</option>
                                        <option value="Sangat Tinggi">Sangat Tinggi</option>
                                    </select>
                                </td>
                                <td id="input_kredit"><input id="input_kk" class="form-control input" type="text" name="kartu_kredit" value="-" disabled></td>
                                <td><button class="btn btn-warning fas fa-trash" onclick="$(`#hasil`).slideUp();$('#input_kk').val('-');" type="reset"></button></td>
                                </form>
                        </tr>
                        <tr>
                            <td colspan="8" align="center">
                                <button class="btn btn-success w-100" onclick="submit();">Tambahkan sebagai data training!</button>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        .table_train,.table_input{
            table-layout: fixed;
        }
        .main>div{
            box-shadow: 0px 0px 100px 1px #555;
        }
        body{
            background-image: url("background.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
       }
       .main{
            margin-top: 15vh;
            margin-bottom: 15vh;
            align-items: center;
            display:flex;
       }
       .switch {
            position: relative;
            width: 40px;
            height: 20px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 8px;
            left: 0;
            right: 0;
            bottom: -8px;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;   
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(20px);
            -ms-transform: translateX(20px);
            transform: translateX(20px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 10px;
        }

        .slider.round:before {
            border-radius: 50%; 
        } 
    </style>
    <script>
    MathJax = {
        tex: {
            inlineMath: [['$', '$'], ['\\(', '\\)']]
        },
        svg: {
            fontCache: 'global'
        }
    };
    </script>
    <script type="text/javascript" id="MathJax-script" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
    </script>
    <script>
        $('#data_train').dataTable( {
            "pageLength": 5,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "ordering":false,
        });
        function delete_data(id_){
            $.post(
              'delete.php',
              {id:id_},
              function(result){
                  notif(result,"warning");
                  refresh();
                  calculate();
              } 
            );
        }
        function calculate() {
            var x=0;
            $(".input").each(function(){
                if($(this).val()!="-")x++;
            });
            if($("#input_kredit").children().val()!="-")x--;
            if (x==6){
                var url=""; 
                if($("#laplace").is(':checked')){
                    url="calculate.php?laplace=1";
                }else{
                    url="calculate.php?laplace=0";
                }
                    $.post(
                        url,
                        $("#calculate").serialize(),
                        function(data){
                            data=data.replace(/[\u2212]/g,"-");
                            data = JSON.parse(data);
                            var max=0;
                            var result="-";
                            var option="<select id='input_kk' class='form-control input' name='kartu_kredit'><option value='-'>--Pilih--</option>";
                            var i=0;
                            for(const [key,value] of Object.entries(data[0])){
                                if(max<=value){
                                    max=value;
                                    result=key;      
                                }
                            }
                            for(const [key,value] of Object.entries(data[0])){
                                if(max==value){
                                    option+="<option value='"+key+"'>"+key+"</option>";
                                    i++;
                                }
                            }
                            option+="</select>";
                            if(i==1){
                                $("#input_kredit").html(`<input id='input_kk' class="form-control input" type="text" name="kartu_kredit" value="-" disabled>`);
                                $("#input_kredit").children().val(result);
                            }else if(x>1){
                                $("#input_kredit").html(option);
                            }                      
                            var str=`<button type="button" class="close" onclick="$(this).parent().slideUp('slow');">&times;</button>`+"<table class='table'>";
                            for (const [key,value] of Object.entries(data[1])){
                                str+="<tr><td>"+key+"</td><td>"+value;
                                if(data[0][key]==max){
                                    str+=" <i class='fas fa-check' ></i></td>";
                                }else{
                                    str+=" <i class='fas fa-times'></i></td>";
                                }
                                str+="</tr>";
                            }
                            str+="</table>";
                            const node = document.getElementById('hasil');
                            MathJax.typesetClear([node]);
                            node.innerHTML = str;
                            MathJax.typesetPromise([node]).then(() => {
                                $("#hasil").slideDown("slow");
                            });
                            x=0;
                        }
                    );
            }else{
                $("#input_kredit").children().prop("disabled",false);
                $("#input_kredit").children().val('-');
                $("#input_kredit").children().prop("disabled",true);
            }
        }
        function submit() {
            var y=0;
            $(".form-control").each(function(){
                if($(this).val()!="-")y++;
            });
            if (y==7){
                    $.post(
                        'insert.php',
                        $("#calculate").serialize()+"&kartu_kredit="+$("#input_kredit").children().val(),
                        function(data){
                            notif(data,"success");
                            refresh();
                            $("#calculate")[0].reset();
                            $("#input_kredit").children().prop("disabled",false);
                            $("#input_kredit").children().val('-');
                            $("#input_kredit").children().prop("disabled",true);
                        }
                    ); 
            }else{
                alert("Harap masukkan data terlebih dahulu.");
            }
        }
        function refresh(){
            $.get("refresh.php",function(response){
                if ( $.fn.DataTable.isDataTable('#data_train') ) {
                    $('#data_train').DataTable().destroy();
                }
                $('#data_train tbody').empty();
                $("#body_data_train").html(response);
                $('#data_train').dataTable( {
                    "pageLength": 5,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": false,
                    "ordering":false,
                }); 
            });
        }
        function notif(data){
            var notification=$("#notification");
            notification.children().html(data);
            notification.css("display","");
            notification.delay(2000).fadeOut();
        }
    </script>
</body>
</html>