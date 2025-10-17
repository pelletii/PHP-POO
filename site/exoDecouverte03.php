<?php
class Smartphone {
    public $marque;
    public $modele;
    public $email;

    public function __construct($marque, $modele, $email) {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function afficherInfos() {
        echo "Smartphone : $this->marque $this->modele - Email : $this->email<br>";
    }

    public function copierEmail(Smartphone $autreTel) {
        $this->email = $autreTel->email;
    }
}

// Création de deux objets
$tel1 = new Smartphone("Apple", "iPhone 14", "alice@icloud.com");
$tel2 = new Smartphone("Samsung", "Galaxy S24", "bob@gmail.com");

echo "<b>Avant la copie :</b><br>";
$tel1->afficherInfos();
$tel2->afficherInfos();

// Passage d’un objet en paramètre
$tel1->copierEmail($tel2);

echo "<br><b>Après la copie :</b><br>";
$tel1->afficherInfos();
?>
