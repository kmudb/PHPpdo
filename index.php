<?php
include('lib/functions.php');
header('content-type: application/json');


if($_SERVER['REQUEST_METHOD']=="GET")
{
  if(isset($_GET['usuario'])){
  $usu = $_GET['usuario'];
  $pwd = $_GET['pwd'];
  $json = get_usuario($usu,$pwd);
  if(empty($json))
  header("HTTP/1.1 404 Not Found");
  echo json_encode($json);
  }
  elseif(isset($_GET['id']))
  {
    $id =  $_GET['id'];
    $json = get_un_equipo_info($id);
    if(empty($json))
    header("HTTP/1.1 404 Not Found");
    echo json_encode($json);
  }
  else{
    $json = get_all_equipos_lista();
    echo json_encode($json);
  }
}



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode( file_get_contents( 'php://input') );
  
  $id = $data->Id;
  $token = $data->Token;
  $datos=json_encode($data->Datos);
   $json = add_equipo_info($id,$token,$datos);
  echo json_encode($json);
}

if($_SERVER['REQUEST_METHOD']=="PUT")
{
  $data = json_decode( file_get_contents( 'php://input' ) );
  
  $id = $data->Id;
  $token = $data->Token;
  $datos=json_encode($data->Datos);
  
  $json = update_equipo_info($id,$token,$datos);
  echo json_encode($json);
}

if($_SERVER['REQUEST_METHOD']=="DELETE")
{
  $data = json_decode( file_get_contents( 'php://input' ));
  
  $id = $data->Id;
  $json = delete_equipo_info($id);
  echo json_encode($json);
}
?>