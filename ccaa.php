<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $ccaa = $_POST["ccaa"];
    ?>

    <!--  ====== STYLES (CSS) ===== -->
    <link rel="stylesheet" href="styles.css">

    <!--  ====== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title><?php echo $ccaa?> - Scoring</title>
</head>
<body>
    

    <?php 
        $conn = new mysqli("localhost", "root", "", "dbs_01");
        $conn->set_charset("utf8");

        /*Datos Bloque General*/
        $sql = "SELECT * from bloque_general_ccaa where NOMBRE_CCAA = '$ccaa'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $ccaa = array();
        $ccaa["CODIGO_CCAA"] = $row["CODIGO_CCAA"];
        $ccaa["NOMBRE_CCAA"] = $row["NOMBRE_CCAA"];
        $ccaa["POBLACION_2017"] = $row["POBLACION_2017"];
        $ccaa["NOMBREPRESIDENTE"] = $row["NOMBREPRESIDENTE"];
        $ccaa["APELLIDO1PRESIDENTE"] = $row["APELLIDO1PRESIDENTE"];
        $ccaa["APELLIDO2PRESIDENTE"] = $row["APELLIDO2PRESIDENTE"];
        $ccaa["VIGENCIA"] = $row["VIGENCIA"];
        $ccaa["PARTIDO"] = $row["PARTIDO"];
        $ccaa["CIF"] = $row["CIF"];
        $ccaa["TIPOVIA"] = $row["TIPOVIA"];
        $ccaa["NOMBREVIA"] = $row["NOMBREVIA"];
        $ccaa["NUMVIA"] = $row["NUMVIA"];
        $ccaa["CODPOSTAL"] = $row["CODPOSTAL"];
        $ccaa["FAX"] = $row["FAX"];
        $ccaa["TELEFONO"] = $row["TELEFONO"];
        $ccaa["WEB"] = $row["WEB"];
        $ccaa["MAIL"] = $row["MAIL"];
        $ccaa["REFPIB"] = $row["REFPIB"];
        $ccaa["PIB"] = $row["PIB"];
        $ccaa["REFPIBC"] = $row["REFPIBC"];
        $ccaa["PIBC"] = $row["PIBC"];
        $ccaa["REFRESULTADO"] = $row["REFRESULTADO"];
        $ccaa["RESULTADO"] = $row["RESULTADO"];
        $ccaa["REFDEUDAVIVA"] = $row["REFDEUDAVIVA"];
        $ccaa["DEUDAVIVA"] = $row["DEUDAVIVA"];



        $cif_ccaa = $ccaa["CIF"];
        /* SCORING */
        $sql = "SELECT * from scoring_ccaa where CIF = '$cif_ccaa'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $scoring = $row["RATING_N"];

    ?>


    <h1><?php echo $ccaa["NOMBRE_CCAA"]?></h1>

    <?php 
        echo '<button href="#" class="scoring '.$scoring.'">'.$scoring.'</button>';
    ?>




    <h3>Población (2017)</h3>
    <p><?php echo number_format($ccaa["POBLACION_2017"],0,",",".") ?></p>
    <br>

    <h3>Presidente/a</h3>
    <p><?php echo $ccaa["NOMBREPRESIDENTE"]." ".$ccaa["APELLIDO1PRESIDENTE"]." ".$ccaa["APELLIDO2PRESIDENTE"] ?></p>
    <br>
    
    <h3>Partido</h3>
    <p><?php echo $ccaa["PARTIDO"] ?></p>
    <br>

    <h3>Vigencia</h3>
    <p><?php echo $ccaa["VIGENCIA"] ?></p>
    <br>

    <h3>CIF</h3>
    <p><?php echo $ccaa["CIF"] ?></p>
    <br>

    <h3>Dirección</h3>
    <p><?php echo $ccaa["TIPOVIA"]." ".$ccaa["NOMBREVIA"].", ".$ccaa["NUMVIA"].", ".$ccaa["CODPOSTAL"]?></p>
    <br>
    
    <h3>FAX</h3>
    <p><?php echo $ccaa["FAX"]?></p>
    <br>

    <h3>Teléfono</h3>
    <p><?php echo $ccaa["TELEFONO"] ?></p>
    <br>

    <h3>Web</h3>
    <p><?php echo $ccaa["WEB"] ?></p>
    <br>

    <h3>Mail</h3>
    <p><?php echo $ccaa["MAIL"] ?></p>
    <br>

    <h3>REFPIB</h3>
    <p><?php echo $ccaa["REFPIB"] ?></p>
    <br>

    <h3>PIBC</h3>
    <p><?php echo $ccaa["PIBC"] ?></p>
    <br>

    <h3>REFRESULTADO</h3>
    <p><?php echo $ccaa["REFRESULTADO"] ?></p>
    <br>

    <h3>RESULTADO</h3>
    <p><?php echo $ccaa["RESULTADO"] ?></p>
    <br>

    <h3>REFDEUDAVIVA</h3>
    <p><?php echo $ccaa["REFDEUDAVIVA"] ?></p>
    <br>

    <h3>DEUDAVIVA</h3>
    <p><?php echo $ccaa["DEUDAVIVA"] ?></p>
    <br>
</body>
</html>