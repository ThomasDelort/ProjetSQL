<?php
require 'database.php';

if (!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

if(!empty($_POST)) {
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
}

function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">

    </head>
    <body>
        <h1 class="text-logo">Burger Code</h1>
        <div class="container admin">
            <div class="row">
                <div class="col-md-12">
                    <h1><strong>Supprimer un item</strong></h1> 
                    <br>
                    <form class="form" role="form" action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <p class="alert alert-danger">Etes vous sur de vouloir supprimer ?</p>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">oui</button>
                            <a class="btn btn-default" href="index.php">non</a>
                        </div>
                    </form>

                </div>

            </div>



        </div>

    </body>
</html>
