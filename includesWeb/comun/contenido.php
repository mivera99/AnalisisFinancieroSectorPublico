<?php 
require_once('includesWeb/config.php'); // Temporal
//require_once('includesWeb/daos/DAOConsultor.php');
?>
<h3>Informes financieros para la <b>transparencia</b> del sector público</h3>
<p>Obten información detallada y actualizada sobre CCAAs.</p>
<p>Provincias, diputaciones y municipios en segundos.</p>
<?php

    /*$conn = new mysqli("db5005176895.hosting-data.io", "dbu1879501", "ij1YGZo@gIEKAJ#&PcCXpHR0o", "dbs4330017");
    $conn->set_charset("utf8");


    $sql = "SELECT NOMBRE_CCAA FROM bloque_general_ccaa";

    $result = mysqli_query($conn, $sql);
    $CCAAs = array();

    while($nombre = mysqli_fetch_array($result)){
        array_push($CCAAs, $nombre["NOMBRE_CCAA"]);
    }*/
    //$facilities = (new DAOConsultor()).getAllFacilities();
    
?>
<!--<form autocomplete="off" action="institucion.php" method="post">
    <div class="autocomplete" style="width:300px;">
        <input id="instituciones" type="text" name="institucion" placeholder="Instituciones">
    </div>
    <input type="submit">
</form>
<br><br>
<script>
    /*An array containing all the country names in the world:*/
    var instituciones = <?php echo json_encode($facilities);?>;

    /*initiate the autocomplete function on the "myInput" element, and pass along the comunidades array as possible autocomplete values:*/
    autocomplete(document.getElementById("instituciones"), instituciones);
</script>-->
<?php
    /*   Consulta Ratings año 2020   */
    $datos = array(20,12,3,7,14,5);
    $etiquetas = array('A', 'B', 'C', 'D', 'E', 'F');

    $conn = getConexionBD();//new mysqli("localhost", "root", "", "dbs_01");
    $sql = "SELECT RATING, COUNT(RATING) FROM scoring_ccaa WHERE ANHO = '2020' GROUP BY RATING";
    $result = mysqli_query($conn, $sql);

    $etiquetasRating2020 = array();
    $datosRating2020 = array();

    while($row = $result->fetch_assoc()) {
        array_push($etiquetasRating2020, $row["RATING"]);
        array_push($datosRating2020, $row["COUNT(RATING)"]);
    };

    $colorRatings = array();

    foreach($etiquetasRating2020 as $i){
        switch ($i){
            case "A":
                array_push($colorRatings,"rgb(17, 102, 17)");
                break;
            case "B":
                array_push($colorRatings,"rgb(154, 205, 50)");
                break;
            case "C":
                array_push($colorRatings,"rgb(240, 217, 11)");
                break;
            case "D":
                array_push($colorRatings,"rgb(240, 129, 2)");
                break;
            case "E":
                array_push($colorRatings,"rgb(255, 0, 0)");
                break;

        }
    };

?>


<h1>Consultas de prueba</h1>
<br><br><br>

<p>Conteo de Ratings en CCAA en 2020 (COLORES)</p>
<div class="graficos">
    <div><canvas id="barChartColor" height="300" width="450"></canvas></div>
    <div><canvas id="lineChartColor" height="300" width="450"></canvas></div>
    <div><canvas id="pieChartColor" height="300" width="450"></canvas></div>
</div>

<br><br>

<p>Conteo de Ratings en CCAA en 2020</p>

<div class="graficos">
    <div><canvas id="barChart" height="300" width="450"></canvas></div>
    <div><canvas id="lineChart" height="300" width="450"></canvas></div>
    <div><canvas id="pieChart" height="300" width="450"></canvas></div>
</div>




<script>
    //Variables PHP
    var datos = <?php echo json_encode($datos)?>;
    var etiquetas = <?php echo json_encode($etiquetas)?>;

    var datosRating2020 = <?php echo json_encode($datosRating2020)?>;
    var etiquetasRating2020 = <?php echo json_encode($etiquetasRating2020)?>;
    var colorRatings = <?php echo json_encode($colorRatings)?>;

    /*  setup  */
    //data
    const data = {
        labels: etiquetasRating2020,
        datasets: [{
            label: ' Conteo',
            data: datosRating2020,
            color: '#003E99',
            backgroundColor: colorRatings,
            hoverBackgroundColor: '#003E99',
            hoverBorderColor: 'rgba(0,0,0,1)',
            hoverBorderWidth: 2
        }]
    };

    //dataLineChart
    const datalinea = {
        labels: etiquetasRating2020,
        datasets: [{
            label: ' Rating',
            data: datosRating2020,
            color: '#003E99',
            borderColor: '#003E99',
            backgroundColor: colorRatings,
            hoverBackgroundColor: '#003E99',
            hoverBorderColor: 'rgba(0,0,0,1)',
            hoverBorderWidth: 2,
            pointRadius: 5
        }]
    };

    //data COLOR
    const dataColor = {
        labels: etiquetasRating2020,
        datasets: [{
            label: ' Conteo',
            data: datosRating2020,
            color: '#003E99',
            backgroundColor: '#003E99',
            hoverBackgroundColor: '#5287D5',
            hoverBorderColor: 'rgba(0,0,0,1)',
            hoverBorderWidth: 2
        }]
    };

    //dataLineChart COLOR
    const datalineaColor = {
        labels: etiquetasRating2020,
        datasets: [{
            label: ' Rating',
            data: datosRating2020,
            color: '#003E99',
            borderColor: '#003E99',
            backgroundColor: '#003E99',
            hoverBackgroundColor: '#5287D5',
            hoverBorderColor: 'rgba(0,0,0,1)',
            hoverBorderWidth: 2,
            pointRadius: 5
        }]
    };
    




    /*  config  */
    //config barChartColor
    const configBarChartColor = {
        type: 'bar',
        data: dataColor,
        options: {
            animation: {
                delay: 200,
                duration: 2000
            },
            responsive: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins:{
                title:{
                    display: true,
                    text:'Barras',
                    color: '#003E99',
                    font:{
                        size:20,
                    }
                },
                legend:{
                    display: false,
                    position: 'right'
                },
                labels: {
                    font:{
                        color: 'rgba(0,0,0,1)'
                    }
                }
            },
            scales:{
                x:{
                    ticks: {
                        color: '#003E99'
                    }
                },
                y: {
                    ticks:{
                        color: '#003E99'
                    }
                }
            }
        }
    };

    //config lineChartColor
    const configLineChartColor = {
        type: 'line',
        data: datalineaColor,
        options: {
            animation: {
                delay: 400,
                duration: 2000
            },
            responsive: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins:{
                title:{
                    display: true,
                    text:'Lineas',
                    color: '#003E99',
                    font:{
                        size:20,
                    }
                },
                legend:{
                    display: false,
                    position: 'right'
                },
                labels: {
                    font:{
                        color: 'rgba(0,0,0,1)'
                    }
                }
            },
            scales:{
                x:{
                    ticks: {
                        color: '#003E99'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks:{
                        color: '#003E99'
                    }
                }
            }
        }
    };
    
    //config pieChartColor
    const configPieChartColor = {
        type: 'pie',
        data: dataColor,
        options: {
            animation: {
                delay: 600,
                duration: 2000
            },
            responsive: false,
            plugins:{
                title:{
                    display: true,
                    text:'Tarta',
                    color: '#003E99',
                    font:{
                        size:20,
                    }
                },
                legend:{
                    display: false,
                    position: 'right'
                },
                labels: {
                    font:{
                        color: 'rgba(0,0,0,1)'
                    }
                }
            }
        }
    };


    //config barChart
    const configBarChart = {
        type: 'bar',
        data,
        options: {
            animation: {
                delay: 800,
                duration: 2000
            },
            responsive: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins:{
                title:{
                    display: true,
                    text:'Barras',
                    color: '#003E99',
                    font:{
                        size:20,
                    }
                },
                legend:{
                    display: false,
                    position: 'right'
                },
                labels: {
                    font:{
                        color: 'rgba(0,0,0,1)'
                    }
                }
            },
            scales:{
                x:{
                    ticks: {
                        color: '#003E99'
                    }
                },
                y: {
                    ticks:{
                        color: '#003E99'
                    }
                }
            }
        }
    };

    //config lineChart
    const configLineChart = {
        type: 'line',
        data: datalinea,
        options: {
            animation: {
                delay: 1000,
                duration: 2000
            },
            responsive: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins:{
                title:{
                    display: true,
                    text:'Lineas',
                    color: '#003E99',
                    font:{
                        size:20,
                    }
                },
                legend:{
                    display: false,
                    position: 'right'
                },
                labels: {
                    font:{
                        color: 'rgba(0,0,0,1)'
                    }
                }
            },
            scales:{
                x:{
                    ticks: {
                        color: '#003E99'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks:{
                        color: '#003E99'
                    }
                }
            }
        }
    };
    
    //config pieChart
    const configPieChart = {
        type: 'pie',
        data,
        options: {
            animation: {
                delay: 1200,
                duration: 2000
            },
            responsive: false,
            plugins:{
                title:{
                    display: true,
                    text:'Tarta',
                    color: '#003E99',
                    font:{
                        size:20,
                    }
                },
                legend:{
                    display: false,
                    position: 'right'
                },
                labels: {
                    font:{
                        color: 'rgba(0,0,0,1)'
                    }
                }
            }
        }
    };





    /*  render  */
    //render block
    const barChartColor = new Chart(document.getElementById('barChartColor'), configBarChartColor);
    const lineChartColor = new Chart(document.getElementById('lineChartColor'), configLineChartColor);
    const pieChartColor = new Chart(document.getElementById('pieChartColor'), configPieChartColor);

    const barChart = new Chart(document.getElementById('barChart'), configBarChart);
    const lineChart = new Chart(document.getElementById('lineChart'), configLineChart);
    const pieChart = new Chart(document.getElementById('pieChart'), configPieChart);
</script>