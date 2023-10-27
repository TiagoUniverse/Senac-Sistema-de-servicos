<?php
/*
* ┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │  Servico'S SECTION                                                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../model/Servicos_repositorio.php";

use model\Servicos_repositorio;

$Servicos_repositorio = new Servicos_repositorio();

$Servicos_sidebar = $Servicos_repositorio->listar_Servicos($pdo);

?>

<div class="wrapper">
    <div class="sideBar hide-on-med-and-down">
        <ul class="middle hide-on-med-and-down">
            <li class="sideBar-li"><a href="Solicitacao de servicos.php">Solicitação de serviço </a></li>

            <li class="sideBar-li">
                <button id="show-services">Serviços</button>
            </li>

            <div id="lista-Servicos" style="display:none;">
                <?php
                $contador = 1;
                foreach ($Servicos_sidebar as $servicos) {
                    // echo "<li> " . $servicos[1] . " </li>";
                ?>
                    <li>
                        <form action="servico_tela-inicial.php" method="GET">
                            <input type="hidden" name="servico" value=" <?php echo $servicos[1]; ?> ">
                            <button class="botao-servicos"> <?php echo $contador . ". "  . $servicos[1];  ?> </button>
                        </form>
                    </li>
                <?php
                    $contador++;
                }
                ?>
            </div>


        </ul>


    </div>


    <script>
        // Adicione um evento de clique para mostrar/ocultar a div
        document.addEventListener('DOMContentLoaded', function() {
            const showServicesButton = document.getElementById('show-services');
            const listaServicos = document.getElementById('lista-Servicos');

            showServicesButton.addEventListener('click', function() {
                if (listaServicos.style.display === 'none' || listaServicos.style.display === '') {
                    listaServicos.style.display = 'block';
                } else {
                    listaServicos.style.display = 'none';
                }
            });
        });
    </script>

    <div class="divPrincipal">