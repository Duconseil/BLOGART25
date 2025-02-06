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
            top: 15px;
            right: 170px;
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
                <h1>Michel Corajoud, l’artisan de vos balades à Bordeaux.</h1>
                <div class="article-chapo">
                    <h2>
                        À partir des années 2000, le paysagiste Michel Corajoud a redonné un nouveau souffle aux balades bordelaises en réinventant les quais de la ville.
                    </h2>
                    <h3>
                        Démolitions, réhabilitations, constructions. Découvrez l’impact de ces changements sur le quotidien de nos aînés.
                    </h3>
                </div>
                <span class="meta">
                    Posté par <a href="#!">Rétroscope</a>, le 5 février 2025
                </span>
            </div>
        </div>
    </header>

    <!-- Contenu de l'article -->
    <article class="container">

    <div class="image-wrapper">
        <img src="\src\images\Photo1.jpg" alt="Image principale de l'article" class="article-image">
        <img src="\src\images\Logo2.png" alt="Logo Rétroscope" class="logo-overlay">
    </div>

        <p class="text-muted text-center">Les quais aujourd’hui, un lieu de rencontre et de promenade.</p>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 article-content">

                <p>À vous, nos aînés, je dédie ces mots, revivez avec nous les transformations des quais de Bordeaux, en passant de la première destruction d’un hangar jusqu’à votre dernière balade aux miroirs d’eau.</p>

                <h2>Les quais de Bordeaux : un espace laissé pour compte</h2>
                <p>Revivez Bordeaux avant les années 2000, avant les grands changements d’aujourd’hui. La ville industrielle, son port en déclin, l’activité commerciale déplacée vers Bassens et Le Verdon. Les quais abandonnés, envahis de hangars et de parkings, loin d’être accueillants. Le centre ville tournait le dos au fleuve, pollué et oublié, rendant toute activité nautique ou de loisirs quasi inexistante.</p>

                <p>Pendant 45 ans, Jacques Chaban-Delmas a stabilisé Bordeaux sans amorcer de véritable transformation. En 1995, Alain Juppé a donné un second souffle à notre ville, en proposant un ‘concours’ pour un projet de réaménagement, à plusieurs architectes. Une poignée d’entre eux présentent leurs projets de réhabilitation des quais durant le premier mandat d’Alain Juppé pour renouer ce lien perdu avec la Garonne.</p>

                <p>Un projet visant à réhabiliter les quais est sélectionné celui de Michel CORAJOUD. Quai Sainte-Croix - Parc Saint-Michel, un parc paysager en bord de Garonne. Quai de la Douane - Place de la Bourse, un lieu de culture et de commerce. Quais Louis XVIII - Prairie des Girondins, prolongement des Quinconces jusqu’au fleuve. Quai des Chartrons, renouveau du hangar 14 et des promenades. Quai de Bacalan pour la dynamisation du quartier.</p>

                <h2>Les travaux de CORAJOUD : Une métamorphose sans précédent</h2>
                <p>Vous avez toujours rêvé d’un Bordeaux paisible, chaleureux et accueillant. C’est un rêve que vous avez sûrement partagé avec Michel CORAJOUD. Son but étant de remodeler votre vision des quais afin d’allier naturel et minéral dans les décors urbains qu’il conçoit. Au-delà de ça, il souhaite vous faire redécouvrir Bordeaux sous un nouveau regard, avec de nouveaux matériaux, il veut aussi “réinterpréter” la lumière et partager l’espace laissé à l’abandon.</p>

                <blockquote class="blockquote">
                    « Faire du paysage, c'est faire du bien aux gens. » – Michel Corajoud
                </blockquote>

                <p>Vos quais, éternel représentant de Bordeaux. Ils les réorganisent, la démolition du hangar 7 durant l’année 2000 marque le début du renouveau mais sans renier l’origine des quais du XVIIIe siècle. Le parvis est redessiné, structuré entre trottoirs, stationnements et tramway (révolution majeure du moment). Plus loin, le boulevard s’étire avec ses chaussées et son terre-plein planté. Ils choisissent des matériaux solides, faits pour durer. Les pavés de céramique posés sous vos pieds, le granit dans les contre-allées, et le grès ocre-brun délimitent les stationnements. Tout se transforme sous vos yeux.</p>

                <p>Les quais ne s'ouvrent plus qu'aux voitures mais aussi aux piétons, cyclistes et tramway. Ici, chacun trouve sa place. On ne détruit pas, on ajuste. Les façades restent, mais le sol lui évolue.  On ajoute pavés, granit, grès : des choix durables. Le tramway s’intègre, les quais changent devant vos yeux en disant aussi adieu à certains hangars.
                Ce projet est né avec la ville, pour la ville. Suivant un besoin d’un renouveau. Cher Bordelais, urbanistes et élus construisons ensemble vos balades de demain et de toujours.</p>

                <h2>L’héritage des quais : Une ville plus accessible pour nos aînés</h2>
                <p>Regardez comme ils transforment vos quais, comme pour vous, ici, le temps est passé. Tout est fait pour que maintenant chacun puisse déambuler sans contrainte. Les trottoirs sont élargis, les passages sont dégagés, les bancs sont placés stratégiquement, offrant des haltes bien pensées. Plus besoin de contourner des obstacles ou de surveiller chaque pas, la balade est fluide.</p>

                <blockquote class="blockquote">
                    « Il faut toujours penser un paysage comme une histoire que l’on raconte à ceux qui le traversent. » – Michel Corajoud
                </blockquote>

                <p>De nouveaux espaces ludiques, permettant aux petits et grands de s’amuser sur des zones dédiées : parc pour enfant, ou skatepark par exemple. Des agrès sportifs ont été installés, encourageant l’activité physique. Une attractivité touristique émerge, permettant à Bordeaux une plus grande reconnaissance internationale. Le miroir d’eau notamment est devenu un des lieux emblématiques de la ville.</p>

                <p>Les quais ne sont plus un simple lieu de passage, ils deviennent un espace de vie coloré et animé. Des espaces verts ponctuent vos balades au fil de l’eau, plus d’arbres, plus d’ombre. Le bitume cohabite avec la fraîcheur de l’herbe, rendant l’atmosphère plus pure, moins polluée. Chaque mètre parcouru invite à la contemplation. Bordeaux pour VOUS.</p>

                <p>Car oui, ils ont pensé à vous. Tout est accessible, pour que chacun puisse profiter de la balade, quel que soit l’âge ou la mobilité. On marche, on roule, on s’arrête, on prend le temps, on reprend son souffle en admirant le fleuve, qui comme vous, à assister aux changements de ces quais. Bordeaux, c’est une ville qui s’adapte à ses habitants, pas l’inverse.</p>
                <p>

                <p>Bordeaux, votre ville, notre ville. Les années sont passées, les pavés ont été foulés. L’héritage laissé par CORAJOUD et les techniciens du projet ont modifié pour un grand nombre de générations, l’horizon bordelais. La mobilité et l’écologie ont été des thématiques fortes qui, pour vous cher bordelais, ont transformé votre quotidien et vos balades en famille. Bordeaux s’est imposé comme un leader du territoire français, un spot touristique majeur. Les quais ne sont plus qu’un décor industriel et fade, ils deviennent un lieu de vie à part entière.</p>

                    <small>Sources : <a href="http://localhost">Rétroscope.</a> - Images : <a href="https://www.flickr.com/photos/nasacommons/">Nicolas CHAIX</a></small>
                </p>
            </div>
        </div>
    </article>

    <!-- Pied de page -->
    <footer class="border-top">
        <div class="container text-center">
            <p class="small text-muted">Copyright &copy; Rétroscope. 2025</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>