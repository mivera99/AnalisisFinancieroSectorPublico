<div id="menu">
    <div id="menu-left">
        <a href="index.php">
            <p class="title">Análisis financiero del sector público</p>
            <p class="subtitle">Noster Economía</p>
        </a>
    </div>
    <div id="menu-right">
        <!--<a href="#home">INFORMES</a>-->
        <a href="index.php">INICIO</a>
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