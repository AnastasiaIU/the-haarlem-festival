import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the Strolls schedule.
 */
export class StrollsSchedule {
    async init() {
        this.cms = await CMS.create();
        this.cardsContainer = document.getElementById('strollsSchedule');
        this.tours = await fetchFromApi('/api/getTours');
        this.groupedTours = this.groupToursByDayAndGuide();

        await this.setTitles();
        this.populateCards();

        await this.cms.initTinyMce('.tinymce-guides', '.change-image-guides', '.tinymce-form-guides');
    }

    static async create() {
        const instance = new StrollsSchedule();
        await instance.init();
        return instance;
    }

    /**
     * Iterates through all grouped tours by date and guide, clones the last schedule card if needed,
     * and binds the tour data to each new card.
     */
    populateCards() {
        let cardIndex = 0;

        const dates = Object.keys(this.groupedTours);

        for (let i = 0; i < dates.length; i++) {
            const guides = Object.keys(this.groupedTours[dates[i]]);

            for (let j = 0; j < guides.length; j++) {
                const tour = this.groupedTours[dates[i]][guides[j]];

                if (cardIndex !== 0) {
                    const cards = this.cardsContainer.querySelectorAll('.schedule-card');
                    const lastCard = cards[cards.length - 1];

                    const clone = lastCard.cloneNode(true);
                    this.cardsContainer.appendChild(clone);
                }

                this.bindDataToCard(tour, cardIndex % 2 !== 0);

                cardIndex++;
            }
        }
    }

    /**
     * Binds the tour data to the last schedule card in the DOM.
     *
     * @param {Array} tour - Array of tour objects for the same guide and day.
     * @param {boolean} left - Whether the guide image should appear on the left side.
     */
    bindDataToCard(tour, left = false) {
        const cards = this.cardsContainer.querySelectorAll('.schedule-card');
        const lastCard = cards[cards.length - 1];

        this.setDate(lastCard, tour[0]);
        this.populateTime(lastCard, tour);
        this.setName(lastCard, tour[0]);
        this.setLanguage(lastCard, tour[0]);
        this.setImage(lastCard, tour[0]);
        this.setDescription(lastCard, tour[0]);
        this.reorderImage(lastCard, left);
        this.disableButton(lastCard);
    }

    /**
     * Places the image on the left or right side of the card.
     *
     * @param card The card element.
     * @param left If the card image should be placed on the left side on the card.
     */
    reorderImage(card, left) {
        const imageContainer = card.querySelector('.guide-image-container');
        const textContainer = card.querySelector('.guide-text-container');
        const dateContainer = card.querySelector('.date-container');
        const bookContainer = card.querySelector('.book-container');

        dateContainer.style.order = 1;
        bookContainer.style.order = 2;

        if (left) {
            textContainer.style.order = 3;
            imageContainer.style.order = 4;
        } else {
            imageContainer.style.order = 3;
            textContainer.style.order = 4;
        }
    }

    /**
     * Disables the booking button in a schedule card by default.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     */
    disableButton(card) {
        const button = card.querySelector('.btn');
        button.disabled = true;
    }

    /**
     * Populates the guide description in the schedule card and sets the CMS input dataset.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     * @param {Object} tour - A single tour object.
     */
    setDescription(card, tour) {
        const description = card.querySelector('.guide-text');
        description.id = `guide-desc-${tour.guide.name}-${tour.date_time.split(' ')[0]}`;
        description.innerHTML = tour.guide.description;

        const input = description.nextElementSibling;
        input.dataset.field_id = description.id;

        this.cms.setContentInputDataset(description.id, 'guide', tour.guide.guide_id, 'description');
    }

    /**
     * Populates the guide image in the schedule card and binds CMS metadata.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     * @param {Object} tour - A single tour object.
     */
    setImage(card, tour) {
        const image = card.querySelector('.guide-image');
        image.src = `/assets/images/${tour.guide.image}`;
        image.id = `guide-image-${tour.guide.name}-${tour.date_time.split(' ')[0]}`;

        const saveButton = image.nextElementSibling;
        saveButton.id = `guide-button-${tour.guide.name}-${tour.date_time}`;

        const input = saveButton.nextElementSibling;
        input.dataset.button = saveButton.id;

        this.cms.setImageInputDataset(saveButton.id, 'guide', tour.guide.guide_id, 'image', image.id);
    }

    /**
     * Sets the language label in the schedule card.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     * @param {Object} tour - A single tour object.
     */
    setLanguage(card, tour) {
        const language = card.querySelector('.language');
        language.innerHTML = tour.guide.language.language;
    }

    /**
     * Sets the guide's name in the schedule card and binds it for CMS editing.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     * @param {Object} tour - A single tour object.
     */
    setName(card, tour) {
        const name = card.querySelector('.guide-name');
        name.id = `guide-name-${tour.guide.name}-${tour.date_time.split(' ')[0]}`;
        name.innerHTML = tour.guide.name;

        const input = name.nextElementSibling;
        input.dataset.field_id = name.id;

        this.cms.setContentInputDataset(name.id, 'guide', tour.guide.guide_id, 'name');
    }

    /**
     * Populates the dropdown with available time options for the tour and enables
     * the booking button when a valid time is selected.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     * @param {Array} tour - Array of tour objects (all same guide and day).
     */
    populateTime(card, tour) {
        const dropdown = card.querySelector('.form-select');
        dropdown.innerHTML = '<option value="" disabled selected>Select a time</option>';

        tour.forEach((item) => {
            const option = document.createElement('option');
            option.value = this.getFormattedTime(new Date(item.date_time));
            option.textContent = option.value;

            dropdown.appendChild(option);
        })

        dropdown.addEventListener('change', () => {
            const button = card.querySelector('.btn');
            button.disabled = card.querySelector('option:checked').value === '';
        })
    }

    /**
     * Returns a formatted time string, e.g. '23:00'.
     *
     * @param date The date object.
     * @returns {string} The formatted time string, e.g. '23:00'.
     */
    getFormattedTime(date) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        return `${hours}:${minutes}`;
    }

    /**
     * Sets the numeric date and weekday into the card based on the tour's date.
     *
     * @param {HTMLElement} card - The schedule card DOM element.
     * @param {Object} tour - A single tour object.
     */
    setDate(card, tour) {
        const date = new Date(tour.date_time);
        const options = {weekday: 'long'};

        const dateElement = card.querySelector('.schedule-date');
        dateElement.innerHTML = date.getDate();

        const dayElement = card.querySelector('.schedule-day-of-week');
        dayElement.innerHTML = date.toLocaleDateString('en-US', options);
    }

    /**
     * Groups the list of tours first by date, and then by guide name.
     *
     * @returns {Object} An object with dates as keys, each containing an object of guide names
     *                   as keys, mapping to arrays of tour objects.
     */
    groupToursByDayAndGuide() {
        const grouped = {};

        this.tours.forEach(tour => {
            const date = tour.date_time.split(' ')[0];
            const guideName = tour.guide.name;

            if (!grouped[date]) {
                grouped[date] = {};
            }

            if (!grouped[date][guideName]) {
                grouped[date][guideName] = [];
            }

            grouped[date][guideName].push(tour);
        });

        return grouped;
    }

    /**
     * Fetches and sets the schedule title and subtitle from the API,
     * and binds them for inline CMS editing.
     */
    async setTitles() {
        const titleElement = document.querySelector('.strolls-schedule-title');
        const title = await fetchFromApi('/api/getCustomByIdentifier/strolls_schedule_title');
        titleElement.innerHTML = title.content;
        this.cms.setContentInputDataset(titleElement.id, 'custom', title.id, 'content');

        const subtitleElement = document.querySelector('.strolls-schedule-subtitle');
        const subtitle = await fetchFromApi('/api/getCustomByIdentifier/strolls_schedule_subtitle');
        subtitleElement.innerHTML = subtitle.content;
        this.cms.setContentInputDataset(subtitleElement.id, 'custom', subtitle.id, 'content');
    }
}