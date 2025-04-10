/**
 * Class that handles the registration form.
 */
export class RegistrationForm {
    init() {
        this.form = document.getElementById("registrationForm");
        this.email = document.getElementById("inputEmail");
        this.emailPrompt = document.getElementById("inputEmailPrompt");
        this.name = document.getElementById("inputName");
        this.password = document.getElementById("inputPassword");
        this.confirmPassword = document.getElementById("inputConfirmPassword");
        this.confirmPasswordPrompt = document.getElementById("confirmPasswordPrompt");
        this.showPasswordCheck = document.getElementById('showPasswordCheck');
        this.captchaPrompt = document.getElementById('captchaPrompt');

        this.form.addEventListener('submit', (event) => this.handleFormSubmission(event));
        this.showPasswordCheck.addEventListener('change', () => this.togglePasswordVisibility());
        this.email.addEventListener('change', () => this.resetFieldsValidation());
        this.name.addEventListener('change', () => this.resetFieldsValidation());
        this.password.addEventListener('change', () => this.resetFieldsValidation());
        this.confirmPassword.addEventListener('change', () => this.resetFieldsValidation());
    }

    static create() {
        const instance = new RegistrationForm();
        instance.init();
        return instance;
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

        if (this.name.value === '') {
            this.name.setCustomValidity('Name cannot be empty.');
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
                if (result.user_error) {
                    this.email.setCustomValidity(result.user_error);
                    this.emailPrompt.innerHTML = '';
                    this.name.setCustomValidity(result.user_error);
                    this.password.setCustomValidity(result.user_error);
                    this.confirmPassword.setCustomValidity(result.user_error);
                    this.confirmPasswordPrompt.innerHTML = result.user_error;
                } else {
                    this.captchaPrompt.style.display = 'block';
                }
                grecaptcha.reset();
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
        this.name.setCustomValidity('');
        this.password.setCustomValidity('');
        this.confirmPassword.setCustomValidity('');
        this.captchaPrompt.style.display = 'none';
    }
}