<div class="bread-crumb">
    <a href="billeterie.php?etape=1" <?php if ($_GET["etape"] >= 1) echo 'class="link-active"'; ?>>Date et horaire</a>
    <p>></p>
    <a href="billeterie.php?etape=2" <?php if ($_GET["etape"] >= 2) echo 'class="link-active"'; ?>>Choix des billets</a>
    <p>></p>
    <a href="billeterie.php?etape=3" <?php if ($_GET["etape"] >= 3) echo 'class="link-active"'; ?>>Payements</a>
</div>
<?php
// Récupération de la date sélectionnée et de l'horaire depuis les paramètres GET
$selectedDate = $_GET['selected_date'];
$horaire = $_GET['horaire'];

// Convertir la date en format jour/mois/année
$dateFormatee = date("d/m/Y", strtotime($selectedDate));

// Afficher la date inversée avec l'horaire
echo "<p>Billets datés pour le : <span class='bold'>" . $dateFormatee . "</span> à <span class='bold'>" . $horaire . "</span></p>";
?>

</div>

<form action="billeterie.php" id="form-billet" method="get">
    <p>Choix des billets (jusqu'à 10 visiteurs) :</p>
    <div class="div-billet">
        <div class="div-billet-type">
            <div>
                <label for="billet-pleintarif">Plein tarif</label>
                <input type="number" name="billet-pleintarif" id="billet-pleintarif" min="0" value="0" data-price="9">
                <p>9€</p>
            </div>
            <div>
                <label for="billet-reduit">Visiteur en situation d'handicape</label>
                <input type="number" name="billet-reduit" id="billet-reduit" min="0" value="0" data-price="7">
                <p>7€</p>
            </div>
            <div>
                <label for="billet-gratuit">Visiteur de moins de 25 ans</label>
                <input type="number" name="billet-gratuit" id="billet-gratuit" min="0" value="0" data-price="0">
                <p>0€</p>
            </div>

        </div>
        <div class="div-billet-total">
            <p>Total : <span id="total">0</span>€</p>
            <input type="text" name="etape" id="etape" value="3" hidden>
            <button type="submit">Valider</button>
        </div>
    </div>
</form>

<script>
    // Récupération des inputs
    const inputs = document.querySelectorAll('input[type="number"]');
    const total = document.getElementById('total');

    // Ajout d'un écouteur d'événement sur chaque input
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            // Initialisation du total
            let totalValue = 0;

            // Calcul du total
            inputs.forEach(input => {
                totalValue += input.value * input.getAttribute('data-price');
            });

            // Affichage du total
            total.textContent = totalValue + '€';
        });

    });