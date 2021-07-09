<?php
require 'connection.php';
$id = $_POST['id'];
$sql = mysqli_query($conn,"DELETE FROM data_train where id='".$id."'");
if(mysqli_affected_rows($conn)>0){
    echo 'Berhasil menghapus data';
}
?>