<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $dip = $_POST["dip"];
    ?>

    <!--  ====== STYLES (CSS) ===== -->
    <link rel="stylesheet" href="styles.css">

    <!--  ====== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title><?php echo $dip?> - Scoring</title>
</head>
<body>
    
<?php 
        $conn = new mysqli("localhost", "root", "", "dbs_01");
        $conn->set_charset("utf8");

        /*Datos Bloque General*/
        $sql = "SELECT * from bloque_general_dip where DIPUTACION = '$dip'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $dip = array();
        $dip["CODIGO_DIP"] = $row["CODIGO_DIP"];
        $dip["DIPUTACION"] = $row["DIPUTACION"];
        $dip["CIF"] = $row["CIF"];
        $dip["TIPOVIA"] = $row["TIPOVIA"];
        $dip["NOMBREVIA"] = $row["NOMBREVIA"];
        $dip["NUMVIA"] = $row["NUMVIA"];
        $dip["CODPOSTAL"] = $row["CODPOSTAL"];
        $dip["PROVINCIA"] = $row["PROVINCIA"];
        $dip["AUTONOMIA"] = $row["AUTONOMIA"];
        $dip["TELEFONO"] = $row["TELEFONO"];
        $dip["FAX"] = $row["FAX"];
        $dip["WEB"] = $row["WEB"];
        $dip["MAIL"] = $row["MAIL"];

        $dip["INGRESOS_2020"] = $row["INGRESOS_2020"];
        $dip["INGRESOS_2019"] = $row["INGRESOS_2019"];
        $dip["FONDLIQUIDOS_2020"] = $row["FONDLIQUIDOS_2020"];
        $dip["FONDLIQUIDOS_2019"] = $row["FONDLIQUIDOS_2019"];
        $dip["DERPENDCOBRO_2020"] = $row["DERPENDCOBRO_2020"];
        $dip["DERPENDCOBRO_2019"] = $row["DERPENDCOBRO_2019"];
        $dip["DEUDACOM_2020"] = $row["DEUDACOM_2020"];
        $dip["DEUDACOM_2019"] = $row["DEUDACOM_2019"];
        $dip["DEUDAFIN_2020"] = $row["DEUDAFIN_2020"];
        $dip["DEUDAFIN_2019"] = $row["DEUDAFIN_2019"];
        $dip["LIQUAJUST_2020"] = $row["LIQUAJUST_2020"];
        $dip["LIQUAJUST_2019"] = $row["LIQUAJUST_2019"];
        $dip["INGRESOSCORR_2020"] = $row["INGRESOSCORR_2020"];
        $dip["INGRESOSCORR_2019"] = $row["INGRESOSCORR_2019"];
        $dip["GASTOCORR_2020"] = $row["GASTOCORR_2020"];
        $dip["GASTOCORR_2019"] = $row["GASTOCORR_2019"];



        $codigo_dip = $dip["CODIGO_DIP"];
        /* SCORING */
        $sql = "SELECT * from scoring_dip where CODIGO_DIP = '$codigo_dip'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $scoring = $row["RATING_N"];

    ?>


    <h1><?php echo $dip["DIPUTACION"]?></h1>

    <?php 
        echo '<button href="#" class="scoring '.$scoring.'">'.$scoring.'</button>';
    ?>

    <h3>Código</h3>
    <p><?php echo $dip["CODIGO_DIP"] ?></p>
    <br>

    <h3>CIF</h3>
    <p><?php echo $dip["CIF"] ?></p>
    <br>

    <h3>Dirección</h3>
    <p><?php echo $dip["TIPOVIA"]." ".$dip["NOMBREVIA"].", ".$dip["NUMVIA"].", ".$dip["CODPOSTAL"]?></p>
    <br>

    <h3>Provincia</h3>
    <p><?php echo $dip["PROVINCIA"]?></p>
    <br>
    
    <h3>Autonomía</h3>
    <p><?php echo $dip["AUTONOMIA"]?></p>
    <br>
    
    <h3>Teléfono</h3>
    <p><?php echo $dip["TELEFONO"] ?></p>
    <br>
    
    <h3>FAX</h3>
    <p><?php echo $dip["FAX"]?></p>
    <br>

    <h3>Web</h3>
    <p><?php echo $dip["WEB"] ?></p>
    <br>

    <h3>Mail</h3>
    <p><?php echo $dip["MAIL"] ?></p>
    <br>

    <h3>INGRESOS_2020</h3>
    <p><?php echo $dip["INGRESOS_2020"] ?></p>
    <br>

    <h3>INGRESOS_2019</h3>
    <p><?php echo $dip["INGRESOS_2019"] ?></p>
    <br>

    <h3>FONDLIQUIDOS_2020</h3>
    <p><?php echo $dip["FONDLIQUIDOS_2020"] ?></p>
    <br>

    <h3>FONDLIQUIDOS_2019</h3>
    <p><?php echo $dip["FONDLIQUIDOS_2019"] ?></p>
    <br>

    <h3>DERPENDCOBRO_2020</h3>
    <p><?php echo $dip["DERPENDCOBRO_2020"] ?></p>
    <br>

    <h3>DERPENDCOBRO_2019</h3>
    <p><?php echo $dip["DERPENDCOBRO_2019"] ?></p>
    <br>

    <h3>DEUDACOM_2020</h3>
    <p><?php echo $dip["DEUDACOM_2020"] ?></p>
    <br>

    <h3>DEUDACOM_2019</h3>
    <p><?php echo $dip["DEUDACOM_2019"] ?></p>
    <br>

    <h3>DEUDAFIN_2020</h3>
    <p><?php echo $dip["DEUDAFIN_2020"] ?></p>
    <br>

    <h3>DEUDAFIN_2019</h3>
    <p><?php echo $dip["DEUDAFIN_2019"] ?></p>
    <br>

    <h3>LIQUAJUST_2020</h3>
    <p><?php echo $dip["LIQUAJUST_2020"] ?></p>
    <br>

    <h3>LIQUAJUST_2019</h3>
    <p><?php echo $dip["LIQUAJUST_2019"] ?></p>
    <br>

    <h3>INGRESOSCORR_2020</h3>
    <p><?php echo $dip["INGRESOSCORR_2020"] ?></p>
    <br>

    <h3>INGRESOSCORR_2019</h3>
    <p><?php echo $dip["INGRESOSCORR_2019"] ?></p>
    <br>

    <h3>GASTOCORR_2020</h3>
    <p><?php echo $dip["GASTOCORR_2020"] ?></p>
    <br>

    <h3>GASTOCORR_2019</h3>
    <p><?php echo $dip["GASTOCORR_2019"] ?></p>
    <br>



</body>
</html>