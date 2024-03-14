function changeBackgroundColor(id) {
    var labels = document.querySelectorAll('.div-horaire label');
    labels.forEach(function (label) {
        label.classList.remove('selected');
    });
    var selectedLabel = document.querySelector('label[for="' + id + '"]');
    selectedLabel.classList.add('selected');
}

document.addEventListener('DOMContentLoaded', function () {
    const monthYearDisplay = document.querySelector('.month-year');
    const prevMonthButton = document.querySelector('.prev-month');
    const nextMonthButton = document.querySelector('.next-month');
    const daysContainer = document.querySelector('.days');
    const daysHeaderContainer = document.querySelector('.days-header');
    const horaireSection = document.querySelector(
        '.div-horaire'); // Sélection de la section des horaires
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

        prevMonthButton.disabled = currentDate.getMonth() === today.getMonth() &&
            currentDate
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

            dayElem.addEventListener('click', (function (d) {
                return function () {
                    if (selectedDate) {
                        selectedDate.classList.remove('selected');
                    }
                    dayElem.classList.add('selected');
                    selectedDate = dayElem;

                    // Obtenez la date complète
                    const selectedDateValue = new Date(date.getFullYear(),
                        date
                            .getMonth(), dayElem.textContent);

                    // Formatez la date en format YYYY-MM-DD (format de date HTML5)
                    const formattedDate = selectedDateValue.toISOString()
                        .split(
                            'T')[0];

                    // Mettre à jour la valeur du champ caché avec la date sélectionnée
                    document.getElementById('selected_date').value =
                        formattedDate;

                    // Afficher la section des horaires lorsque l'utilisateur sélectionne une date
                    horaireSection.classList.remove('hidden');
                }
            })(new Date(date)));

            if (date < today) {
                dayElem.classList.add('day-past');
            } else {
                dayElem.classList.add('day');
                dayElem.addEventListener('click', (function (d) {
                    return function () {
                        if (selectedDate) {
                            selectedDate.classList.remove('selected');
                        }
                        dayElem.classList.add('selected');
                        selectedDate = dayElem;
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
        total.textContent = totalValue;
    });

});