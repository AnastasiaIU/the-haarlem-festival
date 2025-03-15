export class LoginForm {
    constructor() {
        this.form = document.getElementById("loginForm");
        this.email = document.getElementById("loginEmail");
        this.password = document.getElementById("loginPassword");
        this.inputEmailPrompt = document.getElementById("loginEmailPrompt");
        this.inputPasswordPrompt = document.getElementById("loginPasswordPrompt");
        this.showPasswordCheck = document.getElementById('showPasswordCheck');

        this.initializeValidation();

        this.form.addEventListener('submit', (event) => this.handleFormSubmission(event));
        this.showPasswordCheck.addEventListener('change', () => this.togglePasswordVisibility());
        this.email.addEventListener('change', () => this.resetCredentialsValidation());
        this.password.addEventListener('change', () => this.resetCredentialsValidation());
    }

    /**
     * Initializes the validation by checking if the email or password inputs are not empty.
     * If either input is not empty, sets a custom validity message and updates the UI accordingly.
     */
    initializeValidation() {
        if (this.email.value !== '' || this.password.value !== '') {
            this.email.setCustomValidity('Wrong email or password. Please, try again.');
            this.password.setCustomValidity('Wrong email or password. Please, try again.');
            this.inputEmailPrompt.innerHTML = '';
            this.inputPasswordPrompt.innerHTML = this.password.validationMessage;
            this.form.classList.add('was-validated');
        }
    }

    /**
     * Handles form submission by validating the inputs and updating the UI accordingly.
     */
    async handleFormSubmission(event) {
        event.preventDefault()

        this.resetCredentialsValidation();

        if (this.email.value === '') {
            this.inputEmailPrompt.innerHTML = 'Email address cannot be empty.';
        } else {
            this.inputEmailPrompt.innerHTML = 'Invalid email.';
        }

        if (this.form.checkValidity()) {
            const formData = new FormData(this.form);
            const response = await fetch('/login', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (response.ok) {
                window.location.href = result.redirectUrl;
            } else {
                this.email.setCustomValidity(result.error);
                this.inputEmailPrompt.innerHTML = '';
                this.password.setCustomValidity(result.error);
                this.inputPasswordPrompt.innerHTML = result.error;
            }
        } else {
            event.stopPropagation()
        }

        this.form.classList.add('was-validated');
    }

    /**
     * Toggles the visibility of the password field.
     */
    togglePasswordVisibility() {
        const type = this.showPasswordCheck.checked ? 'text' : 'password';
        this.password.setAttribute('type', type);
    }

    /**
     * Resets the custom validity messages for the email and password inputs.
     * This method clears any previously set custom validity messages, allowing
     * the inputs to be validated again without any custom error messages.
     */
    resetCredentialsValidation() {
        this.email.setCustomValidity('');
        this.password.setCustomValidity('');
    }
}