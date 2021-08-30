<?PHP 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
  if (isset($_SESSION['mes']) and isset($_SESSION['ano'])) {
    $mes = $_SESSION['mes'];
    $ano = $_SESSION['ano'];
  }else{
    $mes = date('m');
    $ano = date('Y');
  }
}else{
  $mes = date('m');
  $ano = date('Y');
}
  $hoje = date('Y-m-d');
  $semana = 0;
  $dia = 1;
  $primeirodia = $ano . '-' . $mes . '-01';
  $dayofweek = date('w', strtotime($primeirodia));
  $ultimodia = date("t", strtotime($primeirodia));
  $data = '';
?>

<table id="tablecalendar">
  <tr>
    <th class="day-name">Dom</th>
    <th class="day-name">Seg</th>
    <th class="day-name">Ter</th>
    <th class="day-name">Qua</th>
    <th class="day-name">Qui</th>
    <th class="day-name">Sex</th>
    <th class="day-name">Sab</th>
  </tr>
<?PHP 
while($dia <= $ultimodia){
  echo '<tr>';
  for ($x = 0; $x <= 6; $x+=1){
    if ($dayofweek == $x and $dia <= $ultimodia) {
      $data = $ano . '-' . $mes . '-' . $dia;
      if($hoje == $data){
        echo '<td class="day today"><span class="number">' . $dia . '</span></td>';
      }else{
        echo '<td class="day"><span class="number"></span>'. $dia .'</td>';
      }
      $dia++;
      $dayofweek = date('w', strtotime($ano . '-' . $mes . '-' . $dia));
    }else{
      echo '<td class="day"><span class="number"></span></td>';
    }
  }
  echo '</tr>';
}
?>
</table>