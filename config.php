<?php

$servername = "mysql-robson.alwaysdata.net";
$username = "robson_boy";
$password = "robson204109";
$dbname = "robson_sql";

$connexion = new mysqli($servername, $username, $password, $dbname);

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}
function getVisibleQuestions($connexion) {
    $sql = "SELECT id, question, option1, option2, option3, option4, reponse_correcte, visible FROM questions WHERE visible = 1";
    $result = $connexion->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
?>