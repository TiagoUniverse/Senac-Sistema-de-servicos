<div class="wrapper">
    <div class="sideBar hide-on-med-and-down">
        <ul class="middle hide-on-med-and-down">
            <li class="sideBar-li"><a href="perfil.php">Solicitação de serviço </a></li>

            <li class="sideBar-li">
                <button id="show-services">Serviços</button>
            </li>

            <div id="lista-Servicos" style="display:none;">
                <li>Oi</li>
            </div>

            <!-- <li class="sideBar-li"><button>Serviços</button></li>

            <div id="lista-Servicos" style="display:none;">
                <li>Oi</li>
            </div> -->
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