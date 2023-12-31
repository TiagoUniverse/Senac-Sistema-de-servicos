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
// var_dump($_POST['tipo_email1']);
// echo "<br>";
// var_dump($_POST['templateAceite']);
// echo "<br>";
// var_dump($_FILES['ArquivoProjeto2']);
// echo "<br>";
// var_dump($_POST['quantidadeEmails']);

$quantidadeEmails = $_POST['quantidadeEmails'];
$descricao = $_POST['Descricao'];


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

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Email_destinatario'S SECTION                                                                                 │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Email_destinatario_repositorio.php";

use model\Email_destinatario_repositorio;

$Email_destinatario_repositorio = new Email_destinatario_repositorio();

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Template_TelaAceite'S SECTION                                                                                │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Template_TelaAceite_repositorio.php";

use model\Template_TelaAceite_repositorio;

$Template_TelaAceite_repositorio = new Template_TelaAceite_repositorio();

/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Anexo'S SECTION                                                                                              │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Anexo_repositorio.php";

use model\Anexo_repositorio;

$Anexo_repositorio = new Anexo_repositorio();

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
  $fundo_vermelho = true;

// validar se existe algum email diretorio vazio
// for ($contadorEmail = 1; $contadorEmail <= $_POST['quantidadeEmails']; $contadorEmail++ ){
//   $nome = "destinatario" . $contadorEmail;

//   echo $nome;
//   if ($_POST[$nome] == null){
//     echo "tem um faltando!!";
//   } else{
//     echo $_POST[$nome] . "<br>";
//   }
// }

if (
  isset($_POST['Descricao'])
  && isset($_POST['destinatario1'])
  && isset($_POST['tipo_email1'])
  && isset($_POST['templateAceite'])
  && isset($_FILES['ArquivoProjeto1'])
  && isset($_POST['quantidadeEmails'])
) {
  $possui_info = true;

  $servico_existe = $Servico_repositorio->servico_existe($_SESSION['nomeServico'], $pdo);


  if ($servico_existe == false) {

    // 1ª Cadastro do serviço
    $Servico_repositorio->cadastro($_SESSION['nomeServico'],  $_SESSION['descricaoServico'], 1, $pdo);

    // 2ª consulta do serviço criado
    $Servico = $Servico_repositorio->consultar_byNome($_SESSION['nomeServico'], $pdo);

    // Cadastro das informações de email do serviço:
    for ($contador = 1; $contador <= $quantidadeEmails; $contador++) {

      // 3ª Cadastro do Template de Email
      $nome_TipoEmail = 'tipo_email' . $contador;

      $Template_Email_repositorio->cadastro($descricao[$contador - 1], $contador, $_POST[$nome_TipoEmail], $Servico[0], $pdo);

      // 4ª Consultar o Template de E-mail que acabou de ser criado
      $Template_Email = $Template_Email_repositorio->consultar_templateCriado($descricao[$contador - 1], $Servico[0], $pdo);


      // 5ª Cadastro dos e-mails destinatários de um respectivo template de e-mail        
      $nome_EmailDestinatario = 'destinatario' . $contador;

      foreach ($_POST[$nome_EmailDestinatario] as $destinatario) {
        $Email_destinatario_repositorio->cadastro($destinatario, $Template_Email[0], $pdo);
      }


      // 6ª Cadastro do Template de Tela de Aceite, caso necessário
      if ($_POST[$nome_TipoEmail] == 1) {
        $Template_TelaAceite_repositorio->cadastro($_POST['Descricao'][$contador - 1], $Template_Email[0], $pdo);
      }

      // 7ª Cadastro dos Anexos de um Template de E-mail
      /**
       * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
       * ║                                         Anexo da tela de Aceite                                               ║
       * ╚═══════════════════════════════════════════════════════════════════════════════════════════════════════════════╝
       */


      $nomeArquivo = "ArquivoProjeto" . $contador;
      $Arquivo_temporario = $_FILES[$nomeArquivo];


      foreach ($Arquivo_temporario['name'] as $indice => $nome) {
        $nome_temporario = $Arquivo_temporario['tmp_name'][$indice];
        $tipo = $Arquivo_temporario['type'][$indice];

        // Verificação se o arquivo é válido
        if ($nome_temporario != "" && is_uploaded_file($nome_temporario)) {
          // Nome original do arquivo
          $nome_original = $nome;

          // Um nome único para o arquivo
          $novoNome = time() . '.' . $nome;

          // Diretório do arquivo
          $diretorio = 'Docs/';

          // Caminho completo do arquivo
          $caminhoCompleto = $diretorio . $novoNome;

          // Movendo o arquivo para o diretório de destino
          if (move_uploaded_file($nome_temporario, $caminhoCompleto)) {
            // Salvando no banco de dados
            $Anexo_repositorio->cadastro($nome_original, $novoNome, $tipo, $caminhoCompleto, $Template_Email[0], 2, $pdo);
          }
        }
      }


      // 8ª Cadastro dos anexos do e-mail
      /**
       * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
       * ║                                         Anexo da tela de Aceite                                               ║
       * ╚═══════════════════════════════════════════════════════════════════════════════════════════════════════════════╝
       */


      $nomeArquivo = "ArquivoEmail" . $contador;
      $Arquivo_temporario = $_FILES[$nomeArquivo];


      foreach ($Arquivo_temporario['name'] as $indice => $nome) {
        $nome_temporario = $Arquivo_temporario['tmp_name'][$indice];
        $tipo = $Arquivo_temporario['type'][$indice];

        // Verificação se o arquivo é válido
        if ($nome_temporario != "" && is_uploaded_file($nome_temporario)) {
          // Nome original do arquivo
          $nome_original = $nome;

          // Um nome único para o arquivo
          $novoNome = time() . '.' . $nome;

          // Diretório do arquivo
          $diretorio = 'Docs/';

          // Caminho completo do arquivo
          $caminhoCompleto = $diretorio . $novoNome;

          // Movendo o arquivo para o diretório de destino
          if (move_uploaded_file($nome_temporario, $caminhoCompleto)) {
            // Salvando no banco de dados
            $Anexo_repositorio->cadastro($nome_original, $novoNome, $tipo, $caminhoCompleto, $Template_Email[0], 1, $pdo);
          }
        }
      }
    }
    $mensagem_resultado = "Cadastro de um serviço com sucesso!";
    $fundo_vermelho = false;
?>
    <script>
      M.toast({
        html: $mensagem_resultado
      });
    </script>
  <?php
  } else {
    $mensagem_resultado = "Este serviço já existe. Por favor, tente cadastrar outro serviço.";
  ?>
    <script>
      M.toast({
        html: $mensagem_resultado
      });
    </script>
  <?php
  }
} else {
  $possui_info = false;

  $mensagem_resultado = "Erro no cadastro do serviço. Por favor, tente novamente.";
  ?>
  <script>
    M.toast({
      html: 'Erro no cadastro do serviço. Por favor, tente novamente.'
    });
  </script>
<?php
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
        <h5 class="header col s12 light">Resultado do cadastro. </h5>
      </div>


      <br><br>
      <?php
      if ($fundo_vermelho) {
      ?>
        <div class="container box-resultado fundo_vermelho">
        <?php
      } else {
        ?>
          <div class="container box-resultado fundo_verde">
          <?php
        }
          ?>





          <?php echo "<h4>" . $mensagem_resultado . "</h4>"; ?>
          </div>








        </div>


        <?php require_once "Recursos/sidebar_fim.php"; ?>
    </div>


    <?php require_once "Recursos/footer.php"; ?>


</body>


</html>