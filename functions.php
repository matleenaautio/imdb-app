<?php

 // funktio joka luo genre-pudotusvalikon
function createGenreDropDown() {
    require_once('db.php');
    $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
    
    // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
    $sql = "SELECT DISTINCT genre FROM title_genres ORDER BY genre ASC;";
    
    // Aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    
    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="genre">';
    
    // Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // Tulosta jokaiselle riville li-elementti
        $html .= '<option>' . $row['genre'] . '</option>';
    }
    
    $html .= '</select>';

    // palautetaan kutsujalle
    return $html;
}

function createAverageRatingsDropDown() {
    require_once('db.php');
    $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
    
    // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
    $sql = "SELECT DISTINCT average_rating FROM title_ratings ORDER BY average_rating DESC;";
    
    // Aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    
    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="average_rating">';
    
    // Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // Tulosta jokaiselle riville li-elementti
        $html .= '<option>' . $row['average_rating'] . '</option>';
    }
    
    $html .= '</select>';

    // palautetaan kutsujalle
    return $html;
}
 
function createRoleDropDown() {
    require_once('db.php');
    $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
    
    // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
    $sql = "SELECT DISTINCT role_ FROM Had_role LIMIT 20;";
    
    // Aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    
    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="role_">';
    
    // Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // Tulosta jokaiselle riville li-elementti
        $html .= '<option>' . $row['role_'] . '</option>';
    }
    
    $html .= '</select>';

    // palautetaan kutsujalle
    return $html;
} 

function createActorDropDown() {
    require_once('db.php');
    $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
    
    // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
    $sql = "SELECT DISTINCT name_ FROM Names_ LIMIT 20;";
    
    // Aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    
    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="name_">';
    
    // Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // Tulosta jokaiselle riville li-elementti
        $html .= '<option>' . $row['name_'] . '</option>';
    }
    
    $html .= '</select>';

    // palautetaan kutsujalle
    return $html;
}