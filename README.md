# READ ME DU CAMPUS CONTEST 17/12 & 18/12

### __Membres__ :
    - Yann Lebouc     (B2 Switch IT - Dev)
    - Margaux Dechaud (B3 Switch IT - Dev)

### - __Présentation du projet__ :

Le Campus Contest du 17 & 18 décembre 2020 à Campus Academy concerne la création d'un Puissance 4 dans la finalité 
d'être utilisé par des entreprises nécéssitant des gains de motivation, de productivité et de créativité.

Notre Puissance 4 est élaboré de sorte a être le plus ergonomique possible et intelligible pour tous. 

Il s'agit là de retrouver le jeu traditionnel dans une application web, pouvant être joué joueur contre joueur (sur le même support) ou joueur contre IA !

### - __Aspect technique__ :

Notre application web est développée avec HTML/CSS/Javascript pour la partie front (sans framework).

La partie back quant à elle est développée en PHP.

Toute documentation (conceptions techniques et spécifications fonctionnelles) sont explicités sous le dossier [`Documentation`].

###  - __Maquette__ :

Nous avons mis a disposition une maquette de notre application web sous le dossier [`Maquette`] en png. 

La maquette a été réalisée sur Adobe Illustrator, d'un format de 1920 x 1080.

La maquette a été conçue dans le but de nous faire gagner un maximum de temps et de se mettre d'accord sur la réalisation de notre application web.

L'application en tant que telle ne la respecte pas à 100% pour les raisons exprimées dans la partie `Problèmes Rencontrés`.

###  - __Installation du projet__ :
Pour installer notre projet il vous faut le cloner depuis votre www/ (sous wamp ou peu importe):
- git clone https://github.com/PseudoSerieux/contest2020.git

Importer la base de donnée (trouvable dans le dossier [`bdd`]) dans phpmyadmin.

Rendez-vous sur http://localhost/contest2020/index.php !

###  - __Problèmes Rencontrés__ :

La gestion de compte (concernant connexion/inscription/déconnexion) non réalisée pour des raisons de temps.

Seulement, une ébauche est présente sur les pages index.php et page_inscription.php mais elles sont non fonctionnelles (notamment car la bdd ne récupère pas le formulaire d'inscription).

L'IA pour la partie joueur vs IA fonctionne partiellement : celle-ci affiche dans la console le placement de son jeton. Le jeton ne s'affiche pas.

Malheureusement 2 jours pour tout réaliser n'a pas été en notre faveur. Nous aurions sûrement pu résoudre ces problèmes rencontrés si nous avions eu plus de temps.