<?php  
require_once '../../header.php';
sql_connect();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Article sur Michel Corajoud">
    <title>Michel Corajoud - Rétroscope</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- Font Awesome & Google Fonts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Bootstrap & Styles -->
    <link href="/blogart25/styles.css" rel="stylesheet">

    <style>

        /* Espacement et mise en page améliorés */
        .article-header {
            margin-top: 20px;
            text-align: center;
            margin-bottom: 40px;
        }

        .article-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .article-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .article-content h2 {
            margin-top: 40px;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
            border-left: 6px solid #444;
            padding-left: 10px;
        }

        .blockquote {
            font-style: italic;
            border-left: 4px solid #888;
            padding-left: 15px;
            margin: 30px 0;
            color: #555;
        }

        .article-chapo {
            font-family: 'Open Sans', serif;
            font-size: 1.2rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 800px;
            margin: 10px auto;
            text-align: justify;
        }

        .article-chapo h2 {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .article-chapo h3 {
            font-size: 1.2rem;
            font-weight: normal;
            font-style: italic;
            color: #555;
        }

                /* Titre principal - Élégant et impactant */
        .article-header h1 {
            font-family: 'Open Sans', serif;
            font-size: 2.2rem;
            font-weight: bold;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        /* Harmonisation du Chapô */
        .article-chapo {
            font-family: 'Open Sans', sans-serif; /* Uniformisation avec le contenu */
            font-size: 1.2rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 800px;
            margin: 20px auto 30px auto;
            text-align: justify;
        }

        /* Sous-titre du Chapô - Plus moderne */
        .article-chapo h2 {
            font-family: 'Open Sans', sans-serif; /* Cohérent avec l'article */
            font-size: 1.4rem;
            font-weight: 600; /* Semi-gras pour une meilleure visibilité */
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        /* Petit sous-titre du Chapô - Italique et adouci */
        .article-chapo h3 {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.2rem;
            font-weight: 400;
            font-style: italic;
            color: #555;
            margin-bottom: 30px;
        }

        /* Métadonnées - Cohérence visuelle */
        .meta {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9rem;
            color: #777;
            display: block;
            margin-top: 20px;
        }

        .image-wrapper {
            position: relative;
            display: flex;
            justify-content: center; /* Centre l'image horizontalement */
            align-items: center;
            width: 100%;
        }

        .article-image {
            width: 100%;
            max-width: 800px; /* Garde une taille raisonnable */
            height: auto;
            display: block;
            border-radius: 5px;
        }

        .logo-overlay {
            position: absolute;
            top: 20px;
            right: 275px;
            width: 70px; /* Taille ajustable */
            height: auto;
            opacity: 0.9; /* Légère transparence */
        }

    </style>

</head>

<body>

    <!-- En-tête de l'article avec image -->
    <header class="masthead">
        <div class="container">
            <div class="article-header">
                <h1>Hélène et Lucien, L’Amour de Bordeaux.</h1>
                <div class="article-chapo">
                    <h2>
                        Bordeaux, à travers le temps et les changements. Ce témoignage de Hélène et Lucien mêle souvenirs nostalgiques et vision sur la ville d’aujourd’hui. 
                    </h2>
                    <h3>
                        À vous, nos enfants, nous dédions ces mots, revivez avec nous le récit de l’évolution de Bordeaux ainsi que de ses quais.
                    </h3>
                </div>
                <span class="meta">
                    Posté par <a href="#!">Rétroscope</a>, le 6 février 2025
                </span>
            </div>
        </div>
    </header>

    <!-- Contenu de l'article -->
    <article class="container">
        
    <div class="image-wrapper">
        <img src="\src\images\Photo2.jpg" alt="Image principale de l'article" class="article-image">
        <img src="\src\images\Logo2.png" alt="Logo Rétroscope" class="logo-overlay">
    </div>

        <p class="text-muted text-center">Hélène et Lucien, une balade sur les quais de Bordeaux.</p>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 article-content">

                <p>À vous, nos enfants, nous dédions ces mots, revivez avec nous le récit de l’évolution de Bordeaux ainsi que de ses quais.</p>

                <h2>Un passé dépassé passé au peigne fin.</h2>
                <p>Imaginez-vous, dans les années 1960. On a connu les quais, c’était un port autonome. Des bateaux arrivaient en permanence, il y avait un trafic très important. Les navires accostaient directement à la place des Quinconces. En 1968, j’avais fait un stage dans une entreprise maritime, ‘Delmas Desjeu’, qui importait du chocolat du monde entier. Les bateaux déchargent leur cargaison aux hangars 18, juste à côté des Quinconces.</p>

                <p>Avant, les quais, c’était le cœur battant de la ville. Il y avait du monde partout : des dockers, des négociants en vin, des ouvriers… Ça n’arrêtait jamais ! Les grues tournaient, les bateaux et les wagons allaient et venaient, et des travailleurs arrivaient de partout. On y trouvait du sucre, de l’alcool, du bois, des aliments… C’était bruyant, animé, ça sentait le commerce et l’effort.</p>

                <p>C’était un espace fermé au public, avec un grand mur qui longeait le port. Ce mur servait à sécuriser les marchandises précieuses qui transitaient par le port, comme le sucre, le vin ou le chocolat, et à réguler le passage des travailleurs. De l’extérieur, les habitants entendaient les bruits des grues, le cliquetis des wagons et les sirènes des bateaux, mais ils ne pouvaient pas s’y aventurer librement. Les seuls autorisés étaient les dockers et les négociants, qui devaient montrer des papiers pour entrer. Derrière ce mur, une véritable fourmilière s’activait nuit et jour, au rythme du commerce et des marées.</p>

                <h2>Les quais, la zone oubliée.</h2>
                <p>Autrefois, les quais de Bordeaux étaient un centre vital du commerce maritime, avec des navires accostant en ville pour décharger des marchandises comme le sucre ou le chocolat. Mais avec le temps, l’activité portuaire a décliné et a été déplacée vers Bassens, plus adapté aux grands trafics. Ce transfert a marqué la fin du rôle économique des quais, qui se sont vidés avant d’être transformés. Aujourd’hui, les anciens hangars ont laissé place à des commerces et des espaces touristiques, effaçant l’effervescence portuaire d’autrefois.</p>

                <p>Avec le temps, le port a été abandonné, et les quais ont changé. Les entrepôts laissés vides et les infrastructures délaissées ont peu à peu attiré des squatteurs, transformant la zone en un espace désaffecté et dangereux. Il faut dire qu’ils étaient squattés, qu’il y avait du trafic de drogue et des règlements de comptes, rendant l’endroit peu fréquentable. À la tombée de la nuit, l’ambiance devenait encore plus inquiétante, et rares étaient ceux qui osaient s’y aventurer. Loin de l’animation portuaire d’autrefois, les quais étaient devenus un symbole d’abandon et d’insécurité.</p>

                <p>Les quais, une fois désertés, sont rapidement devenus un endroit peu fréquentable. Entre squats, trafics et règlements de comptes, l’insécurité s’y est installée. La nuit, l’ambiance y était pesante, avec des recoins sombres et une absence totale de vie urbaine. Beaucoup préféraient les éviter, de peur des mauvaises rencontres ou des incidents.</p>

                <h2>Un nouveau Bordeaux.</h2>
                <p>L'arrivée d’Alain Juppé en tant que maire de la ville a fait énormément de changements pour Bordeaux. Avant lui, il y avait Chaban-Delmas, mais c’était une autre époque. Juppé a tout refait : il a donné un second souffle à la ville avec le tram, la rénovation des quais et la restauration des façades. Il a aussi transformé l’ambiance de Bordeaux. Avant, on l’appelait ‘la belle endormie’ : les jeunes ne sortaient pas autant qu’à Toulouse, Béziers ou Montpellier. Mais avec tous ces changements, Bordeaux s’anime désormais la nuit, notamment à la Victoire, à Saint-Pierre et sur les quais. La ville s’est réveillée. 
                </p>
                
                <blockquote class="blockquote">
                    « La conscience du problème du vieillissement s'accentue à chacun de mes anniversaires » – Alain Juppé
                </blockquote>

                <p>Maintenant que tout a été réhabilité, ça ne nous a pas changé grand-chose. On y va de temps en temps pour se balader, mais c’est devenu très touristique. Il faut reconnaître que c’est joli, tout a été refait, il n’y a pas photo, c’est quand même mieux qu’avant. Mais bon, on n’y va pas tous les quatre matins. Et puis, entre les magasins qui nous plaisent pas et le manque d’envie… ça joue aussi !</p>

                <p>Les trottinettes… elles nous cassent les bonbons ! On ne peut plus marcher tranquillement, bientôt, il faudra sortir avec un casque ! Ça va vite et ça fait peur. C’est pratique pour les jeunes, mais seulement si on ne fait pas n’importe quoi et qu’on respecte les autres. Le problème, c’est que les marquages ne sont pas bien délimités… et de toute façon, ils ne sont pas respectés. D'abord, la nuit, on ne sort plus. Avec tout ce qui s'est passé, les jeunes retrouvés dans la Garonne et l’insécurité qui a évolué, c’est devenu plus difficile. En plus, depuis le Covid, avant on allait au théâtre et au cinéma, mais maintenant, on n’y va plus et ça nous est resté.</p>

                <p> En dépit des changements, des évolutions et des défis que Bordeaux a traversés, on ne peut qu’aimer cette ville. Bordeaux reste un lieu agréable où il fait bon vivre, avec ses beaux quartiers rénovés, ses quais réhabilités et une ambiance qui se modernise tout en conservant son charme. Les souvenirs de son passé et les transformations récentes font de la ville un lieu unique où l’on se sent chez soi. Malgré les petites frustrations, Bordeaux conserve un véritable attrait et reste une ville où l’on aime se retrouver</p>
                <p>

                    <small>Sources : <a href="http://localhost">Rétroscope.</a> - Images : <a href="https://www.flickr.com/photos/nasacommons/">Nicolas CHAIX</a></small>
                </p>
            </div>
        </div>
    </article>

    <footer class="border-top">
        <div class="container text-center">
            <p class="small text-muted">Copyright &copy; Rétroscope. 2025</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>