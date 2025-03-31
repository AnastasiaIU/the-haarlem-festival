import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the Strolls event.
 */
export class Strolls {
    async init() {
        this.cms = await CMS.create();
        this.cardsContainer = document.getElementById('locationsContainer');
        this.locations = await fetchFromApi('/api/getLocations');

        await this.setTitle();
        this.populateCards();

        await this.cms.initTinyMce('.tinymce-locations', '.change-image-locations', '.tinymce-form-locations');
    }

    static async create() {
        const instance = new Strolls();
        await instance.init();
        return instance;
    }

    /**
     * Populates the UI with location cards based on the locations array.
     * Clones the first `.location-card` for each new card (except the first one),
     * then binds the data for each location.
     */
    populateCards() {
        for (let i = 0; i < this.locations.length; i++) {
            const location = this.locations[i];

            if (i !== 0) {
                const cards = this.cardsContainer.querySelectorAll('.location-card');
                const lastCard = cards[cards.length - 1];

                const clone = lastCard.cloneNode(true);
                this.cardsContainer.appendChild(clone);
            }

            this.bindDataToCard(location, i % 2 !== 0);
        }
    }

    /**
     * Binds a location's data to the latest `.location-card` in the DOM.
     * Updates name, description, address, image, link, and layout direction.
     *
     * @param {Object} location - The location object.
     * @param {boolean} left - Whether the image should be placed on the left.
     */
    bindDataToCard(location, left = false) {
        const cards = this.cardsContainer.querySelectorAll('.location-card');
        const lastCard = cards[cards.length - 1];

        this.setName(lastCard, location);
        this.setDescription(lastCard, location);
        this.setAddress(lastCard, location);
        this.setButtonLink(lastCard, location);
        this.setImage(lastCard, location);
        this.reorderImage(lastCard, left);
    }

    /**
     * Sets the button link of the location card to the specific stroll detail page.
     *
     * @param {HTMLElement} card - The location card element.
     * @param {Object} location - The location object.
     */
    setButtonLink(card, location) {
        const button = card.querySelector('.location-card-button a');
        button.href = `/strolls/${location.slug}`;
    }

    /**
     * Sets the address in the card with a clickable Google Maps link.
     *
     * @param {HTMLElement} card - The location card element.
     * @param {Object} location - The location object.
     */
    setAddress(card, location) {
        const address = card.querySelector('.location-address a');

        let searchParameter = location.name.replace(' ', '+');
        searchParameter += '+haarlem';

        address.href = `https://www.google.com/maps/search/?api=1&query=${searchParameter}`;
        address.innerHTML = location.address;
    }

    /**
     * Reorders the layout of image and text inside the card depending on `left`.
     *
     * @param {HTMLElement} card - The location card element.
     * @param {boolean} left - Whether the image should be placed on the left.
     */
    reorderImage(card, left) {
        const imageContainer = card.querySelector('.location-image-container');
        const textContainer = card.querySelector('.text-container');

        if (left) {
            imageContainer.style.order = 1;
            textContainer.style.order = 2;
        } else {
            textContainer.style.order = 1;
            imageContainer.style.order = 2;
        }
    }

    /**
     * Sets the card description and binds it to the CMS editor input.
     *
     * @param {HTMLElement} card - The location card element.
     * @param {Object} location - The location object.
     */
    setDescription(card, location) {
        const description = card.querySelector('.location-text');
        description.id = `location-desc-${location.slug}`;
        description.innerHTML = location.card_description;

        const input = description.nextElementSibling;
        input.dataset.field_id = description.id;

        this.cms.setContentInputDataset(description.id, 'location', location.id, 'card_description');
    }

    /**
     * Sets the card image and configures it to be editable via the CMS.
     *
     * @param {HTMLElement} card - The location card element.
     * @param {Object} location - The location object.
     */
    setImage(card, location) {
        const image = card.querySelector('.location-card-image');
        image.src = `/assets/images/${location.card_image}`;
        image.id = `location-image-${location.slug}`;

        const saveButton = image.nextElementSibling;
        saveButton.id = `location-button-${location.slug}`;

        const input = saveButton.nextElementSibling;
        input.dataset.button = saveButton.id;

        this.cms.setImageInputDataset(saveButton.id, 'location', location.id, 'card_image', image.id);
    }

    /**
     * Sets the location name in the card and binds it to the CMS input.
     *
     * @param {HTMLElement} card - The location card element.
     * @param {Object} location - The location object.
     */
    setName(card, location) {
        const name = card.querySelector('.location-name');
        name.id = `location-name-${location.slug}`;
        name.innerHTML = location.name;

        const input = name.nextElementSibling;
        input.dataset.field_id = name.id;

        this.cms.setContentInputDataset(name.id, 'location', location.id, 'name');
    }

    /**
     * Sets the main title and subtitle for the Strolls page,
     * fetched from the CMS and made editable.
     */
    async setTitle() {
        const titleElement = document.getElementById('strollsTitle');
        const title = await fetchFromApi('/api/getCustomByIdentifier/strolls_title_tour_info');
        titleElement.innerHTML = title.content;
        this.cms.setContentInputDataset(titleElement.id, 'custom', title.id, 'content');

        const subtitleElement = document.getElementById('strollsDescription');
        const subtitle = await fetchFromApi('/api/getCustomByIdentifier/strolls_description_tour_info');
        subtitleElement.innerHTML = subtitle.content;
        this.cms.setContentInputDataset(subtitleElement.id, 'custom', subtitle.id, 'content');
    }
}