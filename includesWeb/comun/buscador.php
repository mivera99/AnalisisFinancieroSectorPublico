<div id="buscador">
    <div class="textoBuscador">
        <h2>Informes financieros para la <b>transparencia</b> del sector público</h2>
        <p>Obten información detallada y actualizada sobre las comunidades autónomas, diputaciones y municipios.</p>
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


