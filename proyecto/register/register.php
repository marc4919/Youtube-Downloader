<?php session_start();

// EN ESTE CODIGO OBTENEMOS TODA LA INFO DE DESDE REGISTER-VISTA.PHP QUE SERIA LA PARTE DE FRONT-END.
// PODRIAMOS HABER HECHO UNA CLASE CONEXION, DESDE DONDE NO HUBIERA QUE ESTAR INDICANDOLE EN CADA ARCHIVO LA CONEXION DE LA BBDD


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];
        
        $clave = hash('sha512', $clave);
        $clave2 = hash('sha512', $clave2);
        
        $error = '';
        
    if (empty($correo) or empty($usuario) or empty($clave) or empty($clave2)){
        $error .= '<i>Por favor de rellenar todos los campos</i>';
    }else{
        try{
        /*$conexion = new PDO('mysql:host=sql302.epizy.com;dbname=epiz_28215499_users', 'epiz_28215499', 'tLrd3Y242AcI6Js');*/
        $conexion = new PDO('mysql:host=localhost;dbname=login_tuto', 'root', '');

        }catch(PDOException $prueba_error){
            echo "Error: " . $prueba_error->getMessage();
        }
            
            $statement = $conexion->prepare('SELECT * FROM login WHERE usuario = :usuario LIMIT 1');
            $statement->execute(array(':usuario' => $usuario));
            $resultado = $statement->fetch();
            
                        
        if ($resultado != false){
            $error .= '<i>Este usuario ya existe</i>';
        }
            
        if ($clave != $clave2){
            $error .= '<i> Las contraseñas no coinciden</i>';
        }
            

        }
        
        if ($error == ''){
            $statement = $conexion->prepare('INSERT INTO login (id, correo, usuario, clave) VALUES (null, :correo, :usuario, :clave)');
            $statement->execute(array(
                
                ':correo' => $correo,
                ':usuario' => $usuario,
                ':clave' => $clave
                
            ));
            
            $error .= '<i style="color: green;">Usuario registrado exitosamente</i>';
      
            header('location: ../download/index.php');

        }
    }


    require 'register-vista.php';
