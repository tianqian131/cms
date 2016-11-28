<?
session_start();
$_SESSION['isLogin'] = 0;
// print_r($_SESSION);die;
echo "<script>window.location.href='/object/admin/login.php'</script>";

?>