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


$_SESSION['nomeServico'] = null;
$_SESSION['descricaoServico'] = null;
$_SESSION['quantidade_emails'] = null;
$_SESSION['possui_info'] = null;

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Servicos'S SECTION                                                                                           │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Servicos_repositorio.php";

use model\Servicos_repositorio;

$Servico_repositorio = new Servicos_repositorio();

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Status_TemplateEmail'S SECTION                                                                               │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Status_TemplateEmail_repositorio.php";

use model\Status_TemplateEmail_repositorio;

$Status_TemplateEmail_repositorio = new Status_TemplateEmail_repositorio();

$lista_status = $Status_TemplateEmail_repositorio->listar_Status($pdo);


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


  <?php require_once "Recursos/navbar.php"; ?>

  <?php require_once "Recursos/sidebar_comeco.php"; ?>

  <div class="section no-pad-bot" id="index-banner">

    <div class="container">
      <br><br>
      <h1 class="header center black-text">Cadastro de Serviços</h1>
      <div class="row center">
        <h5 class="header col s12 light">Cadastre o serviço no formulário abaixo. </h5>
      </div>

      <h3 class="header col s12 light"> 1. Informações gerais </h3>
      <form action="cadastrar servico2.php" method="post" enctype="multipart/form-data">
        <div class="row center">
          <div class="input-field col s12">
            <!-- <input type="hidden" name="status_cadastro" value="CADASTRANDO UM NOVO SERVIÇO"> -->

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


        <div class="row center">
          <button type="submit" id="download-button" class="btn-large waves-effect waves-light orange">Continuar</button>
        </div>

      </form>


    </div>

    <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>


  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>