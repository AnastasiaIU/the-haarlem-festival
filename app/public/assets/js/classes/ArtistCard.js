import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the artist cards.
 */
export class ArtistCard {
    async init() {
        this.cms = await CMS.create();
        this.artists = await fetchFromApi('/api/getArtists');
        this.artistCardContainer = document.getElementById('artistCardContainer');

        await this.populateCards();
    }

    static async create() {
        const instance = new ArtistCard();
        await instance.init();
        return instance;
    }

    async populateCards() {
        let buttonId = 7;

        for (let i = 0; i < this.artists.length; i++) {
            const artist = this.artists[i];

            if (i !== 0) {
                const artistCard = this.artistCardContainer.lastElementChild;
                const clone = artistCard.cloneNode(true);
                this.artistCardContainer.appendChild(clone);
            }

            await this.bindDataToArtistCard(artist, buttonId, i % 2 !== 0);

            buttonId += 1;
        }

        await this.cms.initTinyMce('.tinymce-artist-card', '.change-image-artist-card', '.tinymce-form-artist-card');
    }

    /**
     * Binds data to an artist card based on the provided artist object.
     *
     * @param artist The artist object to bind.
     * @param buttonId The ID of the button to use for the "Learn more" button
     * @param left If the card image should be placed on the left side of the screen.
     */
    async bindDataToArtistCard(artist, buttonId, left = false) {
        const artistCard = this.artistCardContainer.lastElementChild;
        this.setCardStyle(artistCard, left);

        const textContainer = artistCard.querySelector('.artist-card-text-container');
        this.setTextStyle(textContainer, left);

        this.updateTextField(textContainer, '.card-stage-name', artist.stage_name, artist, 'stage_name');
        this.updateTextField(textContainer, '.card-genre', artist.genre, artist, 'genre');
        this.updateTextField(textContainer, '.card-description', artist.card_description, artist, 'card_description');

        await this.updateButton(textContainer, buttonId, left);

        this.updateImage(artistCard, artist);
    }

    /**
     * Sets the text style of the artist card.
     *
     * @param container The container to set the text style for.
     * @param left If the image should be placed on the left side of the screen.
     */
    setTextStyle(container, left) {
        if (left) {
            if (container.classList.contains("pe-3")) {
                container.classList.remove("pe-3");
            }
            container.classList.add("ps-3", "flex-end");
        } else {
            if (container.classList.contains("ps-3")) {
                container.classList.remove("ps-3");
            }
            if (container.classList.contains("flex-end")) {
                container.classList.remove("flex-end");
            }
            container.classList.add("pe-3")
        }
    }

    /**
     * Sets the card style of the artist card.
     *
     * @param card The card to set the style for.
     * @param left If the image should be placed on the left side of the screen.
     */
    setCardStyle(card, left) {
        if (left) {
            card.classList.add("flex-row-reverse");
        } else {
            if (card.classList.contains("flex-row-reverse")) {
                card.classList.remove("flex-row-reverse");
            }
        }
    }

    /**
     * Updates the image of the artist card.
     *
     * @param container The container that holds the artist card.
     * @param artist The artist object to update the image for.
     */
    updateImage(container, artist) {
        const image = container.querySelector('.artist-card-image');
        image.src = `/assets/images/${artist.card_image}`;
        image.alt = `${artist.stage_name} at a concert`;
        image.id = `card_image_${artist.slug}`;

        const changeButton = container.querySelector('.change-image-artist-card');
        changeButton.id = `${image.id}_button`;

        const input = changeButton.nextElementSibling;
        input.dataset.button = changeButton.id;

        this.cms.setImageInputDataset(changeButton.id, 'artist', artist.id, 'card_image', image.id);
    }

    /**
     * Updates the text field of the artist card.
     *
     * @param container The container that holds the artist card text.
     * @param selector The selector of the field to update.
     * @param value The value to update the field with.
     * @param artist The artist object to update the field for.
     * @param column The column to update the field for.
     */
    updateTextField(container, selector, value, artist, column) {
        const field = container.querySelector(selector);
        field.innerHTML = value;
        field.id = `${artist.slug}-${column}`;

        const input = container.querySelector(`input[data-field_id*="${column}"]`);
        input.dataset.field_id = field.id;

        this.cms.setContentInputDataset(field.id, 'artist', artist.id, column);
    }

    /**
     * Updates the button of the artist card.
     *
     * @param container The container that holds the artist card text.
     * @param buttonId The ID of the button to fetch from the database.
     * @param left If the image should be placed on the left side of the screen.
     */
    async updateButton(container, buttonId, left) {
        const learnMoreButton = await fetchFromApi(`/api/getButtonById/${buttonId}`);
        const newButton = this.cms.createButton(learnMoreButton, 'btn btn-primary font-p-16 fw-bold');
        const button = container.querySelector('.artist-card-button');
        if (left) {
            button.classList.add("d-flex", "justify-content-end");
        } else {
            if (button.classList.contains("d-flex")) {
                button.classList.remove("d-flex");
            }
            if (button.classList.contains("justify-content-end")) {
                button.classList.remove("justify-content-end");
            }
        }
        button.innerHTML = newButton.outerHTML;
    }
}