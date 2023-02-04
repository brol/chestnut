# chestnut
thème d'Azork

Le thème est compatible avec [Gravatar] (http://fr.gravatar.com/) pour personnaliser votre avatar dans les commentaires.
L'auteur d'un billet peut afficher une image personnalisée (avatar ou autres) en bas de page. Pour cela, il suffit d'ajouter une image au format jpg de 48px x 48px à la racine du dossier public du blog. Le nom de l'image png doit être identique à celui de l'identifiant de connexion au blog (ex: si votre identifiant de connexion au blog est Toto, alors le nom de l'image sera Toto.jpg).
Les widgets du volet supplémentaire sont intégrés au footer.


Depuis "Personnaliser le thème", il est possible de choisir :
* le type de menu à afficher (Menu des catégories (css/menucat.css) ou Simplemenu (pas de niveau, css/simplemenu.css) ou [Menu] (http://plugins.dotaddict.org/dc2/details/menu) (possibilité de niveaux sous forme verticale, css/menu.css) ou aucun menu)
* la largeur de page (fixe = 1011px / fluide = 98%)
* d'afficher ou non en page d'accueil le slide
* d'afficher ou non le slide dans les pages suivantes de la page d'accueil.


Le slide
--------
Le slide permet d'afficher l'image, le titre et les 120 premiers caractères du billet.
Il est positionné sous la barre de menu, la liste des billets sera en-dessous et la sidebar à leur droite.

Deux choix possibles :
* Pas de slide
* Slide

Par défaut, le slide s'appuie sur les 3 derniers billets sélectionnés. Vous pouvez cependant l'utiliser pour afficher les billets d'une catégorie ou d'un tag.
Pour une catégorie précise on mettra à la place de ```<tpl:Entries selected="1" lastn="3" ignore_pagination="1" no_context="1">``` ceci ```<tpl:Entries category="Url-de-votre-categorie" lastn="3" ignore_pagination="1" no_context="1">```.
Et pour un mot-clé précis, cela ```<tpl:Entries tag="Nom du tag" lastn="3" ignore_pagination="1" no_context="1">```.

Rappel du code du slide :

featured-home.html :

```html
<div id="slider">
  <tpl:Entries selected="1" lastn="3" ignore_pagination="1" no_context="1">
  <div class="slider-container" lang="{{tpl:EntryLang}}">
    <a href="{{tpl:EntryURL}}" class="image-container">{{tpl:EntryFirstImage size="o" class="featured" with_category="1"}}</a>

    <div class="featured-post" role="article">
      <h2 class="post-title"><a href="{{tpl:EntryURL}}">{{tpl:EntryTitle encode_html="1"}}</a></h2>

      <!-- # Entry -->
      <p class="post-content">{{tpl:EntryContent encode_html="1" remove_html="1" full="1" cut_string="120"}}<span class="readmore-ellipsis">...</span></p>
      <p class="read-it right"><a href="{{tpl:EntryURL}}" title="{{tpl:lang Continue reading}} {{tpl:EntryTitle encode_html="1"}}">{{tpl:lang Continue reading}}</a></p>
    </div>
  </div>
  </tpl:Entries>
</div><!-- End #slider -->
```