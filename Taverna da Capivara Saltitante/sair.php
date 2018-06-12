<?php
  session_start();
  unset($_SESSION['valid'], $_SESSION['id'], $_SESSION['nome'], $_SESSION['email'],$_SESSION['face_access_token']);
  session_destroy();
  session_start();
  $_SESSION['msg'] = "Deslogado com sucesso!";
  header("Location: index2.php");
?>
