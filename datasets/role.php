<?php

require_once('../db.php');
$role_ = $_GET['role_'];
$conn = createDbConnection(); // Kutsutaan functions.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden

// Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
$sql = "SELECT primary_title, start_year, average_rating 
    FROM titles, had_role, title_ratings
    WHERE titles.title_id = had_role.title_id  
    AND titles.title_id = title_ratings.title_id
    AND role_ LIKE '%" . $role_ . "%'
    GROUP BY titles.title_id 
    ORDER BY average_rating DESC
    LIMIT 20;";

// Tarkistukset yms
// Aja kysely kantaan
$prepare = $conn->prepare($sql);

$prepare->execute();

// Tallenna vastaus muuttujaan
$rows = $prepare->fetchAll();

// Tulosta otsikko
$html = '<h1>Movies with ' . $role_ . '</h1>';

// Avaa ul-elementti
$html .= '<ul>';

// Looppaa tietokannasta saadut rivit läpi
foreach($rows as $row) {
    // Tulosta jokaiselle riville li-elementti
    $html .= '<li>' . $row['primary_title'] . '</li>';
}

$html .= '</ul>';

echo $html;

$genre = $_GET['genre'];

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