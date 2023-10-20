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
 * ║  │ @description: Tela de solicitação de 'Servicos'                                                             │  ║
 * ║  │ @class: Solicitacao de servicos                                                                             │  ║
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

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Servicos'S SECTION                                                                                           │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Servicos_repositorio.php";

use model\Servicos_repositorio;

$Servico_repositorio = new Servicos_repositorio();

$lista_Servicos = $Servico_repositorio->listar_Servicos($pdo);

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Usuario'S SECTION                                                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Usuario_repositorio.php";

use model\Usuario_repositorio;

$Usuario_repositorio = new Usuario_repositorio();


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Solicitação de Serviços</title>
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
      <h1 class="header center black-text">Solicitação de Serviços</h1>
      <div class="row center">
        <h5 class="header col s12 light">Crie novos serviços ou gerencie os serviços existentes.</h5>
      </div>

      <div class="row center">
        <a href="cadastrar servico.php" id="download-button" class="btn-large waves-effect waves-light orange">Criar serviço</a>
      </div>
      <br>

      <table>
        <thead>
          <tr>
            <th>Serviço</th>
            <th>Fundador</th>
            <th>Opções</th>
            <th>Deletar</th>
          </tr>
        </thead>

        <tbody>

          <?php
          if (!empty($lista_Servicos)) {
            // var_dump($lista_Servicos);

            foreach ($lista_Servicos as $servicos) {
              $nomeFundador = $Usuario_repositorio->consulta_fundador($servicos[6], $pdo);

              echo "<tr>";

              echo "<td> " . $servicos[1] . " </td>";
              echo "<td> " . $nomeFundador . " </td>";

          ?>
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

              echo "</tr>";
            }
          } else {
            echo "<tr><td> Nenhum serviço cadastrado. </td> </tr>";
          }
          ?>


        </tbody>
      </table>

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