<?php

require_once('../db.php');
$genre = $_GET['genre'];
$conn = createDbConnection(); // Kutsutaan functions.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden

// Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
$sql = "SELECT `primary_title`
FROM `titles` INNER JOIN title_genres
ON titles.title_id = title_genres.title_id
WHERE genre LIKE '%" . $genre . "%'
LIMIT 10;";

// Tarkistukset yms
// Aja kysely kantaan
$prepare = $conn->prepare($sql);

$prepare->execute();

// Tallenna vastaus muuttujaan
$rows = $prepare->fetchAll();

// Tulosta otsikko
$html = '<h1>' . $genre . ' movies</h1>';

// Avaa ul-elementti
$html .= '<ul>';

// Looppaa tietokannasta saadut rivit läpi
foreach($rows as $row) {
    // Tulosta jokaiselle riville li-elementti
    $html .= '<li>' . $row['primary_title'] . '</li>';
}

$html .= '</ul>';

echo $html;