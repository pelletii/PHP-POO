<doctype html>
<html lang="fr">        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head> 
<body>
    <h1>Découverte de la POO en PHP</h1>
    <h2>Exercice 2</h2>


</body>
</html>
<?php
class CompteBancaire {
    public $titulaire;
    public $solde;

    // Constructeur
    public function __construct($titulaire, $soldeInitial) {
        $this->titulaire = $titulaire;
        $this->solde = $soldeInitial;
    }

    public function deposer($montant) {
        $this->solde += $montant;
        echo "Dépôt de $montant €, nouveau soldes : $this->solde €<br>";
    }
}
$monCompte = new CompteBancaire("Alice", 1000);
$monCompte->deposer(200);
?>
