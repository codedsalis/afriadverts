function watchAgreementCheck() {
    const agreement = document.querySelector('#agreement');
    const submitButton = document.querySelector('#submit-btn');

    if (agreement.checked === false) {
        submitButton.style.display = 'none';
    } else {
        submitButton.style.display = 'block';
    }
}



function createInput() {
    const field = document.querySelector("#vCodeField");
    const create = document.createElement("input");
    create.setAttribute("id", "vCode");
    create.setAttribute("type", "text");
    create.setAttribute(
        "value",
        '&lt;meta name=&quot;afri_verification&quot; content=&quot;"' +
        copy() +
        '"&quot;/&gt;'
    );
    document.querySelector("#vCodeField").appendChild(create);
}
