require('./bootstrap');

// todo: find a more robust way to inject JavaScript below

/*
 * VARIABLES:
 */

const elNewActionForm = document.getElementById('new-action-form');
const elNewActionFormResetBtn = document.getElementById('new-action-form-reset-btn');
const elActionDescriptions = document.getElementsByClassName('js-action-description');
const elActionDeleteButtons = document.getElementsByClassName('js-action-delete-btn');

/*
 * EVENTS:
 */

elNewActionFormResetBtn.addEventListener('click', handleNewActionFormReset, false);

for (var i = 0; i < elActionDescriptions.length; i++) {
    elActionDescriptions[i].addEventListener('focus', handleActionDescriptionFocus, false);
    elActionDescriptions[i].addEventListener('blur', handleActionDescriptionBlur, false);
}
for (var i = 0; i < elActionDeleteButtons.length; i++) {
    elActionDeleteButtons[i].addEventListener('click', handleActionDelete, false);
}

/*
 * FUNCTIONS:
 */

function handleNewActionFormReset() {
    elNewActionForm.reset();
}

function handleActionDescriptionFocus() {
    this.style.height = '';
    this.style.height = this.scrollHeight + 'px';
}

function handleActionDescriptionBlur() {
    this.style.height = '2.5rem';
}

function handleActionDelete() {
    const closestActionTitle = this.closest('.js-related-actions-block');
    const actionBlock = this.closest('.js-action-block');

    axios.delete('/action/' + this.dataset.id)
        .then(function (response) {
            // handle success

            actionBlock.remove();

            if (closestActionTitle.querySelectorAll('.js-action-block').length === 0) {
                closestActionTitle.remove();
            }
        })
        .catch(function (error) {
            // handle error

            console.error(error);
        })
}