export class LoginForm {
    constructor() {
        this.form = document.getElementById("loginForm");
        this.email = document.getElementById("loginEmail");
        this.password = document.getElementById("loginPassword");
        this.inputEmailPrompt = document.getElementById("loginEmailPrompt");
        this.inputPasswordPrompt = document.getElementById("loginPasswordPrompt");
        this.showPasswordCheck = document.getElementById('showPasswordCheck');

        this.initializeValidation();

        this.form.addEventListener('submit', () => this.handleFormSubmission());
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
    handleFormSubmission() {
        this.email.setCustomValidity('');
        this.password.setCustomValidity('');
        this.inputPasswordPrompt.innerHTML = 'Password address cannot be empty.';

        if (this.email.value === '') {
            this.inputEmailPrompt.innerHTML = 'Email address cannot be empty.';
        } else {
            this.inputEmailPrompt.innerHTML = 'Invalid email.';
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