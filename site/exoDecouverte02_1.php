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
    private $solde;

    // Constructeur
    public function __construct($titulaire, $soldeInitial) {
        $this->titulaire = $titulaire;
        $this->solde = $soldeInitial;
    }

     // Getter
    public function getSolde() {
        return $this->solde;
    }

    public function deposer($montant) {
        $this->solde += $montant;
        echo "Dépôt de $montant €, nouveau solde : $this->solde €<br>";
    }
}
$compte = new CompteBancaire("Bob", 500);
echo $compte->getSolde() ;
echo("<br>"); 
//echo $compte -> solde;
echo $compte -> titulaire;

?>
