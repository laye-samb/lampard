<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Administrateur</title>
    <link rel="stylesheet" type="text/css" href="style\acceuil_admin.css">
</head>
<body>
    <div id="frame">
        <div id="rectangle2">
            <h3>Informations de l'Administrateur :</h3>
            <?php echo displayAdminDetails(); ?>
            <a href="logout.php">Déconnexion</a>
        </div>

        <div id="rectangle3">
            <h3>Statistiques :</h3>
            <p>Nombre de questions : <?php echo getNumberOfQuestions(); ?></p>
            <a href="gestion_questions.php">Gérer les Questions</a>
        </div>

        <div id="rectangle4">
            <h3>Statistiques :</h3>
            <p>Nombre de joueurs : <?php echo getNumberOfPlayers(); ?></p>
            <a href="gestion_joueur.php">Gérer les Joueurs</a>
        </div>

        <div id="rectangle5">
            <h3>Statistiques :</h3>
            <p>Nombre d'administrateurs : <?php echo getNumberOfAdmins(); ?></p>
        </div>

        <div id="rectangle7">
            <h3>Statistiques :</h3>
            <p>Évolution du temps : <?php echo getTimeEvolution(); ?></p>
        </div>

        <div id="rectangle8">
            <h3>Statistiques :</h3>
            <p>Top score : <?php echo getTopScore(); ?></p>
        </div>
    </div>

    <?php
    function displayAdminDetails() {
        include 'config.php';
        $sql = "SELECT * FROM utilisateurs WHERE role='admin' LIMIT 1";
        $result = $connexion->query($sql);

        $admin_details = "";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $admin_details .= "<p>Nom: " . $row['nom'] . "</p>";
            $admin_details .= "<p>Prénom: " . $row['prenom'] . "</p>";

        } else {
            $admin_details = "Aucun détail d'administrateur trouvé.";
        }
        return $admin_details;
    }

    function getNumberOfPlayers() {
        include 'config.php';
        $sql = "SELECT COUNT(*) AS count FROM utilisateurs WHERE role='joueur'";
        $result = $connexion->query($sql);
        return ($result->num_rows > 0) ? $result->fetch_assoc()['count'] : 0;
    }

    function getNumberOfQuestions() {
        include 'config.php';
        $sql = "SELECT COUNT(*) AS count FROM questions";
        $result = $connexion->query($sql);
        return ($result->num_rows > 0) ? $result->fetch_assoc()['count'] : 0;
    }

    function getNumberOfAdmins() {
        include 'config.php';
        $sql = "SELECT COUNT(*) AS count FROM utilisateurs WHERE role='admin'";
        $result = $connexion->query($sql);
        return ($result->num_rows > 0) ? $result->fetch_assoc()['count'] : 0;
    }

    function getTopScore() {
        include 'config.php';
        $sql = "SELECT MAX(score) AS max_score FROM scores";
        $result = $connexion->query($sql);
        return ($result->num_rows > 0) ? $result->fetch_assoc()['max_score'] : 0;
    }

    function getTimeEvolution() {
        include 'config.php';
        $sql = "SELECT DISTINCT DATE(date_score) AS date, COUNT(*) AS total_scores FROM scores GROUP BY DATE(date_score)";
        $result = $connexion->query($sql);

        $time_evolution = "";
        if ($result->num_rows > 0) {
            $time_evolution .= "<ul>";
            while ($row = $result->fetch_assoc()) {
                $time_evolution .= "<li>" . $row['date'] . " : " . $row['total_scores'] . " scores</li>";
            }
            $time_evolution .= "</ul>";
        } else {
            $time_evolution = "Aucune donnée d'évolution du temps disponible.";
        }
        return $time_evolution;
    }
    ?>
</body>
</html>