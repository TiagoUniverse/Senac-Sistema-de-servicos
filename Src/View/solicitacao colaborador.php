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
 * ║  │ @description: Tela inicial para solicitar o aceite do colaborador em um serviço                             │  ║
 * ║  │ @class: solicitacao colaborador                                                                             │  ║
 * ║  │ @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 27/10/23                                                                                             │  ║
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

// Variáveis
if (isset($_POST['nomeServico'])){
  $_SESSION['nomeServico'] = trim($_POST['nomeServico']);
}


if (isset($_POST['idServico'])){
  $_SESSION['idServico'] = trim($_POST['idServico']);
}



/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  ValidaCPF'S SECTION                                                                                          │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "./Recursos/CpfValidacao.php";

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
  <title><?php echo "Solicitação de: " . $_SESSION['nomeServico']; ?> </title>
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

      <form action="servico_tela-inicial.php" method="get">
        <input type="hidden" name="servico" value="<?php echo $_SESSION['nomeServico']; ?> "> 
        <button class="botao-voltar" type="submit">Voltar</button>
      </form>

      <h1 class="header center black-text"> <?php echo  $_SESSION['nomeServico'] . ": Solicitação de colaborador" ?> </h1>

      <?php
      if (!isset($_POST['status_cadastro'])) {
      ?>
        <div class="row center">
          <h5 class="header col s12 light">Comece o cadastro informando o CPF do colaborador. </h5>
        </div>

        <!-- <h3 class="header col s12 light"> 1. Informações gerais </h3> -->
        <form action="solicitacao colaborador.php" method="post" enctype="multipart/form-data">
          <div class="row center">
            <div class="input-field col s12">
              <input type="hidden" name="status_cadastro" value="SOLICITANDO UM NOVO COLABORADOR">

              <div class="row">
                <div class="row">
                  <div class="input-field col s12">
                    <input value="" name="cpf" id="cpf" type="number" onKeyDown="if(this.value.length==13 && event.keyCode!=8) return false;" class="validate" required>
                    <label for="cpf">CPF:</label>
                  </div>
                </div>

              </div>

            </div>
          </div>


          <div class="row center">
            <button type="submit" id="download-button" class="btn-large waves-effect waves-light orange">Continuar</button>
          </div>

        </form>

      <?php
      } else {
        $validacaoCPF = validaCPF($_POST['cpf']);


        if($validacaoCPF){
          echo "CPF Válido!";
        } else {
           echo "CPF inválido";
        }

      }

      ?>




    </div>

    <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>


  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>