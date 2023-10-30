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
 * ║  │ @description: Resultado da solicitação de colaborador de um serviço                                         │  ║
 * ║  │ @class: solicitacao colaborador2                                                                            │  ║
 * ║  │ @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 30/10/23                                                                                             │  ║
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
$nomeColaborador = $_POST['nomeColaborador'];
$cpf = $_POST['cpf'];
$email_pessoal = $_POST['email_pessoal'];
$telefone = $_POST['telefone'];

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Colaborador'S SECTION                                                                                        │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Colaborador_repositorio.php";

use model\Colaborador_repositorio;

$Colaborador_repositorio = new Colaborador_repositorio();

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Timeline'S SECTION                                                                                           │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Timeline_repositorio.php";

use model\Timeline_repositorio;

$Timeline_repositorio = new Timeline_repositorio();

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Validation' SECTION                                                                                          │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/
$fundo_vermelho = true;
if (!isset($_POST['nomeColaborador'])) {
  $mensagem = "Nome do colaborador não encontrado.";
} else if (!isset($_POST['cpf'])) {
  $mensagem = "CPF do colaborador não encontrado.";
} else if (!isset($_POST['email_pessoal'])) {
  $mensagem = "E-mail pessoal do colaborador não encontrado.";
} else if (!isset($_POST['telefone'])) {
  $mensagem = "Telefone do colaborador não encontrado";
} else if (strlen($_POST['nomeColaborador']) > 200) {
  $mensagem = "Nome do colaborador ultrapassou o limite. Por favor, preencha novamente";
} else if (strlen($cpf) < 11) {
  $mensagem = "CPF com digitos insuficientes. Por favor, preencha novamente";
} else if (filter_var($_POST['email_pessoal'], FILTER_VALIDATE_EMAIL) == false) {
  $mensagem = "E-mail pessoal cadastrado incorretamente. Por favor, preencha novamente";
} else if ($Colaborador_repositorio->existe_cpf($_POST['cpf'] , $_SESSION['idServico'] , $pdo ) == true){
  $mensagem = "Solicitação de colaborador já criada! Por favor, solicite para outro colaborador.";
} else {
  $fundo_vermelho = false;

  $mensagem = "Solicitação de colaborador feita com sucesso!";

  // 1ª Cadastro da solicitacao do colaborador
  $Colaborador_repositorio->cadastro($nomeColaborador, $cpf, $email_pessoal, $telefone, $_SESSION['idServico'] , $pdo);

  // 2ª Consultar Colaborador
  $Colaborador = $Colaborador_repositorio->consultar_colaboradorCriado($cpf, $_SESSION['idServico'] , $pdo);

  // 3ª Cadastro da timeline
  $Timeline_repositorio->cadastrar_timeline("Solicitação do colaborador criado. Aguardando o aceite do colaborador através do e-mail." , $Colaborador[0], 1, $pdo );

}


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

      <h3 class="header center black-text">Resultado:</h3>
      <br>
      <?php
      if ($fundo_vermelho) {
        echo "<div class='div-error'>";
      } else {
        echo "<div class='div-sucess'>";
      }
      ?>
      <h3 class='header center col s12 light'> <?php echo $mensagem; ?> </h3>
    </div>


  </div>

  <?php require_once "Recursos/sidebar_fim.php"; ?>
  </div>


  <?php require_once "Recursos/footer.php"; ?>

</body>

</html>