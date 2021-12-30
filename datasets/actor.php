<?php

require_once('../db.php');
$name_ = $_GET['name_'];
$conn = createDbConnection(); // Kutsutaan functions.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden

// Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
$sql = "SELECT `primary_title`
    FROM titles, had_role, names_
    WHERE titles.title_id = had_role.title_id
    AND had_role.name_id = names_.name_id
    AND name_ LIKE '%" . $name_ . "%' 
    LIMIT 20;";

// Tarkistukset yms
// Aja kysely kantaan
$prepare = $conn->prepare($sql);

$prepare->execute();

// Tallenna vastaus muuttujaan
$rows = $prepare->fetchAll();

// Tulosta otsikko
$html = '<h1> Movies with ' . $name_ . '</h1>';

// Avaa ul-elementti
$html .= '<ul>';

// Looppaa tietokannasta saadut rivit läpi
foreach($rows as $row) {
    // Tulosta jokaiselle riville li-elementti
    $html .= '<li>' . $row['primary_title'] . '</li>';
}

$html .= '</ul>';

echo $html;