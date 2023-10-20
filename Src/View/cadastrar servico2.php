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
 * ║  │ @class: cadastrar servico2                                                                                  │  ║
 * ║  │ @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 21/10/23                                                                                             │  ║
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
$possui_info = false;
if (isset($_POST['descricao'])  && isset($_POST['nome'])) {
  $_SESSION['nomeServico'] = $_POST['nome'];
  $_SESSION['descricaoServico'] = $_POST['descricao'];

  $possui_info = true;
}

if (!isset($_SESSION['quantidade_emails']) || $_SESSION['quantidade_emails'] == null){
  $_SESSION['quantidade_emails'] = 1;
}





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


$opcoes_Status = "";
foreach ($lista_status as $status) {
  $opcoes_Status .=  "<option value= '" . $status[0] . "' > " . $status[1] . "   </option>";
}


$opcoesTravada_Status = "";
$contador = 1;
foreach ($lista_status as $status) {
  if ($contador == 1) {
    $opcoesTravada_Status .=  "<option selected value= '" . $status[0] . "' > " . $status[1] . "   </option>";
  } else {
    $opcoesTravada_Status .=  "<option value= '" . $status[0] . "' > " . $status[1] . "   </option>";
  }
  $contador++;
}



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
      <a href="cadastrar servico.php">Voltar</a>
      <h1 class="header center black-text">Cadastro de Serviços</h1>
      <div class="row center">
        <h5 class="header col s12 light">Cadastre o serviço no formulário abaixo. </h5>
      </div>


      <?php
      if ($possui_info == true) {
      ?>

        <form action="cadastrar servico2.php" method="post" enctype="multipart/form-data">

          <h3 class="header col s12 light"> 2. E-mails </h3>
          <div class="row center">
            <div class="input-field col s12">
              <h5 class="left header col  light"> 2.1 </h5>

              <div class="row">
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="Descricao" class="materialize-textarea"></textarea>
                    <label for="Descricao">Descrição do e-mail que será enviado:</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <select disabled>
                      <option value="" disabled selected>Escolha uma opção</option>
                      <?php echo $opcoesTravada_Status; ?>
                    </select>
                    <label>Tipo de e-mail:</label>
                  </div>
                </div>

                <label for="ArquivoProjeto">Insira os arquivos do projeto, caso deseje. Os arquivos são opcionais.</label>
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Arquivo</span>
                    <input type="file" id="ArquivoProjeto" name="ArquivoProjeto[]" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" multiple required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>

              </div>


              <h5 class="left header col  light"> 2.2 </h5>

              <div class="row">
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="Descricao" class="materialize-textarea"></textarea>
                    <label for="Descricao">Descrição do e-mail que será enviado:</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <select>
                      <option value="" disabled selected>Escolha uma opção</option>
                      <?php echo $opcoes_Status; ?>
                    </select>
                    <label>Tipo de e-mail:</label>
                  </div>
                </div>

                <label for="ArquivoProjeto">Insira os arquivos do projeto, caso deseje. Os arquivos são opcionais.</label>
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Arquivo</span>
                    <input type="file" id="ArquivoProjeto" name="ArquivoProjeto[]" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" multiple required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>

              </div>


            </div>
          </div>

          <div class="row center">

            <button type="submit" value="adicionar_email" id="download-button" class="btn-large waves-effect waves-light orange">Adicionar um novo e-mail</button>
            <button type="submit" value="criar_servico" id="download-button" class="btn-large waves-effect waves-light orange">Criar novo serviço</button>
          </div>

        </form>
      <?php
      } else {
      ?>
        <h5>Erro no cadastro. Por favor, tente novamente.</h5>
      <?php
      }
      ?>




    </div>

    <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function() {
      $('select').formSelect();
    });
  </script>


  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>