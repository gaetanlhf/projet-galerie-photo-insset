<div>
  <h3 align="center"><img src="/.img/logo.png"/><br>Galerie photo INSSET</h3>
</div>

# Introduction
Étudiant : Gaëtan LE HEURT-FINOT  
Sujet : Galerie photo  
Cours : Framework et Modélisation des systèmes  
Cursus : Licence 3 Sciences et Technologies parcours Métiers du Numérique  
Année universitaire : 2021/2022

## Cahier des charges
### 1. Un internaute se connecte au site
Une galerie est affichée, choisie aléatoirement parmi les utilisateurs ayant publié des photos.  
Les autres galeries sont listées à gauche, identifiées par le pseudo de l’utilisateur.  
Le formulaire d’authentification se trouve en haut à droite, demandant d’entrer :

- une adresse de courriel,
- un mot de passe.

### 2. Un internaute demande un compte
Une boîte de dialogue apparaît avec un formulaire demandant les informations suivantes :

- un pseudo,
- une adresse de courriel,
- un âge,
- une validation d’un captcha.

Tant que le formulaire n’est pas correctement rempli, la validation boucle sur le même formulaire avec des infos sur les erreurs.  
Après la validation de son inscription, l’internaute reçoit par courriel un mot de passe généré lui permettant de se connecter à son compte.  
Après la validation de son inscription, il est redirigé sur la page consultée avant l’accès au formulaire.

### 3. Un utilisateur accède à son compte
Contrainte : si l’utilisateur se trompe trois fois de mots de passe, son compte est bloqué (faire le décompte des échecs et prévenir avant blocage).  
Les photos doivent être affichées dans un damier de quatre colonnes et de trois lignes.  
Scroll du damier pour naviguer dans les photos.  
En haut de page, un bouton doit être présent afin de permettre l’ajout de photos.  
Sous chaque photo, deux cases doivent être présentes :

- une avec le numéro d’ordre de la photo dans la galerie publique,
- une autre avec un bouton permettant de supprimer la photo.

La date d’ajout et la taille de chaque photo doivent être également affichées.

### 4. Un utilisateur ajoute une photo
L’utilisateur authentifié ouvre une boîte de dialogue, qui comprend :

- un champ pour téléverser une photo,
- un bouton de validation.

Après validation, le serveur effectue les vérifications suivantes sur la photo :

- si le format de l’image est jpg, jpeg ou png,
- si elle ne fait pas plus de 5 Mo.

Si tout est correct, la photo est ajoutée au damier, sinon, retour au formulaire avec informations sur l’erreur.

### 5. Un utilisateur publie une photo
L’utilisateur publie une photo en indiquant un numéro d’ordre à la photo.  
S’il n’y a pas de numéro d’ordre, la photo n’est pas publiée dans la galerie.

### 6. Un utilisateur supprime une photo
Via le bouton suppression sous la photo.  
La suppression se fait après une confirmation.

### 7. Un utilisateur se déconnecte de son compte
Via un bouton situé en haut à droite.  
Après déconnexion, l’utilisateur retourne sur la page d’accueil publique.

### 8. L'administrateur accède à son compte
Il accède à une liste des utilisateurs.  
Il peut :

- supprimer un compte utilisateur (cela inclut toutes les photos),
- débloquer un compte.

### 9. Un administrateur se déconnecte de son compte
Via un bouton situé en haut à droite.  
Après déconnexion, l’administrateur retourne sur la page d’accueil.

## Captures d'écran
### Page d’accueil
<img src="/.img/accueil.png"/>

### Boîte de dialogue d’inscription
<img src="/.img/inscription.png"/>

### Visite d’une galerie photo publique
<img src="/.img/galerie_publique.png"/>

### Gestion de la galerie photo d’un utilisateur
<img src="/.img/galerie_privee.png"/>

### Boîte de dialogue d’ajout d’une photo
<img src="/.img/ajout_photo.png"/>

### Boîte de dialogue de suppression d’une photo
<img src="/.img/suppression_photo.png"/>

### Interface de gestion des utilisateurs
<img src="/.img/interface_admin.png"/>

### Boîte de dialogue de suppression d’un compte utilisateur
<img src="/.img/suppression_compte.png"/>

### Boîte de dialogue de réactivation d’un compte utilisateur
<img src="/.img/reactivation_compte.png"/>