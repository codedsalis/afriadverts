function watchAgreementCheck() {
    const agreement = document.querySelector('#agreement');
    const submitButton = document.querySelector('#submit-btn');

    if (agreement.checked === false) {
        submitButton.style.display = 'none';
    } else {
        submitButton.style.display = 'block';
    }
}
