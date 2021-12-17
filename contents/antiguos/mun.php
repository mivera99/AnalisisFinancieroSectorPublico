<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $mun = $_POST["mun"];
    ?>

    <!--  ====== STYLES (CSS) ===== -->
    <link rel="stylesheet" href="styles.css">

    <!--  ====== FONTS ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title><?php echo $mun?> - Scoring</title>
</head>
<body>
    
<?php 
        $conn = new mysqli("localhost", "root", "", "dbs_01");
        $conn->set_charset("utf8");

        /*Datos Bloque General*/
        $sql = "SELECT * from bloque_general_mun where MUNICIPIO = '$mun'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $mun = array();
        $mun["CODIGO_MUN"] = $row["CODIGO_MUN"];
        $mun["CIF_MUNICIPIO"] = $row["CIF_MUNICIPIO"];
        $mun["MUNICIPIO"] = $row["MUNICIPIO"];
        $mun["CODIGO_PROV"] = $row["CODIGO_PROV"];
        $mun["PROVINCIA"] = $row["PROVINCIA"];
        $mun["AUTONOMIA"] = $row["AUTONOMIA"];
        $mun["POBLACION_2020"] = $row["POBLACION_2020"];
        $mun["NOMBREALCALDE"] = $row["NOMBREALCALDE"];
        $mun["APELLIDO1ALCALDE"] = $row["APELLIDO1ALCALDE"];
        $mun["APELLIDO2ALCALDE"] = $row["APELLIDO2ALCALDE"];
        $mun["VIGENCIA"] = $row["VIGENCIA"];
        $mun["PARTIDO"] = $row["PARTIDO"];

        $mun["TIPOVIA"] = $row["TIPOVIA"];
        $mun["NOMBREVIA"] = $row["NOMBREVIA"];
        $mun["NUMVIA"] = $row["NUMVIA"];
        $mun["CODPOSTAL"] = $row["CODPOSTAL"];
        $mun["TELEFONO"] = $row["TELEFONO"];
        $mun["FAX"] = $row["FAX"];
        $mun["WEB"] = $row["WEB"];
        $mun["MAIL"] = $row["MAIL"];

        $mun["PARO_2021"] = $row["PARO_2021"];
        $mun["TRANSAC_INMOBILIARIAS_2021"] = $row["TRANSAC_INMOBILIARIAS_2021"];
        $mun["TRANSAC_INMOBILIARIAS_2020"] = $row["TRANSAC_INMOBILIARIAS_2020"];
        $mun["INGRESOS_2020"] = $row["INGRESOS_2020"];
        $mun["INGRESOS_2019"] = $row["INGRESOS_2019"];
        $mun["FONDLIQUIDOS_2020"] = $row["FONDLIQUIDOS_2020"];
        $mun["FONDLIQUIDOS_2019"] = $row["FONDLIQUIDOS_2019"];
        $mun["DERPENDCOBRO_2020"] = $row["DERPENDCOBRO_2020"];
        $mun["DERPENDCOBRO_2019"] = $row["DERPENDCOBRO_2019"];
        $mun["DEUDACOM_2020"] = $row["DEUDACOM_2020"];
        $mun["DEUDACOM_2019"] = $row["DEUDACOM_2019"];
        $mun["DEUDAFIN_2020"] = $row["DEUDAFIN_2020"];
        $mun["DEUDAFIN_2019"] = $row["DEUDAFIN_2019"];
        $mun["LIQUAJUST_2020"] = $row["LIQUAJUST_2020"];
        $mun["LIQUAJUST_2019"] = $row["LIQUAJUST_2019"];
        $mun["INGRESOSCORR_2020"] = $row["INGRESOSCORR_2020"];
        $mun["INGRESOSCORR_2019"] = $row["INGRESOSCORR_2019"];
        $mun["GASTOSCORR_2020"] = $row["GASTOSCORR_2020"];
        $mun["GASTOSCORR_2019"] = $row["GASTOSCORR_2019"];



        $codigo_mun = $mun["CODIGO_MUN"];
        /* SCORING */
        $sql = "SELECT * from scoring_mun where CODIGO_MUN = '$codigo_mun'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $scoring = $row["RATING_N"];

    ?>


    <h1><?php echo $mun["MUNICIPIO"]?></h1>

    <?php 
        echo '<button href="#" class="scoring '.$scoring.'">'.$scoring.'</button>';
    ?>

    <h3>Código</h3>
    <p><?php echo $mun["CODIGO_MUN"] ?></p>
    <br>

    <h3>CIF</h3>
    <p><?php echo $mun["CIF_MUNICIPIO"] ?></p>
    <br>

    <h3>Provincia</h3>
    <p><?php echo $mun["PROVINCIA"]?></p>
    <br>
    
    <h3>Autonomía</h3>
    <p><?php echo $mun["AUTONOMIA"]?></p>
    <br>

    <h3>Población (2020)</h3>
    <p><?php echo number_format($mun["POBLACION_2020"],0,",",".") ?></p>
    <br>

    <h3>Alcalde</h3>
    <p><?php echo $mun["NOMBREALCALDE"]." ".$mun["APELLIDO1ALCALDE"]." ".$mun["APELLIDO2ALCALDE"] ?></p>
    <br>
    
    <h3>Vigencia</h3>
    <p><?php echo $mun["VIGENCIA"] ?></p>
    <br>
    
    <h3>Partido</h3>
    <p><?php echo $mun["PARTIDO"] ?></p>
    <br>
        
    <h3>Dirección</h3>
    <p><?php echo $mun["TIPOVIA"]." ".$mun["NOMBREVIA"].", ".$mun["NUMVIA"].", ".$mun["CODPOSTAL"]?></p>
    <br>

    <h3>Teléfono</h3>
    <p><?php echo $mun["TELEFONO"] ?></p>
    <br>
    
    <h3>FAX</h3>
    <p><?php echo $mun["FAX"]?></p>
    <br>

    <h3>Web</h3>
    <p><?php echo $mun["WEB"] ?></p>
    <br>

    <h3>Mail</h3>
    <p><?php echo $mun["MAIL"] ?></p>
    <br>

    <h3>PARO_2021</h3>
    <p><?php echo $mun["PARO_2021"] ?></p>
    <br>
    
    <h3>TRANSAC_INMOBILIARIAS_2021</h3>
    <p><?php echo $mun["TRANSAC_INMOBILIARIAS_2021"] ?></p>
    <br>
    
    <h3>TRANSAC_INMOBILIARIAS_2020</h3>
    <p><?php echo $mun["TRANSAC_INMOBILIARIAS_2020"] ?></p>
    <br>

    <h3>INGRESOS_2020</h3>
    <p><?php echo $mun["INGRESOS_2020"] ?></p>
    <br>

    <h3>INGRESOS_2019</h3>
    <p><?php echo $mun["INGRESOS_2019"] ?></p>
    <br>

    <h3>FONDLIQUIDOS_2020</h3>
    <p><?php echo $mun["FONDLIQUIDOS_2020"] ?></p>
    <br>

    <h3>FONDLIQUIDOS_2019</h3>
    <p><?php echo $mun["FONDLIQUIDOS_2019"] ?></p>
    <br>

    <h3>DERPENDCOBRO_2020</h3>
    <p><?php echo $mun["DERPENDCOBRO_2020"] ?></p>
    <br>

    <h3>DERPENDCOBRO_2019</h3>
    <p><?php echo $mun["DERPENDCOBRO_2019"] ?></p>
    <br>

    <h3>DEUDACOM_2020</h3>
    <p><?php echo $mun["DEUDACOM_2020"] ?></p>
    <br>

    <h3>DEUDACOM_2019</h3>
    <p><?php echo $mun["DEUDACOM_2019"] ?></p>
    <br>

    <h3>DEUDAFIN_2020</h3>
    <p><?php echo $mun["DEUDAFIN_2020"] ?></p>
    <br>

    <h3>DEUDAFIN_2019</h3>
    <p><?php echo $mun["DEUDAFIN_2019"] ?></p>
    <br>

    <h3>LIQUAJUST_2020</h3>
    <p><?php echo $mun["LIQUAJUST_2020"] ?></p>
    <br>

    <h3>LIQUAJUST_2019</h3>
    <p><?php echo $mun["LIQUAJUST_2019"] ?></p>
    <br>

    <h3>INGRESOSCORR_2020</h3>
    <p><?php echo $mun["INGRESOSCORR_2020"] ?></p>
    <br>

    <h3>INGRESOSCORR_2019</h3>
    <p><?php echo $mun["INGRESOSCORR_2019"] ?></p>
    <br>

    <h3>GASTOCORR_2020</h3>
    <p><?php echo $mun["GASTOSCORR_2020"] ?></p>
    <br>

    <h3>GASTOCORR_2019</h3>
    <p><?php echo $mun["GASTOSCORR_2019"] ?></p>
    <br>





</body>
</html>