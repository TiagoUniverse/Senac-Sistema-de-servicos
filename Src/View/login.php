<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                                   Senac - Aceite                                                  ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ NOTA: Todas as informações contidas neste documento são propriedade do SENAC PERNAMBUCO e seus fornecedores,│  ║
 * ║  │ caso existam. Os conceitos intelectuais e técnicos contidos são propriedade do SENAC PERNAMBUCO e seus      │  ║
 * ║  │ fornecedores e podem estar cobertos pelas patentes nacionais, e estão protegidas por segredo comercial ou   │  ║
 * ║  │ lei de direitos autorais. Divulgação desta informação ou reprodução deste material é estritamente proibido, │  ║
 * ║  │ a menos que seja obtida permissão prévia por escrito do SENAC PERNAMBUCO.                                   │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Screen of login                                                                               │  ║
 * ║  │ @class: login                                                                                               │  ║
 * ║  │ @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 17/10/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 * ║                                                     UPGRADES                                                      ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ 1. @date:                                                                                                   │  ║
 * ║  │    @description:                                                                                            │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║                                                                                                                   ║
 * ╚═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╝
 */
require "C:\\xampp\\htdocs\\Termo-de-compromisso\\config.php";

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Login</title>
  <link href="../../Assets/Icons/android-chrome-192x192.png" rel="icon" type="image/png">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../Assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body id="body_Login">

  <?php require_once "Recursos/scripts.php"; ?>

  <div class="secao-principal section no-pad-bot" id="index-banner">

    <div class="wrapper">

    <!-- Div imagem -->
    <div class=" hide-on-med-and-down">
        <img class="img-login" src="../../Assets/Img/wallpaper/services.jpg"  style="pointer-events: none;">
    </div>

      <div class="containerPrincipal-login">
        <div class="container">
          <img class="senac-logo"  src="../../Assets/Icons/apple-touch-icon.png"  style="pointer-events: none;">
          <h1 class="header center black-text">Sistema de Serviço</h1>
          <!-- <h3 class="header center black-text">Login</h3> -->
          <div class="row center">
            <h5 class="header col s12 light">Entre no sistema com sua conta.</h5>
          </div>

          <form action="login.php" method="post" enctype="multipart/form-data">
            <div class="row center">
              <div class="input-field col s12">
                <input type="hidden" name="status_cadastro" value="CADASTRANDO UM NOVO SERVIÇO">

                <div class="row">
                  <div class="row">
                    <div class="input-field col s12">
                      <input value="" name="email" id="email" type="email" class="validate" required>
                      <label for="email">E-mail:</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col s12">
                      <input value="" name="senha" id="senha" type="password" class="validate" required>
                      <label for="senha">Senha:</label>
                    </div>
                  </div>
                </div>

              </div>

              <button type="submit" id="download-button" class="btn-large waves-effect waves-light orange">Acessar</button>
            </div>
          </form>

        </div>

      </div>
    </div>


  </div>


  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/Termo-de-compromisso/sw.js', {
        scope: '/Termo-de-compromisso/'
      });
    }
  </script>

</body>

</html>