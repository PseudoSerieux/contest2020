<?php
require_once('./pages/connect.php');

$message_erreur = array();

if (!empty($_POST['submit'])) {

    $nom = $_POST['nom'];
    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT id, mdp FROM membres WHERE nom = :nom');
    $req->execute(
        array(':nom' => $nom)
    );
    $resultat = $req->fetch();

    if (!$resultat) {
        $message_erreur[] = 'Mauvais identifiant ou mot de passe !';
    } else {

        // Comparaison du mdp envoyé via le formulaire avec la base
        $is_password_correct = password_verify($_POST['mdp'], $resultat['mdp']);

        if ($is_password_correct) {
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['nom'] = $nom;

            unset($_COOKIE['nom']);
            setcookie('nom', null, time() - 1);
            unset($_COOKIE['mdp']);
            setcookie('mdp', null, time() - 1);

            header('Location: ./pages/page_principale.html');

        } else {
            $message_erreur[] = 'Mauvais identifiant ou mot de passe !';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Puissance 4 - Le Jeu </title>
    <link href="css/page_connexion.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>
<body>
    <h1 class="Titre">
        Pui<b class="S_violet">s</b><b class="S_vert">s</b>ance 4
    </h1>

    <div class="connexion">
        <h2>
            Connexion
        </h2>

        <form>
            <p>
                <label>
                    <input type="text" placeholder="Nom" name="nom"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="password" placeholder="MDP" name="mdp" autocomplete="on"/>
                </label>
            </p>
            <p>
                <label>
                    <button type="submit" value="1" class="BTN_valider"> Se connecter </button>
                </label>
            </p>

            <p>
                <label>
                    <a href="./pages/page_principale.php"> <input type="button" value="Accéder directement à la page principale "> </input> </a>
                </label>
            </p>
        </form>
    </div>
    <div class="questioncompte">
        <h5>
            Pas de compte ?
        </h5>
        <a href="./pages/page_inscription.php" class="inscription">
            > Inscription <
        </a>
    </div>
</body>


</html>