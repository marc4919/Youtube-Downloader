<?php
    
    try{
/*         $conexion = new PDO('mysql:host=sql302.epizy.com;dbname=epiz_28215499_users', 'epiz_28215499', 'tLrd3Y242AcI6Js');
 */        $conexion = new PDO('mysql:host=localhost;dbname=login_tuto', 'root', '');
    }catch(PDOException $prueba_error){
        echo "Error: " . $prueba_error->getMessage();
    }


?>