export class RegistrationForm {
    constructor() {
        this.form = document.getElementById("registrationForm");
        this.email = document.getElementById("inputEmail");
        this.emailPrompt = document.getElementById("inputEmailPrompt");
        this.password = document.getElementById("inputPassword");
        this.confirmPassword = document.getElementById("inputConfirmPassword");
        this.confirmPasswordPrompt = document.getElementById("confirmPasswordPrompt");
        this.showPasswordCheck = document.getElementById('showPasswordCheck');

        this.form.addEventListener('submit', (event) => this.handleFormSubmission(event));
        this.showPasswordCheck.addEventListener('change', () => this.togglePasswordVisibility());
        this.email.addEventListener('change', () => this.resetFieldsValidation());
        this.password.addEventListener('change', () => this.resetFieldsValidation());
        this.confirmPassword.addEventListener('change', () => this.resetFieldsValidation());
    }

    /**
     * Handles form submission by validating the inputs and updating the UI accordingly.
     */
    async handleFormSubmission(event) {
        event.preventDefault()

        this.resetFieldsValidation();

        if (this.email.value === '') {
            this.email.setCustomValidity('Email address cannot be empty.');
            this.emailPrompt.innerHTML = this.email.validationMessage;
        } else {
            this.emailPrompt.innerHTML = 'Invalid email.';
        }

        // Check if the passwords are matching
        if (this.password.value !== this.confirmPassword.value) {
            this.password.setCustomValidity("Passwords do not match.");
            this.confirmPassword.setCustomValidity("Passwords do not match.");
            this.confirmPasswordPrompt.innerHTML = this.confirmPassword.validationMessage;
        }

        if (this.form.checkValidity()) {
            const formData = new FormData(this.form);
            const response = await fetch('/register', {
                method: 'POST',
                body: formData
            });
            if (response.ok) {
                window.location.href = '/login';
            } else {
                const result = await response.json();
                this.email.setCustomValidity(result.error);
                this.emailPrompt.innerHTML = '';
                this.password.setCustomValidity(result.error);
                this.confirmPassword.setCustomValidity(result.error);
                this.confirmPasswordPrompt.innerHTML = result.error;
            }
        } else {
            // Stop the form submission
            event.stopPropagation()
        }

        this.form.classList.add('was-validated');
    }

    /**
     * Toggles the visibility of the password fields.
     */
    togglePasswordVisibility() {
        const type = this.showPasswordCheck.checked ? 'text' : 'password';
        this.password.setAttribute('type', type);
        this.confirmPassword.setAttribute('type', type);
    }

    /**
     * Resets the custom validity messages for the email and password inputs
     */
    resetFieldsValidation() {
        this.email.setCustomValidity('');
        this.password.setCustomValidity('');
        this.confirmPassword.setCustomValidity('');
    }
}