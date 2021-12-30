<?php

// form.php:ssa käyttöliittymä kokeily, ei tulosta hakutuloksia, mutta hakee tiedot dropdown -valikkoihin

require_once('functions.php');

$html = '<h1>Search Movies!</h1>';
$html .= '<form action="GET">';

$html .= '<p>Actor:</p>' . createActorDropDown();
$html .= '<p>Genre:</p>' . createGenreDropDown();
$html .= '<p>Average ratings:</p>' . createAverageRatingsDropDown();
$html .= '<p>Role:</p>' . createRoleDropDown();

$path = 'datasets';

if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;
                            
        $html .= '<div><br><input type="submit" value="' . basename($file, ".php") . '" formaction="' . $path . "/" . $file . '"></div>';
    }
    closedir($handle);
}

$html .= '</form>';

echo $html;


