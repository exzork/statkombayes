<?php
require 'connection.php';
$jk=$_POST['jk'];
$sr=$_POST['sr'];
$status=$_POST['status'];
$jt=$_POST['jt'];
$profesi=$_POST['profesi'];
$ppt=$_POST['ppt'];
$kk=$_POST['kartu_kredit'];

$sql=mysqli_query($conn,"INSERT INTO data_train(jenis_kelamin,status_rumah,status,jumlah_tanggungan,profesi,penghasilan,kartu_kredit) VALUES('".$jk."','".$sr."','".$status."','".$jt."','".$profesi."','".$ppt."','".$kk."')");
if(mysqli_affected_rows($conn)>0){
    echo "Success menambahkan data ke data train.";
}else{
    echo "Gagal";
}
?>