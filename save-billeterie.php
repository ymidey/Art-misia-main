<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>billeterie</title>
    <link rel="stylesheet" href="src/styles/nav.css">
    <link rel="stylesheet" href="src/styles/root.css">
    <link rel="stylesheet" href="src/styles/billeterie.css">
</head>

<body>
    <?php include("header.php") ?>
    <main>
        <div class="div-left">
            <div class="left-head">
                <h1>Acheter un billet</h1>
                <?php if (isset($_GET['etape']) && ($_GET['etape'] == 2)) {
                    include("billeterie-part2.php");
                } elseif (isset($_GET['etape']) && ($_GET['etape'] == 3)) {
                    include("billeterie-part3.php");
                } else {
                    include("billeterie-part1.php");
                } ?>
            </div>
            <div class="div-right">
                <h2>Récapitulatifs de votre commande</h2>
                <div class="recapitulatif-content">
                    <img src="./src/assets/imgs/affiche.png" alt="affiche de l'exposition" srcset="">
                    <div class="recapitulatif-text">
                        <h3>Artemisia Gentileschi</h3>
                        <h4>Toiles d'une vie résiliente</h4>
                        <?php if (isset($_GET['selected_date']) && isset($_GET['horaire'])) {
                            // Récupération de la date sélectionnée et de l'horaire depuis les paramètres GET
                            $selectedDate = $_GET['selected_date'];
                            $horaire = $_GET['horaire'];

                            // Convertir la date en format jour/mois/année
                            $dateFormatee = date("d/m/Y", strtotime($selectedDate));

                            // Afficher la date inversée avec l'horaire
                            echo "<p>Billets datés pour le : <span class='bold'>" . $dateFormatee . "</span> à <span class='bold'>" . $horaire . "</span></p>";
                        } ?>
                        <p>Méthode d'obtention : <span class="bold">e-tickets</span></p>
                    </div>
                </div>
    </main>
</body>

</html>