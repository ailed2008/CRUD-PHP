<?php
    require 'config/database.php';
    $db = new Database();
    $con = $db -> conectar();

    $correcto = false;

    if(isset($_POST['id'])){
        //Modifcar registro
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $stock = $_POST['stock'];
        $inventariable = isset($_POST['inventariable']) ? $_POST['inventariable'] : 0; //Si existe la variable inventariable o sino existe será igual a 0
        
        if($stock == ''){
            $stock = 0;
        }

        $query = $con -> prepare("UPDATE productos SET codigo =?, descripcion=?, inventariable=?, stock=? WHERE id=?");
        $resultado = $query->execute(array($codigo,$descripcion, $inventariable, $stock, $id));     
        if($resultado){
            $correcto = true;
        }
    }else{
        //Guardar registro nuevo
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $stock = $_POST['stock'];
        $inventariable = isset($_POST['inventariable']) ? $_POST['inventariable'] : 0; //Si existe la variable inventariable o sino existe será igual a 0
        
        // if($codigo == ''){
        //     echo "Este campo es obligatorio"
        // }

        if($stock == ''){
            $stock = 0;
        }

        $query = $con-> prepare("INSERT INTO productos (codigo, descripcion, inventariable,stock, activo)VALUES (:cod, :descr, :inv, :sto, 1)");
        $resultado = $query->execute(array('cod' => $codigo, 'descr'=> $descripcion, 'inv'=>$inventariable, 'sto'=>$stock));
        
        if($resultado){
            $correcto = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/bootstrap.bundle.min.js"></script></head>
</head>
<body class="py-3">
    <main class="container">
        <div class="row">
            <div class="col">
               <?php
               if($correcto){?>
                   <h3>Registro guardado</h3>
               <?php } else{ ?>
                <h3>Error al guardar</h3>
                <?php } ?>
            </div>
        </div>
       <div class="row">
           <div class="col">
               <a href="index.php" class="btn btn-primary">Regresar</a>
           </div>
       </div> 
    </main>
</body>
</html>