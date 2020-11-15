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


function showDate(dateVal) {
    dateVal = new Date(dateVal);
    return dateVal.getDate() + "." + (dateVal.getMonth() + 1) + "." + dateVal.getFullYear();
}


function paymentMethod(method, assetUrl) {
    var paymentImage = document.querySelector('#paymentImage');

    if (method == 'online') {
        paymentImage.setAttribute('src', assetUrl + '/ps.png');
        paymentImage.setAttribute('alt', 'PayStack');
    } else if (method == 'deposit') {
        paymentImage.setAttribute('src', assetUrl + '/gtb.jpg');
        // paymentImage.clientHeight = '10px';
        paymentImage.setAttribute('width', '250');
        paymentImage.setAttribute('alt', 'GT Bank');
    }
}


function validateAddFundInputAmount() {
    var currency = document.querySelector('#currency').value;

    if (currency == 'NGN') {
        var minimumAmount = 500;
        document.querySelector('#inputInfo').innerHTML = 'Minimum deposit amount in Nigerian Naira is &#8358;500';
        document.querySelector('#currencyLabel').innerHTML = 'NGN';
    } else if (currency == 'USD') {
        var minimumAmount = 1.39;
        document.querySelector('#inputInfo').innerHTML = 'Minimum deposit amount in US Dollar is $1.39';
        document.querySelector('#currencyLabel').innerHTML = 'USD';
    }

    var field = document.querySelector('#amount');
    var submitButton = document.querySelector('#payFunds');

    if (field.value < minimumAmount) {
        submitButton.style.display = 'none'
        field.classList.add('border-red-600');
        return false;
    } else if (field.value >= minimumAmount) {
        submitButton.style.display = 'block';
        field.classList.add('border-green-600');
        return true;
    } else {
        submitButton.style.display = 'none'
        field.classList.add('border-red-600');
        return false;
    }
}


function payFunds(minimumAmount, userId) {
    var amount = document.querySelector('#amount').value;
    var method = document.querySelector('input[name="method"]:checked').value;

    if (validateAddFundInputAmount(minimumAmount) == true) {
        if (method == 'online') {
            payWithPaystack('online', userId);
        } else if (method == 'deposit') {
            payWithPaystack('deposit', userId);
        }
    } else {
        return false;
    }
}




function payWithPaystack(paymentMethod, userId) {
    var currency = document.querySelector('#currency').value;
    var amountEntered = document.querySelector('#amount').value;
    var realAmount = amountEntered + '00';
    var email = document.querySelector('#email').value;
    var firstName = document.querySelector('#first_name').value;
    var lastName = document.querySelector('#last_name').value;
    var payment_method = document.querySelector('input[name="method"]:checked').value


    if (paymentMethod == 'online') {
        var channels = ['card', 'bank', 'qr', 'mobile_money'];
    } else if (paymentMethod == 'deposit') {
        var channels = ['ussd', 'bank_transfer']
    }
    // pk_test_adca19072ca586f98a958f2a2633adcd8e328b5e
    // pk_live_dc285740b50dea728a3dead8c82c23b3fd651f11
    var handler = PaystackPop.setup({
        key: 'pk_live_dc285740b50dea728a3dead8c82c23b3fd651f11',
        email: email,
        amount: realAmount,
        ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you 
        currency: currency,
        channels: channels,

        metadata: {
            custom_fields: [{
                display_name: "Name",
                variable_name: "name",
                value: firstName + ' ' + lastName
            }]
        },
        callback: function (response) {
            var data = {
                amount: amountEntered,
                user_id: userId,
                reference: response.reference,
                currency: currency,
                payment_method: payment_method,
            }

            fetch('/api/paymentrecords', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Your payment has been successfully processed',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500)
                })
                .catch((error) => {
                    console.error('Error:', error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'We are sorry, an unknown error occured, please try again',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        },
        onClose: function () {
            alert('Payment cancelled');
        }
    });
    handler.openIframe();
}

// function savePaymentRecords(reference, userId) {
//     var currency = document.querySelector('#currency').value;
//     var amount = document.querySelector('#amount').value;
//     var user_id = userId;
//     var payment_method = document.querySelector('input[name="method"]:checked').value


// }
