/**
 * Class that handles the CMS-related operations.
 */
export class CMS {
    static #instance = null;

    constructor() {
        if (CMS.#instance) {
            return CMS.#instance;
        }
        CMS.#instance = this;
    }

    async init() {
        await this.initTinyMceButtons('.change-image', '.tinymce-form');
    }

    static async create() {
        if (!CMS.#instance) {
            CMS.#instance = new CMS();
            await CMS.#instance.init();
        }
        return CMS.#instance;
    }

    /**
     * Displays a toast notification on the screen.
     *
     * @param {string} message - The message to display in the toast.
     * @param {boolean} [isError=false] - If `true`, the toast will be styled as an error message.
     *                                    Otherwise, it appears as a success message.
     */
    showToast(message, isError = false) {
        const toast = document.createElement("div");
        toast.className = "toast-message";
        if (isError) toast.classList.add("toast-error");

        toast.innerText = message;
        document.body.appendChild(toast);

        // Auto-remove toast after 3 seconds
        setTimeout(() => {
            toast.style.opacity = "0";
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    /**
     * Updates content in the database by sending a form submission via an API request.
     *
     * This function extracts the content from a TinyMCE input field, processes the form data,
     * and sends an asynchronous POST request to update the content in the database.
     * A toast notification is displayed based on the success or failure of the operation.
     *
     * @async
     * @param {HTMLFormElement} form - The form element that triggered the update.
     */
    async updateContent(form) {
        const input = form.querySelector('.tinymce-input');
        const content = document.getElementById(input.dataset.field_id);
        input.value = content.innerHTML;

        const table = input.dataset.database;
        const id = input.dataset.id;
        const column = input.dataset.column;

        const formData = new FormData();
        formData.append('table', table);
        formData.append('id', id);
        formData.append('column', column);

        if (input.value === '<br data-mce-bogus="1">') {
            formData.append('content', '');
        } else {
            formData.append('content', input.value);
        }

        try {
            const response = await fetch('/api/uploadContent', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            const data = await response.json();

            if (data.status === "success") {
                this.showToast("Content uploaded successfully.");
            } else {
                this.showToast(data.message || "Error uploading content.", true);
            }
        } catch (error) {
            this.showToast("Upload failed: " + error.message, true);
        }
    }

    /**
     * Binds a change image input element to a button element.
     *
     * @param button - The button element to bind the input to.
     */
    bindInputToButton(button) {
        const input = document.querySelector(`input[data-button="${button.id}"]`);
        if (input) {
            button.addEventListener('click', () => {
                input.click()
            });
            input.addEventListener('change', (event) => this.uploadImage(event, input))
        }
    }

    /**
     * Sets the dataset of a change image input element.
     * The dataset contains the database table name, row id, column name, and the id of the associated image.
     *
     * @param buttonId Id of the associated change image button.
     * @param database Database table name.
     * @param id Row id.
     * @param column Column name.
     * @param imageId Id of the associated image.
     */
    setImageInputDataset(buttonId, database, id, column, imageId) {
        const changeImageButton = document.getElementById(buttonId);
        const input = document.querySelector(`input[data-button="${changeImageButton.id}"]`);
        input.dataset.database = database;
        input.dataset.id = id;
        input.dataset.column = column;
        input.dataset.image_id = imageId;
    }

    /**
     * Sets the dataset of a change content input element.
     * The dataset contains the database table name, row id, and column name.
     *
     * @param contentId Id of the associated content element.
     * @param database Database table name.
     * @param id Row id.
     * @param column Column name.
     */
    setContentInputDataset(contentId, database, id, column) {
        const input = document.querySelector(`input[data-field_id="${contentId}"]`);
        input.dataset.database = database;
        input.dataset.id = id;
        input.dataset.column = column;
    }

    /**
     * Handles the upload of an image file to the server.
     *
     * This function retrieves the selected file from the input event, extracts metadata from
     * the associated input element, and sends the file along with database details to the
     * server via a `fetch` request.
     *
     * @param {Event} event - The file input change event triggered by the user selecting an image.
     * @param {HTMLInputElement} input - The file input element containing dataset attributes
     *                                   for table, id, and column.
     */
    uploadImage(event, input) {
        const file = event.target.files[0];
        if (!file) return;

        const table = input.dataset.database;
        const id = input.dataset.id;
        const column = input.dataset.column;

        const formData = new FormData();
        formData.append('image', file);
        formData.append('table', table);
        formData.append('id', id);
        formData.append('column', column);

        fetch('/api/uploadImage', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                const imageElement = document.getElementById(input.dataset.image_id);
                if (data.status === "success" && data.imagePath && imageElement) {
                    // Append a timestamp to force browser cache refresh
                    imageElement.src = `${data.imagePath}?t=${new Date().getTime()}`;
                } else {
                    console.error(data.message || "Error uploading image.");
                }
            })
            .catch(error => console.error("Upload failed:", error));
    }

    /**
     * Creates a new button element with the specified text, link, and icon.
     *
     * @param button - Object containing the button text, link, and optional icon.
     * @param className - CSS class to apply to the button.
     * @returns {HTMLAnchorElement} - The newly created button element.
     */
    createButton(button, className) {
        const newButton = document.createElement('a');
        newButton.type = 'button';
        newButton.className = className;
        if (button.link) {
            newButton.href = `${button.link}`;
        }
        newButton.textContent = button.text;

        if (button.icon) {
            const icon = document.createElement('img');
            icon.src = `/assets/images/${button.icon}`;
            icon.alt = "";
            icon.classList.add("button-icon");

            // Add the icon before the text
            newButton.prepend(icon);
        }

        return newButton;
    }

    /**
     * Initializes CMS for the specified selectors.
     *
     * @param textSelector - The selector for text elements.
     * @param imageSelector - The selector for the image elements.
     * @param formSelector - The selector for the form elements.
     */
    async initTinyMce(textSelector, imageSelector, formSelector) {
        tinymce.init({
            selector: `${textSelector}`,
            plugins: [
                'anchor', 'autolink', 'charmap', 'emoticons', 'link', 'lists', 'searchreplace', 'table', 'visualblocks', 'wordcount'
            ],
            toolbar: 'undo redo | fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            inline: true
        });

        await this.initTinyMceButtons(imageSelector, formSelector);
    }

    /**
     * Initializes CMS functionality on buttons for the provided selectors.
     *
     * @param imageSelector - The selector for the image elements.
     * @param formSelector - The selector for the form elements.
     */
    async initTinyMceButtons(imageSelector, formSelector) {
        document.querySelectorAll(imageSelector).forEach(button => {
            this.bindInputToButton(button);
        });

        document.querySelectorAll(formSelector).forEach(form => {
            form.addEventListener('submit', async event => {
                event.preventDefault();
                await this.updateContent(event.target);
            });
        });
    }
}