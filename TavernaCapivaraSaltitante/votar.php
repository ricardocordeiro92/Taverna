<?php
session_start();
if (!isset($_SESSION['valid'])){
  header("Location:index2.php");
}

include_once 'conexao.php';

if(isset($_POST['Submit'])) {
	$id = $_SESSION['id'];
  $voto = $_POST['votacao'];
  $verificar = "SELECT id_usuario FROM votos WHERE id_usuario='$id'";
  $result = mysqli_query($conn, $verificar);
  $numreg = mysqli_num_rows($result);
  if($numreg){
    $_SESSION['msg'] = 1;
    header("Location: votacao.php");
  }else{
    $result = mysqli_query($conn, "INSERT INTO votos(id_usuario, voto) VALUES('$id', '$voto')");
    $_SESSION['msg'] = 2;
    header("Location: votacao.php");
  }
  echo $_SESSION['msg'];
}else{
  echo "oi";
}
?>
