<?php

// On créer une nouvelle connexion à la BDD
try {

$db = new PDO('mysql:host=localhost;dbname=immobilier;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL
    // On récupérer tous les résultats en tableau associatifs
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

} catch(Exception $e){
    echo $e->getMessage();
    // Redirection en PHP vers Google avec le message d'erreur concerné
    header('Localisation: https://www.google.fr/search?q='.$e->getMessage());
    echo '<img src="https://st3.depositphotos.com/5572142/13058/v/1600/depositphotos_130581556-stock-illustration-vectors-abstract-background-505-connection.jpg">';
    die('Stop'); // Arrête le script si la base de donnés n'est pas dipo
}