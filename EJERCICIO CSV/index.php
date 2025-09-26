<?php

/* Inicialización del entorno */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Zona de declaración de funciones */
//Funciones de debugueo
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

$personaje=random_int(0,144);



//Función lógica presentación
function getTableroMarkup ($tablero,$fila,$col){
    $output = '';
    $contFila = 0;
    $contCol = 0;

    //dump($tablero);
    foreach ($tablero as $filaIndex => $datosFila) {
        $contFila++;
        foreach ($datosFila as $columnaIndex => $tileType) {

            //dump($tileType);
            $contCol++;
            
            if($contFila == $fila && $contCol==$col){
            $output .= '<div class = "tile ' . $tileType . '"><img src="bicho.png" width: 25px; height : 25px;/></div>';
            }else{
            $output .= '<div class = "tile ' . $tileType . '"></div>';

            }
        }
        $contCol = 0;
    }

    return $output;

}
//Lógica de negocio
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos valores pueden ser:
// agua
//fuego
//tierra
// hierba






function leerArchivoCSV($rutaArchivoCSV) {
    $tablero = [];

    if (($puntero = fopen($rutaArchivoCSV, "r")) !== FALSE) {
        while (($datosFila = fgetcsv($puntero)) !== FALSE) {
            $tablero[] = $datosFila;
        }
        fclose($puntero);
    }

    return $tablero;
}



$fila=$_GET['fila'];
$col=$_GET['col'];




$tablero = leerArchivoCSV('archivo.csv');

//Lógica de presentación
$tableroMarkup = getTableroMarkup($tablero,$fila,$col);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Document</title>
    <style>
        .contenedorTablero {
            width:600px;
            height:600px;
            border: solid 2px grey;
            box-shadow: grey;
            display:grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: repeat(12, 1fr);
        }
        .tile {
            float: left;
            margin: 0;
            padding: 0;
            border-width: 0;
            background-image: url("464.jpg");
            background-size: 209px;
            background-repeat: none;
        }
        .fuego {
            background-position: -105px -52px;
        }
        .tierra {
            background-position: -157px 0px;
        }
        .agua {
            background-position: -53px 0px;
        }
        .hierba {
            background-position: 0px 0px;
        }
    </style>
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <div class="contenedorTablero">
        <?php echo $tableroMarkup; ?>
    </div>
</body>
</html>