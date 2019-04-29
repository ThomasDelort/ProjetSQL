<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <div class="container site">
            <h1 class="text-logo">Burger Code</h1>

            <?php 
            require 'admin/database.php';
            echo '<nav>
                <ul class="nav nav-pills" id="myTab" role="tablist">';
            $db = Database::connect();
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();

            foreach ($categories as $category){
                if($category['id'] == '1')
                    echo '<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#p' . $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
                else
                    echo '<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#p' . $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';   
            }
            echo '</ul>
            </nav>';

            echo '<div class="tab-content">';

            foreach ($categories as $category){

                if($category['id'] == '1')
                    echo '<div class="tab-pane active" id="p' . $category['id'] . '">';
                else
                    echo '<div class="tab-pane" id="p' . $category['id'] . '">';
                echo '<div class="row">';


                $statement = $db->prepare("SELECT * FROM items WHERE items.category = ?");
                $statement->execute(array($category['id']));
                
                while($item = $statement->fetch()){
                    echo '<div class="col-md-6 col-lg-4">
                    <div class="img-thumbnail">
                        <img src="images/' . $item['image'] . '" class="img-fluid" alt="...">
                        <div class="price">' . number_format($item['price'], 2, '.','') . ' &euro;</div>
                        <div class="caption">
                            <h4>' . $item['name'] . '</h4> 
                            <p>' . $item['description'] . '</p>
                            <a href="#" class="btn btn-order" role="button">Commander</a>
                        </div>
                    </div>
                </div>';
                    
                }
                echo '</div>
                </div>';
            }
            Database::disconnect();
                echo '</div>';
            ?>





    </div>


</body>

</html>