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
 * ║  │ @description: Tela inicial para solicitar um serviço específico                                             │  ║
 * ║  │ @class: servico_tela-inicial                                                                                │  ║
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
// $nomeServico = $_GET['servico'];
$_SESSION['nomeServico'] = trim($_GET['servico']);

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
* │  Colaborador'S SECTION                                                                                        │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Colaborador_repositorio.php";

use model\Colaborador_repositorio;

$Colaborador_repositorio = new Colaborador_repositorio();


$servico_existe = $Servico_repositorio->servico_existe($_SESSION['nomeServico'], $pdo);

if ($servico_existe) {
  $Servico = $Servico_repositorio->consultar_byNome($_SESSION['nomeServico'], $pdo);

  $lista_colaborador = $Colaborador_repositorio->listar_colaboradorServico($Servico[0], $pdo);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />

  <?php
  if ($servico_existe) {
    echo "<title> " . $_SESSION['nomeServico'] . " </title>";
  } else {
    echo "<title> Serviço inválido </title>";
  }
  ?>

  <title><?php echo $_SESSION['nomeServico']; ?> </title>
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

      <?php
      if ($servico_existe == false) {
      ?>
        <h1 class="header center black-text">Serviço inválido </h1>
        <div class="row center">
          <h5 class="header col s12 light">Por favor, tente novamente</h5>
        </div>
      <?php
      } else {
      ?>
        <h1 class="header center black-text"> <?php echo $_SESSION['nomeServico']; ?> </h1>
        <div class="row center">
          <h5 class="header col s12 light">Começe a solicitação de um colaborador abaixo</h5>
        </div>


        <div class="row center">
          <a href="cadastrar servico.php" id="download-button" class="btn-large waves-effect waves-light blue">Filtro</a>


          <form style="display:inline;" action="solicitacao colaborador.php" method="post">
            <input type="hidden" name="nomeServico" value="<?php echo $_GET['servico'] ?> ">
            <input type="hidden" name="idServico" value="<?php echo $Servico[0]; ?> ">
            <button type="submit" id="download-button" class="btn-large waves-effect waves-light orange">Criar nova solicitação</button>
          </form>
        </div>
        <br>

        <table>
          <thead>
            <tr>
              <th>Colaborador</th>
              <th>Opções</th>
              <th>Deletar</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <?php
              if ($lista_colaborador != null) {
                foreach ($lista_colaborador as $colaborador) {
              ?>

                  <th> <?php echo $colaborador[1];  ?> </th>

                  <td>
                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>Drop Me!</a>

                    <!-- Dropdown Structure -->
                    <ul id='dropdown1' class='dropdown-content'>
                      <li><a href="#!">one</a></li>
                      <li><a href="#!">two</a></li>
                      <li class="divider" tabindex="-1"></li>
                      <li><a href="#!">three</a></li>
                      <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
                      <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
                    </ul>
                  </td>

                  <td>
                    <!-- Modal Trigger -->
                    <a class="waves-effect #ef5350 red lighten-1 btn modal-trigger" href="#modal1">Excluir</a>

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                      <div class="modal-content">
                        <h4>Modal Header</h4>
                        <p>A bunch of text</p>
                      </div>
                      <div class="modal-footer">
                        <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Cancelar</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Excluir</a>
                      </div>
                    </div>

                  </td>

              <?php
                }
              }



              ?>
            </tr>
          </tbody>
        </table>



      <?php
      }
      ?>





    </div>

    <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>

  <!-- Dropdown -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(elems, options);
    });

    // Or with jQuery

    $('.dropdown-trigger').dropdown();
  </script>



  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>