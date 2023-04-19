<!DOCTYPE html>
<html lang="es-mx">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="sliders.css" rel="stylesheet" type="text/css">
  <title>Card Slider</title>
</head>
<body>
<?php
// Este array puede ser sustituído
// por uno invocado desde una base
// de datos SQL
$array_personas = [
  "0" => [
    "id" => "1",
    "nombre" => "Alvaro Chavez",
    "filename" => "0"
  ],
  "1" => [
    "id" => "2",
    "nombre" => "Abimael Melendez",
    "filename" => "1"
  ],
  "2" => [
    "id" => "3",
    "nombre" => "Abelardo Montoya",
    "filename" => "2"
  ],
  "3" => [
    "id" => "4",
    "nombre" => "Adriana Lemur",
    "filename" => "3"
  ],
  "4" => [
    "id" => "5",
    "nombre" => "Beto Cano",
    "filename" => "4"
  ],
  "5" => [
    "id" => "6",
    "nombre" => "Beatriz Añez",
    "filename" => "5"
  ],
  "6" => [
    "id" => "7",
    "nombre" => "Donovan Oviedo",
    "filename" => "6"
  ],
  "7" => [
    "id" => "8",
    "nombre" => "Dylan Paez",
    "filename" => "7"
  ],
  "8" => [
    "id" => "9",
    "nombre" => "Denisse Cantu",
    "filename" => "8"
  ],
  "9" => [
    "id" => "10",
    "nombre" => "Icaro Vazquez",
    "filename" => "9"
  ],
  "10" => [
    "id" => "11",
    "nombre" => "Nadia Molina",
    "filename" => "10"
  ],
  "11" => [
    "id" => "12",
    "nombre" => "Zazil Campos",
    "filename" => "11"
  ],
  "12" => [
    "id" => "13",
    "nombre" => "Rogelia Fernandez",
    "filename" => "12"
  ],
  "13" => [
    "id" => "14",
    "nombre" => "Lana Lane",
    "filename" => "13"
  ],
  "14" => [
    "id" => "15",
    "nombre" => "Yun Nuen",
    "filename" => "14"
  ],
  "15" => [
    "id" => "16",
    "nombre" => "Socorro Amparo",
    "filename" => "15"
  ],
  "16" => [
    "id" => "17",
    "nombre" => "Eriberto Campos",
    "filename" => "16"
  ],
  "17" => [
    "id" => "18",
    "nombre" => "Mario Montero",
    "filename" => "17"
  ]
  // Las entradas agregadas a este array asosiativo
  // se agregan automáticamente y se ordenan alfabéticamente
  // en el arreglo de cartas. La letra principal también
  // se agrega automáticamente
];

// ordenar alfabeticamente
$orden = array_column($array_personas, 'nombre');
array_multisort($orden, SORT_ASC, $array_personas);

// crear un array con el nombre del personaje como llave principal para poder extraer su letra inicial
function flatten($array){
  $nuevo = [];
  foreach ($array as $key => $value) {
    $nuevo[$value['nombre']][0] = $value['filename'];
    $nuevo[$value['nombre']][1] = $value['id'];
  }
  return $nuevo;
}

// crear nuevo array con resultados por letra,
// luego buscar las iniciales existentes para agregarlas al menú de letras y desestimar las inexistentes
function splitter($array){
  $overall = [];
  $abz = 'a b c d e f g h i j k l m n o p q r s t u v w x y z';
  $letters = explode(" ", $abz);
  foreach ($letters as $key => $value) {
    $upper = strtoupper($value);
    $$upper = [];
    foreach ($array as $k => $v) {
      if ($k[0] == strtoupper($value)) {
        $$upper[$k][0] = $v[0];
        $$upper[$k][1] = $v[1];
      }
    }
  }
  foreach ($letters as $key => $value) {
    $upper = strtoupper($value);
    if (!empty($$upper)) {
      $overall[strtoupper($value)]=$$upper;
    }
  }
  return $overall;
}

// esta función lidia con acentos en la primer letra.
// Puede ser innecesaria en caso de usar el slider
// en idioma inglés, pero en español es necesario
// hacer uso de esta funcion, sobre todo porque al
// recibir datos desde una base de datos SQL es posible
// que las letras con acento vengan en htmlentities como "&aacute;"
// y esta es la manera más sencilla que encontré para lidiar con eso
function excepciones($n){
  if ($n == 'Alvaro Chavez') {
    return 'Álvaro Chavez';
  } elseif ($n == 'Icaro Vazquez') {
    return 'Ícaro Vazquez';
  } else {
    return $n;
  }
}
 ?>

  <main class="contenedorMain">
    <section class="backPersonas">
      <div class="naviContainer">
        <div id="containerP" class="containerPersonas">
          <div class="innerPersonas">
            <div class="spacer"></div>
            <?php
            $cursor = 'ppl_slide';
            $personas = $array_personas;
            $flat = flatten($personas);
            $split = splitter($flat);
            $abc = [];
            $abz = 'a b c d e f g h i j k l m n o p q r s t u v w x y z';
            $letters = explode(" ", $abz);
            foreach ($letters as $key => $value) {
              $upp = strtoupper($value);
              if (isset($split[$upp])) {
                array_push($abc, $value);
                $$split[$upp]=[];
                $$split[$upp]=$split[$upp];
                foreach ($$split[strtoupper($value)] as $k => $v) {
                  $search = array_search($k,array_keys($$split[strtoupper($value)]));
                  if ( $search == '0') {
                    echo '<div id="'.$k[0].'" class="perspective">';
                  } else {
                    echo '<div class="perspective">';
                  }
                  echo '<div class="personaCard">';
                  echo '<div class="fotoCard"><img src="ppl/'.$v[0].'.jpg" alt=""> </div>';
                  echo '<p>'.excepciones($k).'</p>';
                  echo '<div style="text-align:center" class="enlaceItemCatPeli"> <a href="ver.php?v='.$v[1].'">Ver ficha</a> <a target="_blank" href="ver.php?v='.$v[1].'"><i class="fas fa-external-link-alt"></i></a></div>';
                  echo '</div>';
                  echo '</div>';
                }
              }
            }
            ?>
            <div class="spacer"></div>
          </div>
        </div>
        <div id="personaLeft" class="personaLeft"><i class="fa-solid fa-angle-left"></i></a></div>
        <div id="personaRight" class="personaRight"><i class="fa-solid fa-angle-right"></i></a></div>
      </div>
      <div class="abc_container">
        <div id="abc" class="abc">
          <?php
          foreach ($abc as $key => $value) {
            echo '<div id="'.strtoupper($value).'x" onmouseover="shrink('.strtoupper($value).');scrollToElement('.$value.','.strtoupper($value).')" onmouseout="reset()" onclick="scrollToElement('.$value.','.strtoupper($value).')" class="letras"><span>'.$value.'</span></div>';
          }
          ?>
        </div>
      </div>
    </section>
    <script type="text/javascript">
    <?php
    // crear dinámicamente variables y constantes para enlazar las letras existentes con acciones en slider.js
    foreach ($abc as $key => $value) {
      if ($key == '0') {
        echo 'let '.$value.'= document.getElementById("'.strtoupper($value).'").offsetLeft,';
      } elseif ($key == count($abc)-1) {
        echo $value.'= document.getElementById("'.strtoupper($value).'").offsetLeft;';
      } else {
        echo $value.'= document.getElementById("'.strtoupper($value).'").offsetLeft,';
      }
    }
    foreach ($abc as $key => $value) {
      if ($key == '0') {
        echo 'const '.strtoupper($value).'= "'.strtoupper($value).'",';
      } elseif ($key == count($abc)-1) {
        echo strtoupper($value).'= "'.strtoupper($value).'";';
      } else {
        echo strtoupper($value).'= "'.strtoupper($value).'",';
      }
    }
    ?>
  </script>

</main>
</body>
<script src="slider.js"></script>
</html>
