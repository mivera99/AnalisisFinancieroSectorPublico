<div id="menu">
    <div id="menu-left">
        <a href="index">
            <p class="title">Análisis financiero del sector público</p>
            <p class="subtitle">Noster Economía</p>
        </a>
    </div>
    <div id="menu-right">
        <!--<a href="#home">INFORMES</a>-->
        <a href="index">INICIO</a>
        <a href="consultas">CONSULTAS</a>
        <a href="sobre_nosotros">SOBRE NOSOTROS</a>
        <a href="contacto">CONTACTO</a>
        <?php
        if(!isset($_SESSION['email'])) {
        ?>
        <a href="login">INICIAR SESIÓN</a>
        <?php
        }
        else {
        ?>
        <a href="perfil">PERFIL</a>
        <?php
        }
        ?>
    </div>
</div>