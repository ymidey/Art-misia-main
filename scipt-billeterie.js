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
    let currentDate = new Date();
    let selectedDateValue = ''; // Pour stocker la date sélectionnée sous forme de chaîne
    const today = new Date(); // Date d'aujourd'hui pour la comparaison

    const renderCalendar = () => {
        daysContainer.innerHTML = '';
        let date = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

        const monthYearText = date.toLocaleString('default', { month: 'long' }) + ' ' + date.getFullYear();
        monthYearDisplay.textContent = monthYearText;

        prevMonthButton.disabled = currentDate.getMonth() === new Date().getMonth() && currentDate.getFullYear() === new Date().getFullYear();

        daysHeaderContainer.innerHTML = '';
        const daysOfWeek = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        daysOfWeek.forEach(day => {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = day;
            daysHeaderContainer.appendChild(dayDiv);
        });

        const firstDayIndex = date.getDay() === 0 ? 6 : date.getDay() - 1;
        for (let i = 0; i < firstDayIndex; i++) {
            const blank = document.createElement('div');
            blank.classList.add('blank');
            daysContainer.appendChild(blank);
        }

        while (date.getMonth() === currentDate.getMonth()) {
            const dayElem = document.createElement('div');
            dayElem.className = 'day';

            const dayNumber = document.createElement('p'); // Création d'un <p> pour le numéro du jour
            dayNumber.textContent = date.getDate();
            dayElem.appendChild(dayNumber); // Ajout du <p> à la div du jour

            const formattedDate = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
            if (date < today) {
                dayElem.classList.add('day-past');
            } else if (formattedDate === selectedDateValue) {
                dayElem.classList.add('selected');
            } else {
                dayElem.addEventListener('click', () => {
                    if (selectedDateValue === formattedDate) return;

                    const previouslySelected = document.querySelector('.days .selected');
                    if (previouslySelected) {
                        previouslySelected.classList.remove('selected');
                    }
                    dayElem.classList.add('selected');
                    selectedDateValue = formattedDate;
                    document.getElementById('selected_date').value = selectedDateValue;
                });
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

