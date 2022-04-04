<?php
include 'database.php';


function get_usuario($usuario,$pwd)
{
    $pdo = Database::connect();
    $status=[];
    $sql = "SELECT * FROM usuario where Usuario = '{$usuario}' and Contrasenia = '{$pwd}'";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        
        if($row=$query->fetch(PDO::FETCH_ASSOC)){
            $status['message'] = "Usuario valido";
        }else{
            $status['message'] = "Usuario invalido";
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    Database::disconnect();
    return $status;
}

function get_all_equipos_lista()
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM equipos";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        $equipos=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
          $item=array(
              "ID"=>$row['Id'],
              "Token"=>$row['Token'],
              "Datos"=> json_decode($row['Datos']),
          );
          array_push($equipos,$item);
        }
        $all_equipo_info =  $equipos;
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    Database::disconnect();
    return $all_equipo_info;
}

function get_un_equipo_info($id)
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM equipos where id = {$id} ";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();

        $equipos=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
          $item=array(
              "ID"=>$row['Id'],
              "Token"=>$row['Token'],
              "Datos"=> json_decode($row['Datos']),
          );
          array_push($equipos,$item);
        }
        $equipo_info = $equipos;
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    Database::disconnect();
    return $equipo_info;
}




function update_equipo_info($id,$token,$datos)
{
    $pdo = Database::connect();
    $sql = "UPDATE Equipos SET Token = '{$token}', Datos = '{$datos}' where id = '{$id}'";
    $status = [];

    try {

        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Dato actualizado";
        }
        else{
            $status['message'] = "Dato no actualizado";
        }

    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }

    Database::disconnect();
    return $status;
}


function add_equipo_info($id,$token,$datos)
{
    $pdo = Database::connect();
    $sql = "INSERT INTO Equipos(`Id`,`Token`,`Datos`) VALUES('{$id}', '{$token}','{$datos}')";
    $status = [];
    
    try {
        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Equipo insertado";
        }
        else{
            $status['message'] = "Equipo no insertado";
        }
    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }
    Database::disconnect();
    return $status;
}

function delete_equipo_info($id)
{
    $pdo = Database::connect();
    $sql ="DELETE FROM Equipos where Id = '{$id}'";
    $status = [];

    try {

        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Dato eliminado";
        }
        else{
            $status['message'] = "Dato no ha sido eliminado";
        }

    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }

    Database::disconnect();
    return $status;
}