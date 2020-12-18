<?php
require_once('./connect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Puissance 4 - Le Jeu </title>
    <link href="../css/page_connexion.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
<?php
    $error_msg = array();

    if (!empty($_POST['submit'])) {

        //PREPARER la $requete en recherchant tout les éléments du tableau 'membres' où le 'nom' = :nom
        $requete = $bdd->prepare(
            'SELECT * FROM membres WHERE nom = :nom'
        );

        //EXECUTE la $requete et crée un tableau des :nom qui sont égales au 'nom' envoyé dans le formulaire par "post"
        $requete->execute(
            array(':nom' => $_POST['nom'])
        );

        $reponse = $requete->fetch();

        if (is_array($reponse)) {
            //&#9888; = [!]
            $error_msg[] = "&#9888; Nom déja utilisé";
        }

        if ($_POST['mdp'] != $_POST['mdp2']) {
            $error_msg[] = "&#9888; Pas le même mot de passe";
        }

        //mail avec le bon format
        $verif_mail = $_POST['mail'];
        if (!preg_match("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/", $verif_mail)) {
            $error_msg[] = "&#9888; Adresse mail non valide";
        }

        if (!count($error_msg)) {
            //Elements Validés
            $nom = $_POST['nom'];
            $mail = $_POST['mail'];

            // Hachage du mot de passe
            $mdp_hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

            // Insertion
            $req = $bdd->prepare(
                'INSERT INTO membres (nom, mdp, mail) VALUES($nom, $mdp, $mail)'
            );
            $req->execute(
                array(
                    'nom' => $nom,
                    'mdp' => $mdp_hash,
                    'mail' => $mail
                )
            );
            //Emmène sur la page connexion
            header('Location: ../index.php');
            exit;
        }
    }
?>
    <h1 class="Titre">
        Pui<b class="S_violet">s</b><b class="S_vert">s</b>ance 4
    </h1>

    <div class="connexion">
        <h2>
            Inscription
        </h2>

        <form method="POST" action="page_inscription.php">
            <p>
                <label>
                    <input type="text" placeholder="Nom" name="nom"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="password" placeholder="Mot de Passe" name="mdp" autocomplete="on"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="password" placeholder="Retapez votre Mot de Passe" name="mdp2" autocomplete="on"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="text" placeholder="mail@agence.com" name="mail"/>
                </label>
            </p>
            <p>
                <label>
                    <button type="submit" value="1" class="BTN_valider" name="submit"> S'inscrire </button>
                </label>
            </p>
        </form>
    </div>
    <div class="questioncompte">
        <h5>
            Déjà un compte ?
        </h5>
        <a href="../index.php" class="inscription">
            > Connexion <
        </a>
    </div>

</body>


</html>