<div id="menu">
    <div id="menu-left">
        <a href="index.php">
            <p class="title">Análisis Financiero del Sector Público</p>
            <p class="subtitle">Noster Economia</p>
        </a>
    </div>
    <div id="menu-right">
        <!--<a href="#home">INFORMES</a>-->
        <a href="consultas.php">CONSULTAS</a>
        <a href="sobre_nosotros.php">SOBRE NOSOTROS</a>
        <a href="contacto.php">CONTACTO</a>
        <?php
        if(!isset($_SESSION['email'])) {
        ?>
            <a href="login.php">INICIAR SESIÓN</a>
        <?php
        }
        else {
        ?>
            <a href="perfil.php">PERFIL</a>
        <?php
        }
        ?>
    </div>
</div>