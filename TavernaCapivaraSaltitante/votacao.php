<?php session_start();
if (!isset($_SESSION['valid'])){
  header("Location:index2.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Taverna</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="js-scroll-trigger" href="#page-top">Taverna da Capivara Saltitante</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="sair.php">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Intro Header -->
    <header class="mastheadvot">
      <div class="intro-body">
        <div class="container">
          <p style="text-align: left;">Bem Vindo (a), <?php echo $_SESSION['nome']; ?>!</p>
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <h2>Votação</h2>
                <p>Vote abaixo em sua arte favorita! Lembre-se, você só poderá votar uma vez.</p>
              <?php
                if(isset($_SESSION['msg'])){
                  if($_SESSION['msg'] == 1){
                    ?><p><font color="red">Infelizmente você só pode votar uma vez. Voto já computado anteriormente!</font></p><?php
                  	unset($_SESSION['msg']);
                  }else{
                    ?><p><font color="green">Voto computado com sucesso!</font></p><?php
                    unset($_SESSION['msg']);
                  }
                }?>
                <form class="form-group" action="Votar.php" method="post">
                  <div class="btn payment-method">
                  <input name="votacao" type="radio" id="1" value="1" checked>
                  <label class="method img1" for="1"></label>
                </div>
                <div class="btn payment-method">
                  <input name="votacao" type="radio" id="2"  value="2">
                  <label class="method img2" for="2"></label>
                </div>
                <div class="btn payment-method">
                  <input name="votacao" type="radio" id="3"  value="3">
                  <label class="method img3" for="3"></label>
                </div>
                <div class="btn payment-method">
                  <input name="votacao" type="radio" id="4"  value="4">
                  <label class="method img4" for="4"></label>
                </div>
                <div class="btn payment-method">
                  <input name="votacao" type="radio" id="5"  value="5">
                  <label class="method img5" for="5"></label>
                </div>
                <div class="btn payment-method">
                  <input name="votacao" type="radio" id="6"  value="6">
                  <label class="method img6" for="6"></label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="posicaobotao">
                  <button type="submit" name="Submit" class="btface"><i class="fa fa-thumbs-up faceicone"></i> Votar </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </header>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h6>Contato</h6>
            <p>
              <i class="fa fa-map-marker"></i> Av. Bento Rodrigues Nóia, 30 - Boa Esperança, Seropédica - RJ
            </p>
            <p>
              <i class="fa fa-phone"></i> (21) 97677-5535
            </p>
          </div>
          <div class="col-md-3">
            <h6>Redes Sociais</h6>
            <div class="social-icons">
              <ul class="list-unstyled text-center mb-0">
                <li class="list-unstyled-item">
                  <a href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <h6>Desenvolvimento</h6>
            <img class="signal" src="img/logo-signal.png">
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>

  </body>

</html>
