<?php 
$server		= "";
$username	= "";
$password	= "";
$database	= "";
$conn	= mysqli_connect($server,$username,$password,$database);
if (!$conn) {
	echo mysqli_connect_error();
}
 ?>