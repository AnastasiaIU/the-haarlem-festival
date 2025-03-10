document.addEventListener('DOMContentLoaded', function() {
    var stripe = Stripe('pk_test_51QwoutQK69u3tWgIlRgxuXiFTbHeu6BcTM1W116z4awCk8jKXn4cJ24a0BBnFpk5PBxzvD5gwwkrhikWNSFwS1tW00O0i76fKH');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});
    card.mount('#card-element');

    // Create an instance of the iDEAL Bank Element.
    var idealBank = elements.create('idealBank', {style: style});
    idealBank.mount('#ideal-bank-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle real-time validation errors from the iDEAL Bank Element.
    idealBank.addEventListener('change', function(event) {
        var displayError = document.getElementById('ideal-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Show the appropriate payment method form based on the selected payment method.
    document.getElementById('payment-method').addEventListener('change', function(event) {
        var paymentMethod = event.target.value;
        document.querySelectorAll('.payment-method').forEach(function(element) {
            element.style.display = 'none';
        });
        if (paymentMethod === 'card') {
            document.getElementById('card-payment').style.display = 'block';
        } else if (paymentMethod === 'ideal') {
            document.getElementById('ideal-payment').style.display = 'block';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var paymentMethod = document.getElementById('payment-method').value;
        if (paymentMethod === 'card') {
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        } else if (paymentMethod === 'ideal') {
            stripe.createSource(idealBank).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('ideal-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeSourceHandler(result.source);
                }
            });
        }
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }

    function stripeSourceHandler(source) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeSource');
        hiddenInput.setAttribute('value', source.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
});