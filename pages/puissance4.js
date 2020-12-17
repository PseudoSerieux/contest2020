class Puissance4 {

    constructor(element_id, lignes=6, colonnes=8) {
      this.lignes = lignes;
      this.colonnes = colonnes;

      this.board = Array(this.lignes);
      for (let i = 0; i < this.lignes; i++) {
        //   0: case vide
        //   nombre impair : pion du joueur 1
        //   nombre pair : pion du joueur 2
        this.board[i] = Array(this.colonnes).fill(0);
      }

      // Numéro du prochain joueur (+1)
      this.turn = 1;
      // Nombre de coups joués
      this.moves = 0;
      
      /* si: null: la partie continue
             0: la partie est nulle
             1: joueur 1 a gagné
             2: joueur 2 a gagné
      */
      this.winner = null;
  
      // L'élément HTML où se fait l'affichage
      this.element = document.querySelector(element_id);
      // Gestion du clic
      this.element.addEventListener('click', (event) => this.handle_click(event));
      // Affichage
      this.render();
    } 
    // Fin du constructor
    
    // Plateau de jeu dans le HTML
    render() {
      let table = document.createElement('table');

      for (let i = this.lignes - 1; i >= 0; i--) {
        let tr = table.appendChild(document.createElement('tr'));
        for (let j = 0; j < this.colonnes; j++) {
          let td = tr.appendChild(document.createElement('td'));
          let colour = this.board[i][j];
            if (colour)
              td.className = 'player' + colour;
              td.dataset.colonne = j;
        }
      }

      this.element.innerHTML = '';
      this.element.appendChild(table);
    }
    
    // Case colorée pour le pion posé selon le joueur & coup compté
    set(ligne, colonne, player) {
      this.board[ligne][colonne] = player;
      this.moves++;
    }

    // Ajoute un pion dans une colonne
    play(colonne) {
    let ligne;

        for (let i = 0; i < this.lignes; i++) {
          if (this.board[i][colonne] == 0) {
            ligne = i;
            break;
          }
        }

        if (ligne === undefined) {
          return null;
        } else {
          // Effectue le coup
          this.set(ligne, colonne, this.turn);
          return ligne;
        }
    }

    // Verifier si la partie est encore en cours
    handle_click(event) {
      if (this.winner !== null) {
        if (window.confirm("Perdu\n\nVoulez-vous rejouer ?")) {
            this.reset();
            this.render();
        }
        return;
      }
  
        let colonne = event.target.dataset.colonne;

      if (colonne !== undefined) {
        colonne = parseInt(colonne);
        let ligne = this.play(parseInt(colonne));
      
        // Vérifier s'il y a un gagnant, ou si la partie est finie
        if (ligne === null) {
          window.alert("colonne is full!");
        } else { 
          if (this.win(ligne, colonne, this.turn)) {
            this.winner = this.turn;
          } else if (this.moves >= this.lignes * this.colonnes) {
            this.winner = 0;
          }

          // Passer le tour : 3 - 2 = 1, 3 - 1 = 2
          this.turn = 3 - this.turn;
          // Mettre à jour l'affichage
          this.render()
          
          switch (this.winner) {
            case 0: 
              window.alert("Egalité entre vous !"); 
              break;
            case 1:
              window.alert("Le joueur 1 a gagné !"); 
              break;
            case 2:
              window.alert("Le joueur 2 a gagné !"); 
              break;
          }
        }
      }
    }
    
    /*  Vérifie si le coup dans la case `ligne`, `colonne` par le joueur `player` est un coup gagnant.
        Renvoie true : si la partie est gagnée par le joueur `player`
                false : si la partie continue   */
    win(ligne, colonne, player) {
        // Horizontal
      let count = 0;
      for (let j = 0; j < this.colonnes; j++) {
        count = (this.board[ligne][j] == player) ? count+1 : 0;
        if (count >= 4) 
        return true;
      }
        // Vertical
      count = 0;
      for (let i = 0; i < this.lignes; i++) {
        count = (this.board[i][colonne] == player) ? count+1 : 0;
          if (count >= 4) 
          return true;
      }
        // Diagonale
      count = 0;
      let shift = ligne - colonne;
      for (let i = Math.max(shift, 0); i < Math.min(this.lignes, this.colonnes + shift); i++) {
        count = (this.board[i][i - shift] == player) ? count+1 : 0;
          if (count >= 4) 
          return true;
      }
        // Diagonale inverse
      count = 0;
      shift = ligne + colonne;
      for (let i = Math.max(shift - this.colonnes + 1, 0); i < Math.min(this.lignes, shift + 1); i++) {
        console.log(i,shift-i,shift)
        count = (this.board[i][shift - i] == player) ? count+1 : 0;
        if (count >= 4) 
        return true;
      }
      
      return false;
    }
  
    // Vide le plateau quand la partie est finie
    reset() {
      for (let i = 0; i < this.lignes; i++) {
        for (let j = 0; j < this.colonnes; j++) {
          this.board[i][j] = 0;
        }
      }
     this.move = 0;
     this.winner = null;
    }

  } //fin class
  
  // Initialisation du plateau dans le HTML
  let p4 = new Puissance4('#game');