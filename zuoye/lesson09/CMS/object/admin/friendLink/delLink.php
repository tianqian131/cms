<?php
include("../public/connectDb.php");
if($_GET){
	$id = $_GET['id'];
	$sql = "DELETE FROM friendlink WHERE id={$id}";
	if(mysql_query($sql)){
		echo "<script>window.location.href='friendLink.php'</script>";
	}
}

?>