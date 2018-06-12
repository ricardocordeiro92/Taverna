<?php //session_start();
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
              <a class="nav-link js-scroll-trigger" href="#about">O Concurso</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#download">Inscrição</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Section sobre o concurso -->
    <section id="about" class="content-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>O Concurso</h2>
            <p>
              Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Section sobre inscrição -->
    <section id="download" class="download-section content-section text-center">
      <div class="container">
        <div class="col-lg-8 mx-auto">
          <h2>Votação</h2>
          <p>Para votar em sua arte favorita, faça login abaixo!</p>
          <?php
          require_once 'config.php';
          include_once 'conexao.php';
          $Login = $fb->getRedirectLoginHelper();
          $permissions = ['email'];
          try {
              if (isset($_SESSION['facebook_access_token'])) {
                  $accessToken = $_SESSION['facebook_access_token'];
              } else {
                  $accessToken = $Login->getAccessToken();
              }
          } catch (Facebook\Exceptions\FacebookResponseException $e) {
              echo 'Graph returned an error: ' . $e->getMessage();
              exit;
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
          }
          if (isset($accessToken)) {
              if (isset($_SESSION['facebook_access_token'])) {
                  $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
              } else {
                  $_SESSION['facebook_access_token'] = (string) $accessToken;
                  $oAuth2Client = $fb->getOAuth2Client();
                  $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                  $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
                  $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
              }
              if (isset($_GET['code'])) {
                  header('Location: http://localhost/Taverna/TavernaCapivaraSaltitante/index2.php');
              }
              try {
                  $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
                  $profile = $profile_request->getGraphNode()->asArray();
              } catch (Facebook\Exceptions\FacebookResponseException $e) {
                  echo 'Graph returned an error: ' . $e->getMessage();
                  session_destroy();
                  header("Location: http://localhost/Taverna/TavernaCapivaraSaltitante/index2.php");
                  exit;
              } catch (Facebook\Exceptions\FacebookSDKException $e) {
                  echo 'Facebook SDK returned an error: ' . $e->getMessage();
                  exit;
              }
              var_dump($profile);
              $logoff = filter_input(INPUT_GET, 'sair', FILTER_DEFAULT);
              if (isset($logoff) && $logoff == 'true'):
                  session_destroy();
                  header("Location: http://localhost/Taverna/TavernaCapivaraSaltitante/index2.php");
              endif;
              echo '<a href="?sair=true">Sair</a>';
              //var_dump($_SESSION);
          }else {
              $loginUrl = $Login->getLoginUrl('http://localhost/Taverna/TavernaCapivaraSaltitante/index2.php', $permissions);
              echo '<a href="' . $loginUrl . '"><button class="btface"><i class="fa fa-facebook-official faceicone"></i> Entrar com o facebook </button></a>';
              echo $accessToken;
              //var_dump($_SESSION);
          }
          if(isset($profile)){
            $nome = $profile['name'];
            $email = $profile['email'];
            $result_usuario = "SELECT id, nome, email FROM usuarios WHERE email='$email'";
        		$result = mysqli_query($conn, $result_usuario);
        		if($result){
        			$row_usuario = mysqli_fetch_assoc($result);
        			$_SESSION['id'] = $row_usuario['id'];
        			$_SESSION['nome'] = $row_usuario['nome'];
        			$_SESSION['email'] = $row_usuario['email'];
              $_SESSION['valid'] = 1;
        			header("Location: votacao.php");
        		}else{
              $result = mysqli_query($conn, "INSERT INTO usuarios(nome,email) VALUES('$nome', '$email')");

              //display success message
              if(isset($result)){
                echo "<font color='green'>Cadastro realizado!</font>";
              }

              $result_usuario = "SELECT id, nome, email FROM usuarios WHERE email='$email'";
              $result = mysqli_query($conn, $result_usuario);
              if($result){
                $row_usuario = mysqli_fetch_assoc($result);
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['email'];
                $_SESSION['valid'] = 1;
                header("Location: votacao.php");
              }
            }
          }
          ?>
        </div>
      </div>
    </section>

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
