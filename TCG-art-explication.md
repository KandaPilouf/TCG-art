# TCG Art — Document d'explication du projet

> _Document généré automatiquement à partir du repo [`KandaPilouf/TCG-art`](https://github.com/KandaPilouf/TCG-art)._
> _Dernière mise à jour : **20 avril 2026** — dernier commit analysé : `6b050f3` (« first draft html catalogue ») du 10 avril 2026._

---

## 1. Vue d'ensemble du projet

**TCG Art** est un site web qui regroupe des collections de cartes issues de plusieurs jeux de cartes à collectionner (TCG) différents — Yu-Gi-Oh!, Pokémon, Magic: The Gathering, etc. La particularité du projet est qu'il permet à l'utilisateur de **créer des collections personnelles basées uniquement sur les qualités artistiques et visuelles des cartes**, plutôt que sur leur rareté ou leur valeur marchande.

### Intention et proposition de valeur

Là où la plupart des plateformes existantes (TCG Arena, LimitlessTCG…) privilégient la rareté, la méta compétitive ou la valeur financière, TCG Art assume un parti pris résolument esthétique : la carte est traitée comme un objet d'art, et la collection comme une démarche de curation visuelle transversale aux univers de jeu.

### Public cible

Le projet vise les collectionneurs pour qui l'aspect visuel prime sur la rareté, ainsi que les amateurs d'illustration et d'art en général. Trois personas structurent la réflexion UX :

- **Léa, 24 ans** — étudiante en design graphique, collectionneuse Pokémon cherchant à explorer d'autres jeux uniquement pour leurs visuels, et à partager ses compositions sur les réseaux.
- **Thomas, 38 ans** — développeur web et collectionneur de longue date qui souhaite organiser ses centaines de cartes par univers visuel (dark fantasy, cyberpunk, mythologie) plutôt que par jeu d'origine.
- **Sophie, 52 ans** — enseignante en arts plastiques, novice en TCG, qui voit les cartes comme un medium artistique et cherche une interface simple et sans jargon pour construire des sélections pédagogiques.

### Positionnement concurrentiel

Une analyse comparative a été menée face à deux références du domaine :

| Site | Navigation | Lisibilité | Accessibilité | Responsive | Points forts | Points faibles |
| --- | :---: | :---: | :---: | :---: | --- | --- |
| TCG Arena | 4/5 | 4/5 | 2/5 | 2/5 | Beau, intuitif | Pas de version mobile verticale |
| LimitlessTCG | 2/5 | 2/5 | 4/5 | 4/5 | Rapide | Peu esthétique |

Les scores Lighthouse des concurrents restent modérés (perf. mobile 33–41, desktop 39–51), ce qui laisse de la marge à TCG Art pour se démarquer à la fois sur l'**esthétique** et sur la **performance / accessibilité**.

---

## 2. Architecture technique

### Stack

Le projet est développé en **PHP natif** avec une base **MySQL** et des styles **CSS vanilla** (pas de framework JS ni CSS à ce stade). L'arborescence est volontairement simple, conçue autour d'un point d'entrée unique `index.php` qui fait office de routeur léger.

### Arborescence du repo

```
TCG-art/
├── index.php              # Routeur : lit ?categorie= ou ?item= et inclut la page
├── home.php               # Accueil (titre, image principale, barre de recherche)
├── catalogue.php          # Catalogue de cartes avec filtres tags/style/univers
├── decks.php              # Page de gestion des decks (ébauche)
├── profile.php            # Page profil utilisateur (ébauche)
├── contact.php            # Formulaire de contact
├── readme.md              # Documentation projet (source de vérité)
├── MCD-Mermaid            # Modèle conceptuel de données (diagramme Mermaid)
├── component/
│   ├── head.php           # <head>, logo, nav (desktop + mobile), CSS dynamiques
│   └── foot.php           # Footer avec date dynamique
├── database/
│   └── database.php       # Connexion PDO à MySQL (base 'tgc_card_art')
├── styles/css/
│   ├── common.css         # Styles partagés
│   ├── typo.css           # Typographie
│   ├── fonts.css          # @font-face
│   ├── colors.css         # Variables de couleurs
│   └── {home,catalogue,decks,profile,contact,item}.css
└── assets/
    ├── fonts/             # Webfonts
    ├── img/               # Illustrations (chocobo.png, etc.)
    └── readme/            # Images utilisées dans le README (sitemap, etc.)
```

### Routage et inclusion dynamique

`index.php` lit le paramètre d'URL `?categorie=` (ou `?item=`) et inclut dynamiquement le fichier PHP correspondant dans un conteneur `<main>`. Les fichiers `head.php` et `foot.php` encadrent ce contenu :

```php
include './component/head.php';
include './database/database.php';
// ... <main> include $page . '.php'; </main>
include './component/foot.php';
```

### CSS dynamique par page

`head.php` charge les feuilles communes (`common`, `typo`, `fonts`, `colors`) puis la feuille propre à la page courante via la variable `$page`, ce qui évite de charger le CSS inutile :

```php
<link rel="stylesheet" href="$css_dir/$page.css">
```

### Modèle de données (MCD)

Le modèle conceptuel est versionné sous forme de diagramme **Mermaid** (`MCD-Mermaid`). Il organise les entités suivantes :

- **OPERATOR** — utilisateur de la plateforme
- **CARD** (ITEM) — carte, entité centrale
- **DECKS** (COLLECTION) — collection personnelle
- **Tag**, **Univers** (catégorie), **Style** (thème), **Couleur** — dimensions de classification visuelle
- **MESSAGE** — messages envoyés via le formulaire de contact

Les associations modélisent la possession d'un deck par un opérateur, la présence de cartes dans un deck (N-N), le rattachement d'une carte à un univers et un style (1-N), le tag libre (N-N) et la classification par couleur (1-N).

### Base de données

La connexion s'effectue via **PDO** dans `database/database.php` sur la base `tgc_card_art` (hôte local). Mode `ERRMODE_EXCEPTION`, fetch associatif, préparations réelles.

> ⚠️ **Remarque sécurité** : les identifiants MySQL sont actuellement en clair dans `database/database.php`. À déplacer dans des variables d'environnement (ou un fichier `.env` ignoré par git) avant toute mise en production.

### Design

Les maquettes sont réalisées sur Figma : [lien du design](https://www.figma.com/design/1zia3Zs5JW4G8AM0aOeb84/TCG-Art?node-id=0-1&p=f&t=JGABsouWHAjjI3N8-0). Le sitemap est inclus dans `assets/readme/sitemap.png`.

---

## 3. Roadmap et état d'avancement

### Fait

- Cadrage produit complet : vision, personas, analyse concurrentielle qualitative et quantitative.
- Sitemap et maquettes Figma.
- Modèle conceptuel de données (Mermaid) avec toutes les entités et cardinalités.
- Squelette PHP du site : routeur `index.php`, inclusions `head`/`foot`, pages créées pour les 5 sections (home, catalogue, decks, profile, contact).
- Navigation principale (desktop et mobile) avec icônes SVG intégrées.
- Organisation CSS modulaire : fichiers communs + fichier par page chargé dynamiquement.
- Système typographique et palette de couleurs (`typo.css`, `fonts.css`, `colors.css`).
- Page d'accueil : titre, illustration principale (chocobo), barre de recherche.
- Première ébauche HTML de la page catalogue (filtres tags/style/univers, grille de cartes).
- Formulaire de contact fonctionnel côté front.
- Connexion PDO à la base MySQL en place.

### En cours

- Mise en forme de la page catalogue (dernier commit en date, 10 avril 2026).
- Styles responsive de la page d'accueil (barre de recherche notamment).

### À venir

- Contenu réel des pages **decks** et **profile** (actuellement réduites à un `<h1>`).
- Intégration des données dynamiques depuis la base MySQL (requêtes PDO, pagination).
- Fonctionnement de la barre de recherche et des filtres (tags, style, univers, couleur).
- Gestion utilisateur : authentification, création/édition de decks, possession de cartes.
- Traitement côté serveur du formulaire de contact (table `MESSAGE` du MCD).
- Peuplement de la base avec des cartes de plusieurs TCG et leurs métadonnées visuelles.
- Sécurisation des identifiants de base de données (variables d'environnement).
- Optimisations perf. et accessibilité (objectif : dépasser les scores Lighthouse des concurrents).

### Historique récent (5 derniers commits)

| Date | Commit | Auteur | Sujet |
| --- | --- | --- | --- |
| 2026-04-10 | `6b050f3` | KandaPilouf | first draft html catalogue |
| — | `536a020` | KandaPilouf | removed homepage css added figure and figcaption for home page img |
| — | `d9ef77f` | KandaPilouf | added database file + started styling searchbar in homepage |
| — | `d153a02` | KandaPilouf | deleted stylesheet.php, made `$page` available for dynamic css |
| — | `bc06d70` | KandaPilouf | added searchbar in home html |

---

_Ce document est régénéré automatiquement chaque jour par une tâche planifiée qui interroge le repo GitHub. Si tu souhaites changer la fréquence, le contenu ou le format, il suffit de me le demander._
