<?php

/***** Inicialización del entorno ******/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* Zona de declaración de funciones */
//*******Funciones de debugueo****
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//*******Función lógica presentación**********+
function getTableroMarkup ($tablero, $posPersonaje){
    $output = '';
    foreach ($tablero as $filaIndex => $datosFila) {
        foreach ($datosFila as $columnaIndex => $tileType) {
            if(isset($posPersonaje)&&($filaIndex == $posPersonaje['row'])&&($columnaIndex == $posPersonaje['col'])){
                $output .= '<div class = "tile ' . $tileType . '"><img src="bicho.png"></div>';    
            }else{
                $output .= '<div class = "tile ' . $tileType . '"></div>';
            }
        }
    }
    return $output;
}

function getMensajeMarkup ($arrayMensajes){
    $output = ' ';

    foreach ($arrayMensajes as $mensaje){
        $output .= '<p>' .$mensaje. '</p>';
    }

    return $output;

}

function getArrowsMarkup($posPersonaje){
    $arriba = '?row=' . ($posPersonaje['row'] - 1) . '&col=' . $posPersonaje['col'];
    $abajo = '?row=' . ($posPersonaje['row'] + 1) . '&col=' . $posPersonaje['col'];
    $derecha = '?row=' . $posPersonaje['row'] . '&col=' . ($posPersonaje['col'] + 1);
    $izquierda = '?row=' . $posPersonaje['row'] . '&col=' . ($posPersonaje['col'] - 1);

    $output = '
        <a href="' . $arriba . '"><button>Arriba</button></a><br>
        <a href="' . $abajo . '"><button>Abajo</button></a><br>
        <a href="' . $derecha . '"><button>Derecha</button></a><br>
        <a href="' . $izquierda . '"><button>Izquierda</button></a>
    ';
    
    return $output;
}

//******+Función Lógica de negocio************
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
function leerInput(){
    
    $col = filter_input(INPUT_GET, 'col', FILTER_VALIDATE_INT);
    $row = filter_input(INPUT_GET, 'row', FILTER_VALIDATE_INT);

   
    return (isset($col) && is_numeric($col) && isset($row) && is_numeric($row))? array(
            'row' => $row,
            'col' => $col
        ) : null;    


}

function getMensaje ($posPersonaje){

    if (!isset($posPersonaje)){
        return array('La posición del personaje no está bien definida');
    }

    return array(' ');
}
//*****Lógica de negocio***********
//Extracción de las variables de la petición


$posPersonaje = leerInput();

// dump('$posPersonaje');
// dump($posPersonaje);
$tablero = leerArchivoCSV('archivo.csv');
$mensaje = getMensaje($posPersonaje);



//*****+++Lógica de presentación*******
$tableroMarkup = getTableroMarkup($tablero, $posPersonaje);
$mensajesUsuarioMarkup = getMensajeMarkup ($mensaje);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Tablero</title>
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
            overflow: hidden;
        }
        .tile img{
            max-width:100%;
        }
        .fuego {
            background-color: red;
            background-position: -105px -52px;
        }
        .tierra {
            background-color: brown;
            background-position: -157px 0px;
        }
        .agua {
            background-color: blue;
            background-position: -53px 0px;
        }
        .hierba {
            background-color: green;
            background-position: 0px 0px;
        }
    </style>
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <div class="contenedorTablero">
        <?php echo $tableroMarkup; ?>
    </div>
    <br>
    <div>
    <?php echo getArrowsMarkup($posPersonaje); ?>
    </div>
    <br>
    <div>
        <?php echo $mensajesUsuarioMarkup; ?>
    </div>
</body>
</html>