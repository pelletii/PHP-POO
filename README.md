# Codespace PHP avec mariadb

## Arborescence du dépôt

Voici l'arborescence du dépôt et le rôle des différents composants. Les fichiers et dossiers à modifier sont en gras :

├── .devcontainer/ # config du codespace
|  ├── devcontainer.json # Configuration du Dev Container pour VS Code
|  └── Dockerfile # Dockerfile pour construire l'image du Dev Container  dans mariadb 
├── .github/ # config pour les alertes de dépendances (sécurité)
├── .vscode/ # config pour XDebug et parametres de vscode
├── database # scripts pour la BDD
|  ├── scripts # contient 3 scripts bash : 1 pour initialiser la BDD métier (avec ses utilisateurs système), 1 pour sauver la bdd métier du codespace et 1 pour la recharger à partir du .sql présent dans le dépot
|  └── sources-sql # fichiers SQL pour contruire la BDD métier, ses utilisateurs et ses données 
├── site # Dossier racine du serveur web
├── start.sh # Script de lancement pour démarrer le service mariadb et les instances web du site et de phpMyAdmin.
└── stop.sh # Script pour arreter le service mariadb et les instances web du site et de phpMyAdmin.


## Configuration du Codespace et lancement de l'application

### Rappel sur les droits sous Linux
Sous Linux, chaque dossier et chaque fichier appartient à un utilisateur et à un groupe et possède des droits.
Ces droits se divisent en trois :
* Les droits pour l'utilisateur propriétaire
* Les droits pour les utilisateurs membres du groupe propriétaire
* Les droits pour tous les autres utilisateurs
 #### Les droits rwx
* _r (read)_ : lire le contenu d'un fichier 
* _w (write)_ : écrire un fichier (nano), écrire dans un dossier (touch)
* _x (execute)_ : exécuter un fichier, entrer dans un dossier (cd)
 #### Exemple
 **```_drwxr-x--- 3 stc friends 4096 mars 31 19:11 .dir_```**
 * Le premier caractère indique que l'élément est un dossier (d) ou un fichier (-).
 * Les trois caractères suivants indiquent les droits de l'utilisateur propriétaire (ici stc a les droits rwx : lire, écrire, parcourir)
 * Les trois caractères suivants indiquent les droits des utilisateur membres du groupe propriétaire (ici les membres de friends ont les droits r-x : lire et parcourir, mais pas écrire)
 * Les trois caractères suivants indiquent les droits des autres utilisateurs (ici --- : aucun droit)
 * Le nombre suivant indique le nombre de sous-dossiers dans le dossier listé (ici .dir a 3 sous-dossiers, dont . et .. donc un seul vrai sous-dossier)
 * La chaîne suivante indique l'utilisateur propriétaire (ici l'utilisateur stc)
 * La chaîne suivante indique le groupe propriétaire (ici le groupe friends)
 * Le nombre suivant indique la taille de l'élément en octets (ici 4096 octets)
 * La chaîne suivante indique la date et l'heure de dernière modification du fichier (ici le 31 mars à 19h11)
 * La dernière chaîne est le nom du fichier (ici .dir)
### Configuration 
Ce dépôt est configuré pour fonctionner avec les Codespaces de GitHub et les Dev Containers de Visual Studio Code. Suivez les étapes ci-dessous pour configurer votre environnement de développement.

!important! 
Pour être executables, les scripts bash executés dans le codespace (start.sh, stop.sh, initBDD.sh, ...) doivent avoir les bonnes permissions.

1. Utilisez la commande ```ls -l``` pour afficher les permissions des fichiers dans le répertoire contenant vos scripts bash.
Cela affichera les permissions actuelles des fichiers. Les scripts doivent avoir l'autorisation d'exécution (x) pour être exécutables.

2. Ajouter les droits d'exécution
Si les scripts n'ont pas les bonnes permissions, utilisez la commande chmod pour leur ajouter les droits d'exécution :
```chmod +x ./start.sh ./stop.sh ./database/scripts/*.sh```


### Utilisation avec GitHub Codespaces
1. **Créez un codespace pour ouvrir ce dépot** :
   - Cliquez sur le bouton "Code" dans GitHub et sélectionnez "Open with Codespaces".
   - Si vous n'avez pas encore de Codespace, cliquez sur "New Codespace".

   Le Codespace ainsi créé contient toutes les configurations nécessaires pour démarrer le développement.

### Serveur php et service mariadb (avec la base métier)

1. **Pour lancer les services** :
   - Dans le terminal, exécutez le script `start.sh` :
     ```bash
     ./start.sh
     ```
   Ce script démarre le serveur PHP intégré sur le port 8000, démarre mariadb 

2. **Ouvrir le service php dans un navigateur** :
   - Accédez à `http://localhost:8000` pour voir la page d'accueil de l'API.

3. **Accèder à la BDD** :
   - En mode commande depuis le client mysql en ligne de commande
   Exemple : 
      ```bash
      mysql -u mediateq-web -p
      ```
   - En client graphique avec l'extension Database dans le codespace (Host:127.0.0.1)

   - avec phpMyAdmin sur le port 8080 : `http://localhost:8080`

4. **initialiser la BDD** :
   - Au premier démarrage, créez la bdd métier avec le fichier sql 
      ```bash
      ./database/scripts/initBDD.sh 
      ```

5. **Sauver et mettre à jour la BDD** :
   - A chaque fois que vous avez fait des modifs significatives dans la BDD métier, lancer le script bash saveBDD pour écraser le fichier sql actuel de la bdd par votre sauvegarde (puis pensez à push sur le distant pour vos collaborateurs)
      ```bash
      ./database/scripts/saveBDD.sh 
      ```
   - Si des modifs ont été faites à la BDD et que vous avez récupéré du dépot distant (pull) une version mise à jour du script de la BDD métier, lancer le script bash reloadBDD pour écraser la bdd actuelle de votre codespace par celle du script récupéré.
      ```bash
      ./database/scripts/reloadBDD.sh 
      ```

## Utilisation de XDebug

Ce Codespace contient XDebug pour le débogage PHP. 

1. **Exemple de déboguage avec Visual Studio Code** :
   - Ouvrez le panneau de débogage en cliquant sur l'icône de débogage dans la barre latérale ou en utilisant le raccourci clavier `Ctrl+Shift+D`.
   - Sélectionnez la configuration "Listen for XDebug" et cliquez sur le bouton de lancement (icône de lecture).
   - Ouvrez un fichier php
   - Ajouter un point d'arrêt.
   - Solicitez dans le navigateur une page qui appelle le traitement
   - Une fois le point d'arrêt atteint, essayez de survoler les variables, d'examiner les variables locales, etc.

[Tuto Grafikart : Xdebug, l'exécution pas à pas ](https://grafikart.fr/tutoriels/xdebug-breakpoint-834)


## Tests unitaires

Ce projet utilise PHPUnit pour les tests unitaires.

1. ** Installer les dépendances **
Pour exécuter les tests unitaires, assurez-vous que les dépendances nécessaires sont installées via Composer en executant :
```bash
composer install
```
2. ** Lancer les tests **
Une fois les dépendances installées, lancez les tests avec la commande suivante :
```bash
vendor/bin/phpunit --testdox tests/
```
Cela exécutera tous les tests définis dans le projet et affichera les résultats dans le terminal.

3. ** Structure des tests **
Les tests sont organisés dans le répertoire ``tests/`` et suivent cette structure :
- tests/modele/ : Contient les tests pour les modèles (par exemple, BateauModeleTest.php).
- tests/controleur/ : Contient les tests pour les contrôleurs (par exemple, BateauControleurTest.php).


4. ** Ajouter de nouveaux tests **
Pour ajouter un nouveau test :
- Créez un fichier de test dans le répertoire approprié (par exemple, tests/modele/NouveauModeleTest.php).

- Assurez-vous que le fichier suit la convention de nommage `NomClasseTest.php` et que la classe de test étend `PHPUnit\Framework\TestCase`.

Exemple de test unitaire simple :

```php
<?php

use PHPUnit\Framework\TestCase;

class ExempleTest extends TestCase
{
   public function testAddition()
   {
      $this->assertEquals(4, 2 + 2);
   }
}
```

Une fois le test ajouté, relancez la commande PHPUnit pour vérifier son bon fonctionnement.

## Documentation

**phpDocumentor** est un outil qui permet de générer automatiquement la documentation technique de votre code PHP à partir des commentaires présents dans vos fichiers source.

**Fonctionnement :**
- *Commentaires PHPDoc* : Vous commentez vos classes, fonctions et propriétés avec des blocs de commentaires spéciaux (PHPDoc).
- *Génération automatique* : phpDocumentor analyse ces commentaires et crée une documentation HTML structurée et navigable.
- *Personnalisation* : Vous pouvez choisir le dossier à documenter (```-d ./site```) et le dossier de sortie (```-t ./documentation```).

**Exemple de commentaire PHPDoc :**
```php
<?php
/**
 * Additionne deux nombres.
 *
 * @param int $a
 * @param int $b
 * @return int
 */
function addition(int $a, int $b) : int {
    return $a + $b;
}
```
plus d'infos sur [le guide phpDocumentor](https://docs.phpdoc.org/guide/getting-started/what-is-a-docblock.html#what-is-a-docblock)

**Commande de génération :**
```
php phpDocumentor.phar run -d ./site -t ./documentation
```
- ```-d ./site``` : dossier contenant le code à documenter.
- ```-t ./documentation``` : dossier où sera générée la documentation HTML.

**Résultat :**
Après exécution, ouvrez le fichier index.html sur le serveur executé sur le port 8001 dans un navigateur pour consulter la documentation de votre projet.


