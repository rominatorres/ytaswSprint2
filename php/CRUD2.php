<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);

/*function permisos() {  
  if (isset($_SERVER['HTTP_ORIGIN'])){
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
      header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
      header('Access-Control-Allow-Credentials: true');      
  }  
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
    exit(0);
  }
}
permisos();*/


    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    //Variables de la tabla

    //isset: Determina si una variable está definida y no es nula
    $id_ruta = (isset($_POST['id_ruta'])) ? $_POST['id_ruta'] : '';
    $fechaInicio = (isset($_POST['fechaInicio'])) ? $_POST['fechaInicio'] : '';
    $fechaFin = (isset($_POST['fechaFin'])) ? $_POST['fechaFin'] : '';
    $zonaRuta = (isset($_POST['zonaRuta'])) ? $_POST['zonaRuta'] : '';
    $id_grupo = (isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
    $id_vehiculo = (isset($_POST['id_vehiculo'])) ? $_POST['id_vehiculo'] : '';
    $id_er = (isset($_POST['id_er'])) ? $_POST['id_er'] : '';
    $placa = (isset($_POST['placa'])) ? $_POST['placa'] : '';
    $desc_grupo = (isset($_POST['desc_grupo'])) ? $_POST['desc_grupo'] : '';
    $desc_estado_ruta = (isset($_POST['desc_estado_ruta'])) ? $_POST['desc_estado_ruta'] : '';

    $id_familia = (isset($_POST['id_familia'])) ? $_POST['id_familia'] : '';
    $nomb_titular = (isset($_POST['nomb_titular'])) ? $_POST['nomb_titular'] : '';
    $apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
    $direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
    $distrito= (isset($_POST['distrito'])) ? $_POST['distrito'] : '';
    $numIntegrantes = (isset($_POST['numIntegrantes'])) ? $_POST['numIntegrantes'] : '';
    $numContagiados = (isset($_POST['numContagiados'])) ? $_POST['numContagiados'] : '';
/*
    $id_persona = (isset($_POST['id_persona'])) ? $_POST['id_persona'] : '';
    $id_familia = (isset($_POST['id_familia'])) ? $_POST['id_familia'] : '';
    $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido_pat = (isset($_POST['apellido_pat'])) ? $_POST['apellido_pat'] : '';
    $apellido_mat = (isset($_POST['apellido_mat'])) ? $_POST['apellido_mat'] : '';
    $edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
    $id_ep = (isset($_POST['id_ep'])) ? $_POST['id_ep'] : '';
*/

switch($opcion){
    
	case 1:
        $consulta = "INSERT INTO ruta (fechaInicio, fechaFin, zonaRuta, id_grupo, id_vehiculo, id_er) VALUES ('$fechaInicio', '$fechaFin', '$zonaRuta', '$id_grupo', '$id_vehiculo', '$id_er')";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE ruta SET fechaInicio='$fechaInicio', fechaFin='$fechaFin', zonaRuta='$zonaRuta', id_grupo='$id_grupo', id_vehiculo='$id_vehiculo', id_er='$id_er' WHERE id_ruta='$id_ruta'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM ruta WHERE id_ruta='$id_ruta'";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
       
    case 4:
        $consulta = "SELECT A.id_ruta, DATE_FORMAT(CONVERT(A.fechaInicio, DATE),'%d/%M/%Y') as fecha, CONVERT(A.fechaInicio,TIME) as hora, B.desc_grupo, C.placa, A.zonaRuta, D.desc_estado_ruta FROM ruta A LEFT JOIN grupo B ON A.id_grupo = B.id_grupo LEFT JOIN vehiculo C ON A.id_vehiculo = C.id_vehiculo LEFT JOIN estadoRuta D ON A.id_er = D.id_er";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
/*
    case 5:
        $consulta = "SELECT A.id_persona, B.id_familia, dni, nombre, apellido_pat, apellido_mat, edad, id_ep FROM persona A LEFT JOIN familia B ON A.id_familia = B.id_familia;
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    */

    case 5:
        $consulta = "SELECT id_familia, nomb_titular, apellidos, direccion, distrito, numIntegrantes, numContagiados FROM familia";
       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;