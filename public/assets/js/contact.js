const myNom = document.querySelector('#nom');
const myPrenom = document.querySelector('#prenom');
const myEmail = document.querySelector('#email');
const myTel = document.querySelector('#tel');
const myMessage = document.querySelector('#message');
const submitButton = document.querySelector('#buttonSubmit');
const form = document.querySelector('#form');

const regexEmail = /^([\w-]+(?:.[\w-]+))@((?:[\w-]+.)\w[\w-]{0,66}).([a-z]{2,6}(?:.[a-z]{2})?)$/i;
const regexName = /^[A-Za-zÀ-ÿç]+[- ]?[A-Za-zÀ-ÿç]+$/;
const regexTel = /^[0-9]{10}$/;
const regexAdresse = /^[A-Za-zÀ-ÿ- ç\d]+[- ]?[A-Za-zÀ-ÿç]+$/;
const regexMessage = /^.+/;
myNom.addEventListener('change', function () {
    validateField(this, regexName);
});

myPrenom.addEventListener('change', function () {
    validateField(this, regexName);

});

myEmail.addEventListener('change', function () {
    validateField(this, regexEmail);

});

myTel.addEventListener('change', function () {
    validateField(this, regexTel);
});

myMessage.addEventListener('change', function () {
    validateField.apply(this, regexMessage);
})

function validateField(input, regex) {
    if (regex.test(input.value)) {
        input.classList.remove("borderRed");
        input.classList.add("borderGreen");
        submitButton.disabled = false;
        return true;
    } else {
        input.classList.remove("borderGreen");
        input.classList.add("borderRed");
        submitButton.disabled = true;
        return false;
    }
}

submitButton.addEventListener('click', function (e) {

    if (validateField(myEmail, regexEmail) && validateField(myPrenom, regexName) && validateField(myNom, regexName) && validateField(myTel, regexTel) && validateField(myMessage, regexMessage)) {
        form.submit();
    }
    console.log(form);
});
