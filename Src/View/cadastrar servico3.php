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
// var_dump($_POST['Descricao']);
// echo "<br>";
// var_dump($_POST['destinatario1']);
// echo "<br>";
// var_dump($_POST['destinatario2']);
// echo "<br>";
// var_dump($_POST['tipo_email']);
// echo "<br>";
// var_dump($_POST['templateAceite']);
// echo "<br>";
// var_dump($_FILES['ArquivoProjeto1']);
// echo "<br>";
// var_dump($_POST['quantidadeEmails']);

$quantidadeEmails = $_POST['quantidadeEmails'];


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
* │  Template_Email'S SECTION                                                                                     │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Template_Email_repositorio.php";

use model\Template_Email_repositorio;

$Template_Email_repositorio = new Template_Email_repositorio();

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
  * │  Validações do cadastro                                                                                       │
  * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
  */
  if (
    isset($_POST['Descricao'])
    && isset($_POST['destinatario1'])
    && isset($_POST['tipo_email1'])
    && isset($_POST['templateAceite'])
    && isset($_FILES['ArquivoProjeto1'])
    && isset($_POST['quantidadeEmails'])
  ) {
    $possui_info = true;


    for ($contador = 1; $contador <= $quantidadeEmails; $contador++) {


      $servico_existe = $Servico_repositorio->servico_existe($_SESSION['nomeServico'], $pdo);


      // if ($servico_existe == false) {
        
        // 1ª Cadastro do serviço
        // $Servico_repositorio->cadastro($_SESSION['nomeServico'],  $_SESSION['descricaoServico'] , 1, $pdo);

        // 2ª Cadastro do Template de Email
        $Servico_repositorio->consul

        $nome = 'tipo_email' . $contador;
        // echo $_POST[$nome];
        $Template_Email_repositorio->cadastro()

      }

  } else {
    $possui_info = false;
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











    </div>


    <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>


  <?php require_once "Recursos/footer.php"; ?>


</body>


</html>