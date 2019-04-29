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
                <h1><strong>Liste des items</strong>
                    <a href="insert.php" class="btn btn-success btn-lg">Ajouter</a></h1> 
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégories</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    require 'database.php';
                    $db = Database::connect();
                    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');
                    while($item = $statement->fetch()){


                        echo '<tr>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['description'] . '</td>';
                        echo '<td>' . number_format((float)$item['price'],2,'.','') . '</td>';
                        echo '<td>' . $item['category'] . '</td>';
                        echo '<td width=300>';
                        echo '<a href="view.php?id='. $item['id'] .'" class="btn btn-dark">voir</a> ';

                        echo '<a href="update.php?id='. $item['id'] .'" class="btn btn-primary">modifier</a> ';
                        echo '<a href="delete.php?id='. $item['id'] .'" class="btn btn-danger">supprimer</a>';
                        echo '</td>';
                        echo '</tr>';



                    }
                    Database::disconnect();
                    ?>


                </tbody>
            </table>

        </div>

    </body>
</html>
