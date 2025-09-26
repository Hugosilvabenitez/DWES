<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function getImagenes() {

    $img;
    $opcion = 2;

    switch ($opcion) {
        case 1:
            $img = array("c1.png", "c2.png", "c3.png", "c4.png");
            break;
        case 2:
            $img = array("c3.png", "c1.png", "c4.png", "c2.png");
            break;
    }

    return $img;
}


function crearTabla($img){

 $output='<table>';

 $contador=0;

 for($i=0;$i<12;$i++){
    $output.='<tr>';

    for($j=0;$j<12;$j++){
     $output .= '<td><img src="'. $img[$contador] . '" width="50px" height="50px"/></td>';

     $contador++;

     if ($contador == count($img)) {
                $contador = 0;
      }

        

    }

    $output.='</tr>';

 }
 $output.='</table>';

 return $output;
}

?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <h1>Tabla</h1>
    <?php echo crearTabla(getImagenes()); ?>
</body>
</html>






















