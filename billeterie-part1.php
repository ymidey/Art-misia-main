<div class="bread-crumb">
    <a href="billeterie.php?etape=1" <?php if ($_GET["etape"] >= 1) echo 'class="link-active"'; ?>>Date et horaire</a>
    <p>></p>
    <a href="billeterie.php?etape=2" <?php if ($_GET["etape"] >= 2) echo 'class="link-active"'; ?>>Choix des billets</a>
    <p>></p>
    <a href="billeterie.php?etape=3" <?php if ($_GET["etape"] >= 3) echo 'class="link-active"'; ?>>Payements</a>
</div>
</div>

<form action="billeterie.php" id="form-horaire" method="get">
    <div class="div-date">
        <label for="date">
            Choisir une date de visite <span class="required">*</span>
        </label>

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

    <div class="div-horaire hidden">
        <label for="horraire">Choisissez un horaire <span class="required">*</span>
        </label>
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
        <input type="text" name="etape" id="etape" value="2" hidden>
        <button type="submit">Valider</button>
    </div>

</form>

<script>
    function changeBackgroundColor(id) {
        var labels = document.querySelectorAll('.div-horaire label');
        labels.forEach(function(label) {
            label.classList.remove('selected');
        });
        var selectedLabel = document.querySelector('label[for="' + id + '"]');
        selectedLabel.classList.add('selected');
    }



    document.addEventListener('DOMContentLoaded', function() {
        const monthYearDisplay = document.querySelector('.month-year');
        const prevMonthButton = document.querySelector('.prev-month');
        const nextMonthButton = document.querySelector('.next-month');
        const daysContainer = document.querySelector('.days');
        const daysHeaderContainer = document.querySelector('.days-header');
        const horaireSection = document.querySelector('.div-horaire'); // Sélection de la section des horaires
        let currentDate = new Date();
        let selectedDate; // Garder une trace de la date sélectionnée
        const today = new Date(); // Date d'aujourd'hui pour la comparaison

        const renderCalendar = () => {
            daysContainer.innerHTML = '';
            let date = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

            const monthYearText = date.toLocaleString('default', {
                month: 'long'
            }) + ' ' + date.getFullYear();
            monthYearDisplay.textContent = monthYearText;

            prevMonthButton.disabled = currentDate.getMonth() === today.getMonth() && currentDate
                .getFullYear() === today.getFullYear();

            daysHeaderContainer.innerHTML = ''; // Clear avant d'ajouter
            const daysOfWeek = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
            daysOfWeek.forEach(day => {
                const dayDiv = document.createElement('p'); // Remplacement div par p
                dayDiv.textContent = day;
                daysHeaderContainer.appendChild(dayDiv);
            });

            const firstDayIndex = (date.getDay() === 0 ? 6 : date.getDay() - 1);
            for (let i = 0; i < firstDayIndex; i++) {
                const blank = document.createElement('p'); // Remplacement div par p
                blank.classList.add('blank');
                daysContainer.appendChild(blank);
            }

            while (date.getMonth() === currentDate.getMonth()) {
                const dayElem = document.createElement('p'); // Remplacement div par p
                dayElem.textContent = date.getDate();

                dayElem.addEventListener('click', (function(d) {
                    return function() {
                        if (selectedDate) {
                            selectedDate.classList.remove('selected');
                        }
                        dayElem.classList.add('selected');
                        selectedDate = dayElem;

                        // Obtenez la date complète
                        const selectedDateValue = new Date(date.getFullYear(), date.getMonth(), dayElem.textContent);

                        // Formatez la date en format YYYY-MM-DD (format de date HTML5)
                        const formattedDate = selectedDateValue.toISOString().split('T')[0];

                        // Mettre à jour la valeur du champ caché avec la date sélectionnée
                        document.getElementById('selected_date').value = formattedDate;

                        // Afficher la section des horaires lorsque l'utilisateur sélectionne une date
                        horaireSection.classList.remove('hidden');
                    }
                })(new Date(date)));

                if (date < today) {
                    dayElem.classList.add('day-past');
                } else {
                    dayElem.classList.add('day');
                    dayElem.addEventListener('click', (function(d) {
                        return function() {
                            if (selectedDate) {
                                selectedDate.classList.remove('selected');
                            }
                            dayElem.classList.add('selected');
                            selectedDate = dayElem;

                            // Afficher la section des horaires lorsque l'utilisateur sélectionne une date
                            horaireSection.classList.remove('hidden');
                        }
                    })(new Date(date)));
                }

                daysContainer.appendChild(dayElem);
                date.setDate(date.getDate() + 1);
            }
        };

        prevMonthButton.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthButton.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    });
</script>