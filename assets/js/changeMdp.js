
const changementMdp = document.querySelector('#mdp');
const checkMdp = document.querySelector('#mdp2');
const submitButton = document.querySelector('#buttonSubmit');
const form = document.querySelector('#form');
const regexMdp = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
changementMdp.addEventListener('change', function () {
    validateField(this, regexMdp);
});
checkMdp.addEventListener('change', function () {
    validateField(this, regexMdp);
});

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

submitButton.addEventListener('click', function () {
    if (checkMdp == changementMdp) {
        if (validateField(changementMdp, regexMdp) && validateField(checkMdp, regexMdp)) {
            form.submit();
        } else {
            alert("Le mot de passe n'est pas indentique");
        }
    }
});
