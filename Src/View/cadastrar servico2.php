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

if (!isset($_SESSION['possui_info'])   || $_SESSION['possui_info'] == null) {
  $_SESSION['possui_info'] = false;
}


if (isset($_POST['descricao'])  && isset($_POST['nome'])) {
  $_SESSION['nomeServico'] = $_POST['nome'];
  $_SESSION['descricaoServico'] = $_POST['descricao'];

  $_SESSION['possui_info'] = true;
}

if (!isset($_SESSION['quantidade_emails']) || $_SESSION['quantidade_emails'] == null) {
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



// Id do email de aceite de resultado
$id_emailAceite = $lista_status[0][0];
$id_emailResultado = $lista_status[1][0];


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

$contador = 1;
$tipo_Status = count($lista_status);
$opcaoFinal_Status = "";

foreach ($lista_status as $status) {
  if ($contador == $tipo_Status) {
    $opcaoFinal_Status .=  "<option selected value= '" . $status[0] . "' > " . $status[1] . "   </option>";
  } else {
    $opcaoFinal_Status .=  "<option value= '" . $status[0] . "' > " . $status[1] . "   </option>";
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
      if ($_SESSION['possui_info'] == true) {

        /*
      * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
      * │  Usuário já selecionou a quantidade de e-mails                                                                │
      * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
      */
        if (isset($_POST['status_email']) && $_POST['status_email'] == "USUARIO SELECIONOU A QUANTIDADE DE EMAILS") {

          $quantidadeEmails = $_POST['quantidadeEmails'];
      ?>
          <form action="cadastrar servico2.php" method="post" enctype="multipart/form-data">

            <h3 class="header col s12 light"> 2. Personalização de e-mails: </h3>

            <?php
            $email_inicial = 1;
            $email_final = $quantidadeEmails;


            for ($contador = 1; $contador <= $quantidadeEmails; $contador++) {
              $adicionarDestinatarioID = "adicionarDestinatario" . $contador;
              $removerDestinatarioID = "removerDestinatario" . $contador;
            ?>

              <div class="row center">
                <div class="input-field col s12">
                  <h5 class="left header col  light"> <?php echo "2." . $contador; ?> </h5>

                  <div class="row">
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="Descricao" class="materialize-textarea" required></textarea>
                        <label for="Descricao">Descrição do e-mail que será enviado:</label>
                      </div>
                    </div>

                    <!-- Email destinatario -->
                    <div class="row">
                      <label class="left">E-mails destinatários:</label>
                      <div class="input-field col s12">
                      
                        <div class="destinatario-container">
                          <input type="email" name="destinatario[]" required>
                        </div>
                        <button class="btn" type="button" id="<?php echo $adicionarDestinatarioID; ?>">Adicionar Destinatário</button>
                        <button class="btn" type="button" id="<?php echo $removerDestinatarioID; ?>">Remover Destinatário</button>
                      </div>
                    </div>



                    <?php
                    // Tipo de e-mail pré definido

                    if ($contador == $email_inicial) {
                    ?>
                      <input type="hidden" name="tipo_email[]" value="<?php echo $id_emailAceite;  ?>">
                      <div class="row">
                        <div class="input-field col s12">
                          <select disabled>
                            <option value="" disabled selected>Escolha uma opção</option>
                            <?php echo $opcoesTravada_Status; ?>
                          </select>
                          <label>Tipo de e-mail:</label>
                        </div>
                      </div>
                    <?php
                    } else if ($contador == $email_final) {
                    ?>
                      <input type="hidden" name="tipo_email[]" value="<?php echo $id_emailResultado;  ?>">
                      <div class="row">
                        <div class="input-field col s12">
                          <select disabled>
                            <option value="" disabled selected>Escolha uma opção</option>
                            <?php echo $opcaoFinal_Status; ?>
                          </select>
                          <label>Tipo de e-mail:</label>
                        </div>
                      </div>
                    <?php
                    } else {
                    ?>
                      <div class="row">
                        <div class="input-field col s12">
                          <select name="tipo_email[]">
                            <option value="" disabled selected>Escolha uma opção</option>
                            <?php echo $opcoes_Status; ?>
                          </select>
                          <label>Tipo de e-mail:</label>
                        </div>
                      </div>
                    <?php
                    }
                    ?>




                    <label for="ArquivoProjeto">Insira os anexos do email, caso deseje. Os arquivos são opcionais.</label>
                    <div class="file-field input-field">
                      <div class="btn">
                        <span>Arquivo</span>
                        <input type="file" id="ArquivoProjeto" name="ArquivoProjeto[]" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" multiple>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                      </div>
                    </div>

                  </div>


                </div>
              </div>

            <?php
            }
            ?>

            <div class="row center">
              <button type="submit" value="criar_servico" id="download-button" class="btn-large waves-effect waves-light orange">Criar novo serviço</button>
            </div>

          </form>
        <?php
          /*
      * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
      * │  Usuário vai escolher a quantidade de emails                                                                  │
      * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
      */
        } else {
        ?>
          <br>
          <img src="../../Assets/Img/aviso email.png" class="center img-emails">
          <h4 class="header center black-text">Informe a quantidade de e-mails deste serviço:</h4>

          <form action="cadastrar servico2.php" method="POST">
            <input type="hidden" name="status_email" value="USUARIO SELECIONOU A QUANTIDADE DE EMAILS">
            <p class="range-field">
              <input type="range" value="2" id="quantidadeEmails" name="quantidadeEmails" min="2" max="5" />
            </p>

            <div class="row center">
              <button type="submit" id="download-button" class="btn-large waves-effect waves-light orange">Continuar</button>
            </div>
          </form>


          <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" **defer**></script>
        <?php
        }

        ?>



      <?php
      } else {
        /*
      * ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
      * │  Error de cadastro: Usuário tentou acessar tela sem ter definido o nome e a descrição do serviço              │
      * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
      */
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


  <!-- Seção do formulário -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php
      for ($contador = 1; $contador <= $quantidadeEmails; $contador++) {
        $adicionarDestinatarioID = "adicionarDestinatario" . $contador;
        $removerDestinatarioID = "removerDestinatario" . $contador;
      ?>
        const adicionarDestinatarioButton<?php echo $contador; ?> = document.getElementById("<?php echo $adicionarDestinatarioID; ?>");
        const removerDestinatarioButton<?php echo $contador; ?> = document.getElementById("<?php echo $removerDestinatarioID; ?>");

        adicionarDestinatarioButton<?php echo $contador; ?>.addEventListener("click", function() {
          const novoCampoDestinatario = document.createElement("input");
          novoCampoDestinatario.type = "email";
          novoCampoDestinatario.name = "destinatario[]";
          novoCampoDestinatario.required = true;
          const destinatarioContainer = adicionarDestinatarioButton<?php echo $contador; ?>.parentNode.querySelector(".destinatario-container");
          destinatarioContainer.appendChild(novoCampoDestinatario);
        });

        removerDestinatarioButton<?php echo $contador; ?>.addEventListener("click", function() {
          const camposDestinatario = removerDestinatarioButton<?php echo $contador; ?>.parentNode.querySelector(".destinatario-container").querySelectorAll("input[type=email]");
          if (camposDestinatario.length > 1) {
            camposDestinatario[camposDestinatario.length - 1].remove();
          }
        });
      <?php
      }
      ?>
    });
  </script>



  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>