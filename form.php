<?php 
    // käyttöliittymä kokeilu, ei tulosta tietoja mutta hakee tiedot dropdown -valikkoihin
    session_start(); 
    require_once('db.php');
    require_once('functions.php');
    $conn = createDbConnection();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }
                ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Search movies!</h3>
                    </div>
                    <div class="card-body">
                    
                        <form action="index.php" method="GET">
                            <div class="from-group mb-3">
                                <label for="">Role</label>
                                <input type="text" name="role_" class="form-control" placeholder="search movie roles"/>
                            </div>

                            <div class="from-group mb-3">
                                <label for="">Actor</label>
                                <input type="text" name="name_" class="form-control" placeholder="search movies with actors"/>
                            </div>

                            <div class="from-group mb-3">
                                <label for="">Titles by genre</label>
                                <select name="genre" class="form-control">
                                    <option>-- Genre --</option>
                                    <?php
                                        $sql = "SELECT DISTINCT genre FROM title_genres ORDER BY genre ASC;";

                                        // Aja kysely kantaan
                                        $prepare = $conn->prepare($sql);
                                        $prepare->execute();
                                        
                                        // Tallenna vastaus muuttujaan
                                        $rows = $prepare->fetchAll();
                                        $html = '<select name="genre">';

                                        foreach ($rows as $row) {
                                            echo '<option>' . $row['genre'] . '</option>';
                                        }	
                                    ?> 
                                </select>
                            </div>

                            <div class="from-group mb-3">
                                <label for="">Average ratings</label>
                                <select name="average_rating" class="form-control">
                                    <option>-- Average rating --</option>
                                    <?php
                                        $sql = "SELECT DISTINCT average_rating FROM title_ratings ORDER BY average_rating DESC;";

                                        // Aja kysely kantaan
                                        $prepare = $conn->prepare($sql);
                                        $prepare->execute();
                                        
                                        // Tallenna vastaus muuttujaan
                                        $rows = $prepare->fetchAll();
                                        $html = '<select name="average_rating">';

                                        foreach ($rows as $row) {
                                            echo '<option>' . $row['average_rating'] . '</option>';
                                        }	
                                    ?> 
                                </select>
                            </div>

                            <div class="from-group mb-3">
                                <?php
                                    $path = 'datasets';

                                    if ($handle = opendir($path)) {
                                        while (false !== ($file = readdir($handle))) {
                                            if ('.' === $file) continue;
                                            if ('..' === $file) continue;
                                
                                            $html .= '<div><input type="submit" value="' . basename($file, ".php") . '" formaction="' . $path . "/" . $file . '"></div>';
                                        }
                                        closedir($handle);
                                    }
                                ?>
                                <button type="submit" name="search" class="btn btn-primary">Search</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
