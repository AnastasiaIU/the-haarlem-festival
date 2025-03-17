export class LoginForm {
    constructor() {
        this.form = document.getElementById("loginForm");
        this.email = document.getElementById("loginEmail");
        this.password = document.getElementById("loginPassword");
        this.inputEmailPrompt = document.getElementById("loginEmailPrompt");
        this.inputPasswordPrompt = document.getElementById("loginPasswordPrompt");
        this.showPasswordCheck = document.getElementById('showPasswordCheck');

        this.form.addEventListener('submit', (event) => this.handleFormSubmission(event));
        this.showPasswordCheck.addEventListener('change', () => this.togglePasswordVisibility());
        this.email.addEventListener('change', () => this.resetCredentialsValidation());
        this.password.addEventListener('change', () => this.resetCredentialsValidation());
    }

    /**
     * Handles form submission by validating the inputs and updating the UI accordingly.
     */
    async handleFormSubmission(event) {
        event.preventDefault()

        this.resetCredentialsValidation();

        if (this.email.value === '') {
            this.email.setCustomValidity('Email address cannot be empty.');
            this.inputEmailPrompt.innerHTML = this.email.validationMessage;
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
            // Stop the form submission
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
     */
    resetCredentialsValidation() {
        this.email.setCustomValidity('');
        this.password.setCustomValidity('');
    }
}