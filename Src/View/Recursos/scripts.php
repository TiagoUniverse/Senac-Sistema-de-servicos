
<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../../Assets/js/materialize.js"></script>
  <script src="../../Assets/js/init.js"></script>

<script>
    function alerta(textoExibido) {
        M.toast({
            html: textoExibido
        });
    }
</script>

<!-- Modal de confirmação -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function() {
        $('.modal').modal();
    });
</script>

