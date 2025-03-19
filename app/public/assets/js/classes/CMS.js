export class CMS {
    constructor() {
        document.querySelectorAll('.change-image').forEach(button => {
            this.bindInputToButton(button);
        });
    }

    /**
     * Binds a change image input element to a button element.
     *
     * @param button - The button element to bind the input to.
     */
    bindInputToButton(button) {
        const input = document.querySelector(`input[data-button="${button.id}"]`);
        button.addEventListener('click', () => {
            input.click()
        });
        input.addEventListener('change', (event) => this.uploadImage(event, input))
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
        newButton.href = `/${button.link}`;
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
}