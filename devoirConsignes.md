# PHP et programmation POO

## UTILISATION DES CONSTRUCTEURS, SETTER ET GETTER
### Objectifs
- Comprendre et utiliser un constructeur (__construct) pour initialiser un objet
- Comprendre les concepts de visibilité (public, private, protected) et leur utilité
- Utiliser des méthodes d’accès (getters et setters) pour protéger et manipuler les données d’un objet.
### Travail à réaliser : Comprendre l’utilité de ces méthodes
1. exécuter le Script *__exoDecouverte02.php__*
2. Ajouter des commentaire dans le script afin de bien comprendre les différentes instructions.
3. Ouvrir le script *__exoDecouverte02_01.php__*. Expliquer les différences avec *__exoDecouverte02.php__*
4. exécuter le Script *__exoDecouverte02_01.php__* et noter le résultat obtenu.
5. Supprimer les commentaires de la **ligne 40** puis exécuter de nouveau le script. Expliquer le résultat obtenu.
6. Ouvrir le script *__exoDecouverte02_02.php__* puis ajouter des commentaires.
7.	Exécuter le puis expliquer le rôle de la méthode **setSolde()**.
### Exercice 1
Modifier la classe Smartphone avec les éléments suivants :
- propriété **batterie** → private
- méthode **recharger()** → remplit la batterie
- méthode **getBatterie()** → affiche le niveau actuel  
Tester avec un objet $monTel
## PASSAGE D’UN OBJET EN PARAMÈTRE
### Objectifs
- Comprendre la notion de type objet en paramètre d’une méthode.
- Créer une méthode prenant un autre objet en argument.
- Manipuler plusieurs objets qui interagissent entre eux (ex. un smartphone envoyant un message à un autre).
### Découverte du processus 
Deux smartphones peuvent communiquer entre eux : le premier envoie un message au second.
Cela illustre qu’un objet peut interagir avec un autre objet. En PHP, cela se fait en passant un objet en paramètre d’une méthode.
1. exécuter le Script *__exoDecouverte03.php__* et noter le résultat obtenu.
2. Ajouter des commentaire dans le script afin de bien comprendre les différentes instructions et le passage d’un objet en paramètre.
 
### Exercice 2
1. Reprenez la classe Smartphone.

2. Ajoutez la méthode suivante:
```
public function envoyerMessage(Smartphone $destinataire, $message)
```
Cette méthode doit afficher un message du type :
```
Message envoyé à [email du destinataire] : "[contenu du message]"
```
3. Créez deux objets *__$tel1 et $tel2__* avec des adresses mail différentes.
Faites en sorte que $tel1 envoie un message à $tel2.
On souhaite obtenir le résultat suivant :
- Avant la copie :
```
Smartphone : Apple iPhone 14 - Email : alice@icloud.com
Smartphone : Samsung Galaxy S24 - Email : bob@gmail.com
```
- Après la copie :
```
Smartphone : Apple iPhone 14 - Email : bob@gmail.com
Envoi de message :
Message envoyé à bob@gmail.com : "Salut Bob, j’ai copié ton mail !"
```

### Exercice 3
1.	Créer un fichier animal.class.php contenant la définition de la classe Animal.
Cette classe possède les attributs privés suivants :
    - $id
    - $poids
    - $couleur
2.	Dans cette classe, définir :
    - un constructeur pour initialiser les attributs,
    - un destructeur affichant un message à la suppression de l’objet,
    - les accesseurs (getters) et mutateurs (setters) pour chaque attribut.

3.	Ajouter une méthode *__manger(Animal $proie)__* qui simule le fait qu’un animal en mange un autre :
    - l’animal qui mange augmente son poids du poids de la proie,
    - la proie voit son poids remis à 0 et sa couleur effacée (ou remise à "aucune").

4.	Créer un fichier *__utilisationAnimal.php__* qui :
    - instancie deux objets animaux :
        * poisson1, gris, 10 kg
        * poisson2, rouge, 7 kg
    - affiche leurs poids,
    - fait manger poisson2 par poisson1,
    - puis réaffiche leurs poids.

Le résultat attendu est le suivant :
```
L’animal poisson1 a été créé.
L’animal poisson2 a été créé.

Avant le repas :
Poids de poisson1 : 10 kg
Poids de poisson2 : 7 kg

poisson1 mange poisson2 !

Après le repas :
Poids de poisson1 : 17 kg
Poids de poisson2 : 0 kg
Couleur de poisson2 : aucune
L’animal poisson2 est détruit.
L’animal poisson1 est détruit. 
```



