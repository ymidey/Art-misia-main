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
        <h1>Acheter un billet</h1>
        <div class="main-content">
            <div class="div-top">
                <div class="div-left">

                    <form action="billeterie.php" id="form-horaire" method="get">
                        <div class="div-date">
                            <div class="date-header">
                                <h2>
                                    Choisir une date de visite
                                </h2>
                                <span class="line-date"></span>
                            </div>

                            <div class="custom-datepicker">
                                <div class="month-picker">
                                    <button class="prev-month" type="button">&#8592;</button>
                                    <span class="month-year"></span>
                                    <button class="next-month" type="button">&#8594;</button>
                                </div>
                                <div class="days-header"></div>
                                <div class="days"></div>
                            </div>
                            <input type="hidden" name="selected_date" id="selected_date">

                        </div>

                        <div class="div-horaire">
                            <h2> Choisissez un horaire</h2>
                            <div class="div-horaire-input">
                                <input type="radio" name="horaire" id="horaite-10" value="10:00" onchange="changeBackgroundColor('horaite-10')">
                                <label for="horaite-10">10h00</label>
                                <input type="radio" name="horaire" id="horaite-11" value="11:00" onchange="changeBackgroundColor('horaite-11')">
                                <label for="horaite-11">11h00</label>
                                <input type="radio" name="horaire" id="horaite-12" value="12:00" onchange="changeBackgroundColor('horaite-12')">
                                <label for="horaite-12">12h00</label>
                                <input type="radio" name="horaire" id="horaite-13" value="13:00" onchange="changeBackgroundColor('horaite-13')">
                                <label for="horaite-13">13h00</label>
                                <input type="radio" name="horaire" id="horaite-14" value="14:00" onchange="changeBackgroundColor('horaite-14')">
                                <label for="horaite-14">14h00</label>
                                <input type="radio" name="horaire" id="horaite-15" value="15:00" onchange="changeBackgroundColor('horaite-15')">
                                <label for="horaite-15">15h00</label>
                                <input type="radio" name="horaire" id="horaite-16" value="16:00" onchange="changeBackgroundColor('horaite-16')">
                                <label for="horaite-16">16h00</label>
                                <input type="radio" name="horaire" id="horaite-17" value="17:00" onchange="changeBackgroundColor('horaite-17')">
                                <label for="horaite-17">17h00</label>
                                <input type="radio" name="horaire" id="horaite-18" value="18:00" onchange="changeBackgroundColor('horaite-18')">
                                <label for="horaite-18">18h00</label>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="div-right">
                    <form action="billeterie.php" id="form-horaire" method="get">
                        <h2>Choix des billets (jusqu'à 10 visiteurs maximum) :</h2>
                        <div class="div-billet">
                            <div class="div-billet-type">
                                <div class="content">
                                    <label for="billet-pleintarif">Plein tarif</label>
                                    <div>
                                        <input type="number" name="billet-pleintarif" id="billet-pleintarif" min="0" value="0" data-price="9" onchange="verifyTicketLimit()">
                                        <p>9,00 €</p>
                                    </div>
                                </div>
                                <div class="content">
                                    <label for="billet-reduit">Visiteur en situation d'handicape
                                    </label>
                                    <div>
                                        <input type="number" name="billet-reduit" id="billet-reduit" min="0" value="0" data-price="7" onchange="verifyTicketLimit()">
                                        <p>7,00 €</p>
                                    </div>
                                </div>
                                <div class="content">
                                    <label for="billet-gratuit">Visiteur de moins de 25 ans
                                    </label>
                                    <div>
                                        <input type="number" name="billet-gratuit" id="billet-gratuit" min="0" value="0" data-price="0" onchange="verifyTicketLimit()">
                                        <p>0,00 €</p>
                                    </div>
                                </div>
                            </div>
                            <div class="div-billet-total">
                                <p>Total de la reservation : <span id="total">0</span>,00 €</p>
                                </p>
                            </div>
                            <button type="submit" id="valider-btn">Valider</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="div-bottom hidden" id="div-bottom">
                <div class="bottom-header">
                    <h2>Vos coordonées</h2>
                    <span class="line-date"></span>
                </div>
                <p>Les champs suivis d'un <span class="required">*</span> sont obligatoires.</p>
                <form id="reservationForm" action="https://artemisia.todoom.eu/API/index.php" method="post">
                    <div class="flex-row">
                        <div class="flex-column">
                            <label for="user_name">Nom<span class="required">*</span></label>
                            <input type="text" name="user_name" id="user_name" placeholder="Nom" required>
                        </div>
                        <div class="flex-column">
                            <label for="user_last_name">Prénom<span class="required">*</span></label>
                            <input type="text" name="user_last_name" placeholder="Prénom" id="user_last_name" required>
                        </div>
                    </div>
                    <div class="flex-column">
                        <label for="user_mail">Adresse mail<span class="required">*</span></label>
                        <input type="email" name="user_mail" id="user_mail" placeholder="adresse.mail@gmail.com" required>
                    </div>

                    <div class="flex-column">
                        <label for="ccn">Numéro de carte banquaire<span class="required">*</span></label>
                        <input id="ccn" type="tel" inputmode="numeric" pattern="\d{4}-\d{4}-\d{4}-\d{4}" autocomplete="cc-number" maxlength="19" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                    </div>

                    <div class="flex-row">
                        <div class="flex-column">
                            <label for="date">Date d'expiration<span class="required">*</span></label>
                            <input id="date" type="tel" inputmode="numeric" pattern="[0-9]{2}/[0-9]{2}" autocomplete="cc-exp" maxlength="5" placeholder="MM/YY" required>
                        </div>

                        <div class="flex-column">
                            <label for="cvv">Cryptogramme visuel<span class="required">*</span></label>
                            <input id="cvv" type="tel" inputmode="numeric" pattern="[0-9]{3}" autocomplete="cc-csc" maxlength="3" placeholder="XXX" required>
                        </div>
                    </div>

                    <button type="submit">Procéder au payement</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="./scipt-billeterie.js"></script>
<script>
    document.getElementById('valider-btn').addEventListener('click', function(event) {
        event.preventDefault();

        var selectedDate = document.getElementById('selected_date').value;
        if (selectedDate === '') {
            alert('Veuillez choisir une date de visite.');
            return;
        }

        var selectedTime = document.querySelector('input[name="horaire"]:checked');
        if (!selectedTime) {
            alert('Veuillez choisir un horaire.');
            return;
        }

        var tickets = document.querySelectorAll('input[name^="billet-"]');
        var ticketSelected = false;
        tickets.forEach(function(ticket) {
            if (parseInt(ticket.value) > 0) {
                ticketSelected = true;
            }
        });

        if (ticketSelected) {
            document.getElementById('div-bottom').style.display = 'block';
        } else {
            alert('Veuillez choisir au moins un billet avant de valider.');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const ccnInput = document.getElementById('ccn');
        ccnInput.addEventListener('input', function(e) {
            const formattedValue = formatCreditCardNumber(e.target.value);
            e.target.value = formattedValue;
        });

        const dateInput = document.getElementById('date');
        dateInput.addEventListener('input', function(e) {
            const formattedValue = formatExpiryDate(e.target.value);
            e.target.value = formattedValue;
        });
    });

    function formatCreditCardNumber(value) {
        // Supprime tous les caractères non numériques
        const numericValue = value.replace(/\D/g, '');
        // Ajoute un tiret après chaque groupe de 4 chiffres
        const formattedValue = numericValue.replace(/(\d{4})/g, '$1-');
        // Supprime le dernier tiret ajouté s'il en a un
        return formattedValue.replace(/-$/, '');
    }

    function formatExpiryDate(value) {
        // Supprime tous les caractères non numériques
        const numericValue = value.replace(/\D/g, '');
        // Ajoute un / après les 2 premiers chiffres
        const formattedValue = numericValue.replace(/^(\d{2})/, '$1/');
        // Supprime les caractères après les 5 premiers chiffres
        return formattedValue.slice(0, 5);
    }

    function verifyTicketLimit() {
        var totalTickets = 0;
        var inputs = document.querySelectorAll('input[type="number"][name^="billet-"]');

        inputs.forEach(function(input) {
            totalTickets += parseInt(input.value, 10) || 0;
        });

        if (totalTickets > 10) {
            // Réinitialiser le dernier input modifié ou ajuster la quantité pour respecter la limite
            // Cette partie peut être ajustée selon la logique que vous souhaitez implémenter
            inputs[inputs.length - 1].value = Math.max(0, 10 - (totalTickets - inputs[inputs.length - 1].value));
        }
    }

    // A voir si ça fonctionne 
    document.getElementById('reservationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche l'envoi classique du formulaire

        // Récupération de l'heure et du jour sélectionnés
        const selectedDate = document.getElementById('selected_date').value;
        const selectedTime = document.querySelector('input[name="horaire"]:checked').value;

        // Récupération des billets et de leur nombre
        const tickets = document.querySelectorAll('input[name^="billet-"]');
        let ticketsData = {};
        tickets.forEach(ticket => {
            // Utilise l'attribut name du billet comme clé et sa valeur (quantité) comme valeur
            ticketsData[ticket.name] = ticket.value;
        });

        // Création de l'objet de données à envoyer
        const formData = {
            date: selectedDate,
            time: selectedTime,
            tickets: ticketsData,
            user: {
                name: document.getElementById('user_name').value,
                lastName: document.getElementById('user_last_name').value,
                email: document.getElementById('user_mail').value,
                creditCard: {
                    number: document.getElementById('ccn').value.replace(/-/g,
                        ''), // enlève les tirets pour le numéro de carte
                    expiryDate: document.getElementById('date').value,
                    cvv: document.getElementById('cvv').value
                }
            }
        };

        // Envoi de la requête à l'API
        fetch('https://artemisia.todoom.eu/API/index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Traitez ici le succès (par exemple, affichez un message de confirmation)
            })
            .catch((error) => {
                console.error('Error:', error);
                // Traitez ici les erreurs (par exemple, affichez un message d'erreur)
            });
    });
</script>