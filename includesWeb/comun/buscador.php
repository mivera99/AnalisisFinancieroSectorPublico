<div id="buscador">
    <div class="textoBuscador">
        <a href="index">
            <p class="title">Análisis financiero del sector público</p>
            <p class="subtitle">Noster Economía</p>
        </a>
       
        <script>cargarNombres();</script>
    </div>
    <div class="barraBuscador">
        <form autocomplete="off" action="redirect.php" method="post">
        <div class="autocomplete">
            <input id="facility" type="text" name="facilities" placeholder="Escribir aquí...">
            <button>Consultar</button>
        </div>
        </form>
        <script>autocomplete(document.getElementById("facility"));</script>
        <?php
            if (isset($show_message)) {
                echo "<script>alert('{$show_message}');</script>";
                $show_message=null;
            }
        ?>
    </div>
</div>


