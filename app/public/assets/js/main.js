import {Navigation} from "./classes/Navigation.js";

/**
 * Initializes event listeners and functions when the DOM content is fully loaded.
 */
document.addEventListener("DOMContentLoaded", async () => {
    await Navigation.create();
    enableBootstrapFormValidation();
});

/**
 * Enables Bootstrap form validation.
 * Adds an event listener to the window's load event to apply custom Bootstrap validation styles to forms.
 * Prevents form submission if the form is invalid and adds the 'was-validated' class to the form.
 */
function enableBootstrapFormValidation() {
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        let forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
}

/**
 * Fetches data from the given API URL.
 *
 * @param {string} url The URL to fetch data from.
 * @returns {Promise<Object>} A promise that resolves to the JSON response.
 * @throws {Error} Throws an error if the HTTP response is not ok.
 */
export async function fetchFromApi(url) {
    const response = await fetch(url);
    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    return await response.json();
}