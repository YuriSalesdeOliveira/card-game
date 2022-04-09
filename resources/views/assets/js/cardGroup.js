/**
 * Define o comportamento de quando o usuário clica para
 * selecionar um carta
 */

(function () {

    let cards = document.querySelectorAll('.card-group-item');

    cards.forEach(card => {

        card.addEventListener('click', () => {

            let cardId = card.getAttribute('data-card-id');
            let radioOrCheckbox = document.querySelector(`input[data-card-id="${cardId}"]`);

            if (radioOrCheckbox.checked) {

                radioOrCheckbox.checked = false;

                return;
            }

            radioOrCheckbox.checked = true;
        });

    });

})();