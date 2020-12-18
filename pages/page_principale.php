<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Puissance 4 - Le Jeu </title>
    <link href="../css/page_principale.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" type="image/png" href="../css/icone/puissance4.ico" />
</head>
<body>
    <h1 class="Titre">
        Pui<b class="S_violet">s</b><b class="S_vert">s</b>ance 4
    </h1>

    <div class="LigneCercle">

        <div class="cercle_vert">
        </div>
        <div class="cercle_violet">
        </div>
        <div class="cercle_vert">
        </div>
        <div class="cercle_violet">
        </div>

        <button type="submit" class="BTN_jouer" onclick="popup()">Jouer</button>

        <div class="cercle_vert">
        </div>
        <div class="cercle_violet">
        </div>
        <div class="cercle_vert">
        </div>
        <div class="cercle_violet">
        </div>

    </div>

    <aside class="BLOC_joueur">
        <h6>
            Pseudo_du_joueur
        </h6>
        <p class="text_score">
            Score du joueur
        </p>
        <p class="score_joueur">
            0
        </p>
        <input type="submit" value="Déconnexion" class="BTN_deconnexion"/>
    </aside>

    <div class="popup_choix">
        <a href="puissance4_IA.html"><input type="submit" value="1 Joueur" class="BTN_1joueur"/></a>
        <br/>
        <a href="puissance4.html"><input type="submit" value="2 Joueurs" class="BTN_2joueur"/></a>
        <br/>
        <input type="submit" value="&#10006;" class="BTN_fermer" onclick="popupferme()"/>
    </div>

    <div class="scores">

    <?php
            $bdd = new PDO('mysql:host=localhost;dbname=puissance4', 'root', '');
            $reponse = $bdd->query('SELECT * FROM membres GROUP BY score ORDER BY score DESC');

            $classement = 1;

            while ($donnees = $reponse->fetch()) {
                echo '<p  class="scores_ligne"> <b class="numero">N°'. $classement .'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $donnees['nom'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $donnees['score'] . ' points</p>';
                echo '</br>';
                $classement++;
            }
        ?>

    </div>
    <script src="page_principale.js" type="text/javascript"></script>
</body>


</html>