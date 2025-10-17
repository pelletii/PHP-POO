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
    private $solde;
    public $titulaire;

    public function __construct($titulaire, $soldeInitial) {
        $this->titulaire = $titulaire;
        $this->solde = $soldeInitial;
    }

    public function getSolde() {
        return $this->solde;
    }

    public function setSolde($montant) {
        if($montant >= 0) {
            $this->solde = $montant;
        } else {
            echo "Impossible de mettre un solde négatif !<br>";
        }
    }
}
$compte = new CompteBancaire("Clara", 800);
$compte->setSolde(1000); 
$compte->setSolde(-500); 


?>
