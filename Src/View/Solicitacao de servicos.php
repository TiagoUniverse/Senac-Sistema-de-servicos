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
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Criar serviço</a>
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
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
            <td>$0.87</td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
            <td>$3.76</td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
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

          </tr>
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