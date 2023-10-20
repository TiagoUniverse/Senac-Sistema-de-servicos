<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               Sistema de Serviços                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ NOTA: Todas as informações contidas neste documento são propriedade do SENAC PERNAMBUCO e seus fornecedores,│  ║
 * ║  │ caso existam. Os conceitos intelectuais e técnicos contidos são propriedade do SENAC PERNAMBUCO e seus      │  ║
 * ║  │ fornecedores e podem estar cobertos pelas patentes nacionais, e estão protegidas por segredo comercial ou   │  ║
 * ║  │ lei de direitos autorais. Divulgação desta informação ou reprodução deste material é estritamente proibido, │  ║
 * ║  │ a menos que seja obtida permissão prévia por escrito do SENAC PERNAMBUCO.                                   │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Cadastro de Serviço                                                                           │  ║
 * ║  │ @class: cadastrar servico                                                                                   │  ║
 * ║  │ @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 18/10/23                                                                                             │  ║
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

require_once "conexao.php";

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Servicos'S SECTION                                                                                           │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Servicos_repositorio.php";

use model\Servicos_repositorio;

$Servico_repositorio = new Servicos_repositorio();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Cadastro de Serviços</title>
  <link href="../../Assets/Icons/android-chrome-192x192.png" rel="icon" type="image/png">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../../Assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../../Assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>

  <?php require_once "Recursos/scripts.php"; ?>


  <?php
  /*
  * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
  * │  Cadastro'S SECTION                                                                                           │
  * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
  */
  if (isset($_POST['status_cadastro']) && $_POST['status_cadastro'] == "CADASTRANDO UM NOVO SERVIÇO") {


    $servico_existe = $Servico_repositorio->servico_existe($_POST['nome'], $pdo);

    if ($servico_existe == false) {
      $Servico_repositorio->cadastro($_POST['nome'], $_POST['descricao'], 1, $pdo);

  ?>
      <script>
        M.toast({
          html: 'Cadastro de um serviço com sucesso!'
        });
      </script>
    <?php
    } else {
    ?>
      <script>
        M.toast({
          html: 'Este serviço já foi cadastrado!'
        });
      </script>
  <?php
    }
  }

  ?>

  <?php require_once "Recursos/navbar.php"; ?>

  <?php require_once "Recursos/sidebar_comeco.php"; ?>

  <div class="section no-pad-bot" id="index-banner">

    <div class="container">
      <br><br>
      <h1 class="header center black-text">Cadastro de Serviços</h1>
      <div class="row center">
        <h5 class="header col s12 light">Cadastre o serviço no formulário abaixo. </h5>
      </div>

      <h3 class="header col s12 light"> Informações gerais </h3>
      <form action="cadastrar servico.php" method="post" enctype="multipart/form-data">
        <div class="row center">
          <div class="input-field col s12">
            <input type="hidden" name="status_cadastro" value="CADASTRANDO UM NOVO SERVIÇO">

            <div class="row">
              <div class="row">
                <div class="input-field col s12">
                  <input value="" name="nome" id="nome" type="text" class="validate" required>
                  <label for="nome">Nome do serviço:</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <input value="" name="descricao" id="descricao" type="text" class="validate" required>
                  <label for="descricao">Descrição:</label>
                </div>
              </div>
            </div>

          </div>
        </div>

        <h3 class="header col s12 light"> E-mails </h3>
        <div class="row center">
          <div class="input-field col s12">
            <input type="hidden" name="status_cadastro" value="CADASTRANDO UM NOVO SERVIÇO">

            <div class="row">
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="textarea1" class="materialize-textarea"></textarea>
                  <label for="textarea1">Textarea</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <input value="" name="descricao" id="descricao" type="text" class="validate" required>
                  <label for="descricao">Descrição:</label>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="row center">
          <button type="submit" id="download-button" class="btn-large waves-effect waves-light orange">Criar novo serviço</button>
        </div>

      </form>


    </div>

    <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>


  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>