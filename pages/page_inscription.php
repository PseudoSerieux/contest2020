<?php
require_once('./connect.php');

    //$error_message contient un tableau
    //l'annoncer en dehors du "if" permet de ne pas afficher d'error
    //car il est utilisé en dehors du "if" => dans le formulaire.
    $error_msg = array();

    //SI la variable "$_POST['submit'] N'EST PAS VIDE (!), ALORS ...
    //quand on valide le formulaire, la valeur est de '1'
    //car on lui donne value="1" au bouton <button type="submit"....></button>
    //DONC cette partie de vérification ne se lance que quand la valeur de 'submit' passe à 1,
    //donc au moment où l'on appuit sur le bouton et qu'on valide le fromulaire
    if (!empty($_POST['submit'])) {

        //PREPARER la $requete en recherchant tout les éléments
        // du tableau 'membres' où le 'nom' = :nom
        $requete = $bdd->prepare(
            'SELECT * FROM membres'
        );

        //EXECUTE la $requette et crée un tableau des :nom
        //qui sont égales au 'nom' envoyé dans le formulaire par "post"
        $requete->execute(
            array(':nom' => $_POST['nom'])
        );

        //$reponse = $requete -> Récupère la ligne suivante du tableau.
        //(on lui demande une seule ligne car si le nom est identique
        //à 1 nom c'est déja pas possible, inutile de charger tout le tableau)
        $reponse = $requete->fetch();

        //SI $reponse a un tableau avec des valeurs ALORS...
        //($reponse a un tableau avec des valeurs dès que des nom se resemblent)
        if (is_array($reponse)) {
            $error_msg[] = "&#9888; nom déja utilisé"; //&#9888; = picto [!]
        }

        //SI le mdp = mdp2 ALORS...
        if ($_POST['mdp'] != $_POST['mdp2']) {
            $error_msg[] = "&#9888; Pas le même mot de passe";
        }

        $verif_mail = $_POST['mail'];
        //On verifie que l'mail à le bon format avec une expression régulière
        if (!preg_match("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/", $verif_mail)) {
            $error_msg[] = "&#9888; Adresse mail non valide";
        }

        //SI tu ne comptes aucun éléments dans le tableau 'array()' de la fonction $error_msg, ALORS ...
        if (!count($error_msg)) {

            //Elements Validés
            $nom = $_POST['nom'];
            $mail = $_POST['mail'];

            // Hachage du mot de passe
            $pass_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

            // Insertion
            $req = $bdd->prepare(
                'INSERT INTO membres(nom, pass, mail, date_inscription) VALUES(:nom, :pass, :mail, CURDATE())'
            );
            $req->execute(
                array(
                    'nom' => $nom,
                    'pass' => $pass_hache,
                    'mail' => $mail
                )
            );

            //Emmène sur la page connexion
            header('Location: ../index.php');
        }
    }
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
                    <input type="text" placeholder="mail@agence.com" name="mail"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="password" placeholder="Mot de Passe" name="mdp"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="password" placeholder="Retapez votre Mot de Passe" name="mdp2"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="submit" value="S'inscrire" class="BTN_valider" name="submit">
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