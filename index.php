<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  ====== STYLES (CSS) ===== -->
    <link rel="stylesheet" href="index_styles.css">

    <!--  ====== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!--  ====== FUNCIÓN AUTOCOMPLETAR BÚSQUEDA ===== -->
    <script src="functions.js"></script>


    <title>Análisis Financiero en el Sector Público</title>
</head>
    <body>
        <h1>Análisis Financiero en el Sector Público</h1>
        <br>

        <!-- ===== COMUNIDADES AUTÓNOMAS ===== -->

        <h2>Scoring de CCAA</h2>
        <p>Busca una Comunidad Autónoma de la lista para visualizar datos sobre esta</p>
        <br>

        <?php 
            $conn = new mysqli("db5005176895.hosting-data.io", "dbu1879501", "ij1YGZo@gIEKAJ#&PcCXpHR0o", "dbs4330017");
            $conn->set_charset("utf8");


            $sql = "SELECT NOMBRE_CCAA FROM bloque_general_ccaa";

            $result = mysqli_query($conn, $sql);
            $CCAAs = array();

            while($nombre = mysqli_fetch_array($result)){
                array_push($CCAAs, $nombre["NOMBRE_CCAA"]);
            }
        ?>
        
        <form autocomplete="off" action="ccaa.php" method="post">
            <div class="autocomplete" style="width:300px;">
                <input id="comunidades" type="text" name="ccaa" placeholder="Comunidad Autónoma">
            </div>
            <input type="submit">
        </form>
        <br><br>

        


        <!-- ===== DIPUTACIONES ===== -->

        <h2>Scoring de Diputaciones</h2>
        <p>Busca una Diputación de la lista para visualizar datos sobre esta</p>
        <br>

        <?php 
            $sql = "SELECT DIPUTACION FROM bloque_general_dip";

            $result = mysqli_query($conn, $sql);
            $DIPs = array();

            while($nombre = mysqli_fetch_array($result)){
                array_push($DIPs, $nombre["DIPUTACION"]);
            }
 
        ?>
        
        <form autocomplete="off" action="dip.php" method="post">
            <div class="autocomplete" style="width:300px;">
                <input id="diputaciones" type="text" name="dip" placeholder="Diputación">
            </div>
            <input type="submit">
        </form>
        <br><br>



        <!-- ===== MUNICIPIOS ===== -->

        <h2>Scoring de Municipios</h2>
        <p>Busca un Municipio de la lista para visualizar datos sobre este</p>
        <br>

        <?php 
            $sql = "SELECT MUNICIPIO FROM bloque_general_mun";

            $result = mysqli_query($conn, $sql);
            $MUNs = array();

            while($nombre = mysqli_fetch_array($result)){
                array_push($MUNs, $nombre["MUNICIPIO"]);
            }
 
        ?>
        
        <form autocomplete="off" action="mun.php" method="post">
            <div class="autocomplete" style="width:300px;">
                <input id="municipios" type="text" name="mun" placeholder="Municipio">
            </div>
            <input type="submit">
        </form>


        







        <script>
            /*An array containing all the country names in the world:*/
            var comunidades = <?php echo json_encode($CCAAs);?>;
            var municipios = <?php echo json_encode($MUNs);?>;
            var diputaciones = <?php echo json_encode($DIPs);?>;

            /*initiate the autocomplete function on the "myInput" element, and pass along the comunidades array as possible autocomplete values:*/
            autocomplete(document.getElementById("comunidades"), comunidades);
            autocomplete(document.getElementById("municipios"), municipios);
            autocomplete(document.getElementById("diputaciones"), diputaciones);
        </script>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        
    </body>
</html>