import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";
import {Carousel} from "./Carousel.js";

const MAX_STARS = 5;

/**
 * Class that handles the restaurant cards.
 */
export class RestaurantCard {
    async init() {
        this.cms = await CMS.create();
        this.filters = await fetchFromApi('/api/getFoodTypes');
        this.restaurants = await fetchFromApi('/api/getRestaurants');
        this.restaurantCardsContainer = document.getElementById('restaurantCards');

        await this.setFiltersPrompt();
        this.populateFoodFilters();
        this.populateCards();
        this.enableFiltering();

        await Carousel.create();
        await this.cms.initTinyMce('.tinymce-restaurant-card', '.change-image-restaurant-card', '.tinymce-form-restaurant-card');
    }

    static async create() {
        const instance = new RestaurantCard();
        await instance.init();
        return instance;
    }

    /**
     * Enables filtering by attaching click event listeners to all filter buttons.
     * When a filter is clicked, it toggles active state and filters restaurant cards accordingly.
     */
    enableFiltering() {
        const filters = document.querySelectorAll('.food-filter-disabled');
        filters.forEach((filter) => {
            filter.addEventListener('click', event => this.toggleFilter(event.currentTarget, filters));
        });
    }

    /**
     * Toggles a filter's active state and updates the visibility of restaurant cards.
     * Only one filter can be enabled at a time. Re-clicking an active filter resets all filters.
     *
     * @param {HTMLElement} clickedFilter - The filter button that was clicked.
     * @param {NodeList} filters - All filter buttons in the filter group.
     */
    toggleFilter(clickedFilter, filters) {
        const cards = this.restaurantCardsContainer.querySelectorAll('.restaurant-card');
        const filterName = clickedFilter.querySelector('.filter-text').innerHTML;

        const isCurrentlyEnabled = clickedFilter.classList.contains('food-filter-enabled');

        // Reset all filters to disabled
        filters.forEach(filter => {
            if (filter.classList.contains('food-filter-enabled')) {
                filter.classList.remove('food-filter-enabled');
            }
            if (!filter.classList.contains('food-filter-disabled')) {
                filter.classList.add('food-filter-disabled');
            }

            const text = filter.querySelector('.filter-text');
            filter.style.backgroundColor = 'transparent';
            text.style.color = '#41479B';
        });

        // If clicked filter was already active, show all cards
        if (isCurrentlyEnabled) {
            cards.forEach((card, i) => {
                this.setImageOrder(card, i % 2 !== 0);
                this.setPriceOrder(card, i % 2 !== 0);
                card.style.display = 'flex';
            });
            return;
        }

        // Enable the clicked filter
        clickedFilter.classList.remove('food-filter-disabled');
        clickedFilter.classList.add('food-filter-enabled');
        const clickedFilterName = clickedFilter.querySelector('.filter-text').innerHTML;
        const selectedFilter = this.filters.find(filter => filter.name === clickedFilterName);
        this.setFilterColor(selectedFilter, clickedFilter);

        // Filter restaurant cards based on selected food type
        let i = 0;
        cards.forEach(card => {
            const foodTypes = [...card.querySelectorAll('.food-type-text')].map(el => el.innerHTML);
            if (foodTypes.includes(filterName)) {
                this.setImageOrder(card, i % 2 !== 0);
                this.setPriceOrder(card, i % 2 !== 0);
                ++i;
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    /**
     * Applies background and text color styling to an active filter element.
     *
     * @param {Object} foodType - An object containing `bg_color` and `text_color` properties.
     * @param {HTMLElement} element - The filter button to apply styles to.
     */
    setFilterColor(foodType, element) {
        const text = element.querySelector('.filter-text');

        element.style.backgroundColor = `#${foodType.bg_color}`;
        text.style.color = `#${foodType.text_color}`;
    }

    /**
     * Fetches the custom filter prompt content from the API and updates the DOM.
     */
    async setFiltersPrompt() {
        const prompt = await fetchFromApi('/api/getCustomByIdentifier/filters_prompt');

        const filtersPrompt = document.getElementById('filter-prompt');
        filtersPrompt.innerHTML = prompt.content;

        this.cms.setContentInputDataset(filtersPrompt.id, 'custom', prompt.id, 'content');
    }

    /**
     * Binds filter data (icon and name) to the latest filter element inside a container.
     *
     * @param {Object} filter - The filter object containing icon and name.
     * @param {HTMLElement} container - The DOM element that contains the filter elements.
     */
    bindDataToFilter(filter, container) {
        const filterElements = container.querySelectorAll('.food-filter-disabled');
        const lastFilter = filterElements[filterElements.length - 1];
        const icon = lastFilter.querySelector('.filter-icon');
        const text = lastFilter.querySelector('.filter-text');

        icon.src = `/assets/images/${filter.icon}`;
        icon.alt = `${filter.name} icon`;
        text.innerHTML = filter.name;
    }

    /**
     * Dynamically populates the food filter UI with available filter data.
     */
    populateFoodFilters() {
        for (let i = 0; i < this.filters.length; i++) {
            const filter = this.filters[i];
            const container = document.getElementById('foodTypes');

            if (i !== 0) {
                const filterElements = container.querySelectorAll('.food-filter-disabled');
                const lastFilter = filterElements[filterElements.length - 1];
                const clone = lastFilter.cloneNode(true);
                container.appendChild(clone);
            }

            this.bindDataToFilter(filter, container);
        }
    }

    /**
     * Populates the restaurant cards with data from the API.
     */
    populateCards() {
        for (let i = 0; i < this.restaurants.length; i++) {
            const restaurant = this.restaurants[i];

            if (i !== 0) {
                const restaurantCards = this.restaurantCardsContainer.querySelectorAll('.restaurant-card');
                const lastRestaurantCard = restaurantCards[restaurantCards.length - 1];
                const clone = lastRestaurantCard.cloneNode(true);
                this.restaurantCardsContainer.appendChild(clone);
            }

            this.bindDataToRestaurantCard(restaurant, i % 2 !== 0);
        }
    }

    /**
     * Binds all restaurant data to the last `.restaurant-card` element inside the container.
     * This includes carousel setup, restaurant name, description, pricing, stars, and metadata.
     *
     * @param {Object} restaurant - The restaurant object containing data like slug, name, prices, etc.
     * @param {boolean} left - Determines whether the card layout should be reversed (for alternating card layouts).
     */
    bindDataToRestaurantCard(restaurant, left) {
        const restaurantCards = this.restaurantCardsContainer.querySelectorAll('.restaurant-card');
        const restaurantCard = restaurantCards[restaurantCards.length - 1];

        const carousel = restaurantCard.querySelector(`div[id*="carousel"]`);
        carousel.id = `carousel_${restaurant.slug}`;
        const buttons = carousel.querySelectorAll(`button[class*="carousel-control"]`);
        buttons.forEach((button) => {
            button.dataset.bsTarget = `#${carousel.id}`;
        })

        this.setImages(restaurant, carousel);
        this.setImageOrder(restaurantCard, left);
        this.setName(restaurant, restaurantCard);
        this.setMichelin(restaurant, restaurantCard);
        this.populateFoodTypes(restaurant, restaurantCard);
        this.setAddress(restaurant, restaurantCard);
        this.setStars(restaurant, restaurantCard);
        this.setDescription(restaurant, restaurantCard);
        this.setButtonLink(restaurant, restaurantCard);
        this.setPrice(restaurant, restaurantCard);
        this.setPriceOrder(restaurantCard, left);
    }

    /**
     * Applies conditional ordering to the price container in a restaurant card
     * to support alternating card layouts.
     *
     * @param {HTMLElement} restaurantCard - The restaurant card element to update.
     * @param {boolean} left - Whether to reverse the flex layout (true) or reset it (false).
     */
    setPriceOrder(restaurantCard, left) {
        if (left) {
            const priceContainer = restaurantCard.querySelector('.restaurant-bottom-container');
            priceContainer.classList.add('flex-row-reverse', 'justify-self-end');
        } else {
            const priceContainer = restaurantCard.querySelector('.restaurant-bottom-container');

            if (priceContainer.classList.contains('flex-row-reverse')) {
                priceContainer.classList.remove('flex-row-reverse');
            }
            if (priceContainer.classList.contains('justify-self-end')) {
                priceContainer.classList.remove('justify-self-end');
            }
        }
    }

    /**
     * Formats and injects full, adult, and kids pricing into the restaurant card.
     *
     * @param {Object} restaurant - The restaurant object with pricing fields.
     * @param {HTMLElement} restaurantCard - The target card to insert price info into.
     */
    setPrice(restaurant, restaurantCard) {
        const fullPrice = restaurant.full_price.toFixed(2).replace('.', ',');
        const adultPrice = restaurant.adult_price.toFixed(2).replace('.', ',');
        const kidsPrice = restaurant.kids_price.toFixed(2).replace('.', ',');

        restaurantCard.querySelector('.restaurant-price-full').innerHTML = `&nbsp;€${fullPrice}&nbsp;`;
        restaurantCard.querySelector('.restaurant-price').innerHTML = `€${adultPrice} (€${kidsPrice})`;
    }

    /**
     * Sets the "Learn More" or CTA button link based on restaurant slug.
     *
     * @param {Object} restaurant - The restaurant object containing the slug.
     * @param {HTMLElement} restaurantCard - The restaurant card to update.
     */
    setButtonLink(restaurant, restaurantCard) {
        const button = restaurantCard.querySelector('.restaurant-card-button a');
        button.href = `/yummy/${restaurant.slug}`;
    }

    /**
     * Populates the restaurant card's description text.
     *
     * @param {Object} restaurant - The restaurant object with `card_description`.
     * @param {HTMLElement} restaurantCard - The card to receive the description.
     */
    setDescription(restaurant, restaurantCard) {
        const description = restaurantCard.querySelector('.restaurant-description');
        description.innerHTML = restaurant.card_description;
        description.id = `restaurantDescription_${restaurant.slug}`;
        description.nextElementSibling.dataset.field_id = description.id;
        this.cms.setContentInputDataset(description.id, 'restaurant', restaurant.id, 'card_description');
    }

    /**
     * Adjusts the Michelin badge display based on the restaurant's Michelin status.
     *
     * - Hides the icon if the value is 'Nominated'.
     * - Completely hides the container if no Michelin info exists.
     *
     * @param {Object} restaurant - The restaurant object containing a `michelin` field.
     * @param {HTMLElement} restaurantCard - The card where the Michelin info will be applied.
     */
    setMichelin(restaurant, restaurantCard) {
        const michelin = restaurant.michelin;

        if (michelin) {
            if (michelin === 'Nominated') {
                restaurantCard.querySelector('.michelin-icon').style.display = 'none';
            }
        } else {
            const michelinContainer = restaurantCard.querySelector('.michelin');
            michelinContainer.classList.remove('d-flex');
            michelinContainer.classList.add('d-none');
        }
    }

    /**
     * Renders visual star rating using images based on `restaurant.stars`.
     *
     * @param {Object} restaurant - The restaurant object with a numeric `stars` field.
     * @param {HTMLElement} restaurantCard - The card where stars are appended.
     */
    setStars(restaurant, restaurantCard) {
        const starsContainer = restaurantCard.querySelector('.restaurant-stars');
        starsContainer.innerHTML = '';
        const starsAmount = restaurant.stars;

        for (let i = 0; i < starsAmount; i++) {
            const rufousStar = this.createStar('rufous');
            starsContainer.appendChild(rufousStar);
        }

        for (let i = 0; i < MAX_STARS - starsAmount; i++) {
            const grayStar = this.createStar('gray');
            starsContainer.appendChild(grayStar);
        }
    }

    /**
     * Creates a star icon element.
     *
     * @param {string} colorName - The color of the star ('rufous' or 'gray').
     * @returns {HTMLImageElement} - The created <img> star element.
     */
    createStar(colorName) {
        const star = document.createElement('img');
        star.src = `/assets/images/star_${colorName}.svg`;
        star.alt = '';

        return star;
    }

    /**
     * Sets the clickable Google Maps link and visible address in the card.
     * The map link uses restaurant name + "haarlem" as search terms.
     *
     * @param {Object} restaurant - The restaurant object with name and address.
     * @param {HTMLElement} restaurantCard - The card to update.
     */
    setAddress(restaurant, restaurantCard) {
        const address = restaurantCard.querySelector('.restaurant-address a');

        let searchParameter = restaurant.name.replace(' ', '+');
        searchParameter += '+haarlem';

        address.href = `https://www.google.com/maps/search/?api=1&query=${searchParameter}`;
        address.innerHTML = restaurant.address;
    }

    /**
     * Dynamically populates the food types.
     */
    populateFoodTypes(restaurant, restaurantCard) {
        const container = restaurantCard.querySelector('.food-types');
        const foodTypes = container.querySelectorAll('.food-type');

        for (let i = 1; i < foodTypes.length; i++) {
            container.removeChild(container.lastChild);
        }

        for (let i = 0; i < restaurant.food_types.length; i++) {
            const foodType = restaurant.food_types[i];

            if (i !== 0) {
                const foodTypes = container.querySelectorAll('.food-type');
                const lastType = foodTypes[foodTypes.length - 1];
                const clone = lastType.cloneNode(true);
                container.appendChild(clone);
            }

            const foodTypes = container.querySelectorAll('.food-type');
            const lastType = foodTypes[foodTypes.length - 1];
            this.bindDataToType(foodType, lastType);
        }
    }

    /**
     * Binds a food type's visual data (icon, name, and colors) to a given DOM element.
     *
     * @param {Object} foodType - The food type object.
     * @param {HTMLElement} element - The DOM element representing a single food type badge or tag.
     */
    bindDataToType(foodType, element) {
        const icon = element.querySelector('.food-type-icon');
        const text = element.querySelector('.food-type-text');

        element.style.backgroundColor = `#${foodType.bg_color}`;
        icon.src = `/assets/images/${foodType.icon}`;
        icon.alt = `${foodType.name} icon`;
        text.innerHTML = foodType.name;
        text.style.color = `#${foodType.text_color}`;
    }

    /**
     * Sets the restaurant name inside a card and binds it to a CMS content input for inline editing.
     *
     * @param {Object} restaurant - The restaurant object.
     * @param {HTMLElement} restaurantCard - The DOM element representing the restaurant card.
     */
    setName(restaurant, restaurantCard) {
        const name = restaurantCard.querySelector('.restaurant-name');
        name.innerHTML = restaurant.name;
        name.id = `restaurantName_${restaurant.slug}`;
        name.nextElementSibling.dataset.field_id = name.id;

        this.cms.setContentInputDataset(name.id, 'restaurant', restaurant.id, 'name');
    }

    /**
     * Sets carousel images for the current restaurant.
     */
    setImages(restaurant, carousel) {
        for (let i = 1; i <= 6; i++) {
            this.setCarouselImage(carousel, restaurant, i);
        }
    }

    /**
     * Sets the image source and CMS bindings for a specific restaurant carousel image.
     *
     * @param carousel - The carousel container element.
     * @param {object} restaurant - The restaurant object.
     * @param {number} index - The numeric index of the image slot (1 to 6).
     */
    setCarouselImage(carousel, restaurant, index) {
        const imageKey = `carousel_image${index}`;
        const imageSrc = `/assets/images/${restaurant[imageKey]}`;

        const imageOne = carousel.querySelector(`img[id*="carouselOneImage${index}"]`);
        imageOne.id = `carouselOneImage${index}_${restaurant.slug}`;
        imageOne.src = imageSrc;

        const cmsButton = imageOne.nextElementSibling;
        cmsButton.id = `${imageOne.id}Button`;
        cmsButton.classList.remove('change-image');
        cmsButton.classList.add('change-image-restaurant-card');

        const cmsInput = cmsButton.nextElementSibling;
        cmsInput.dataset.button = cmsButton.id;

        this.cms.setImageInputDataset(cmsButton.id, 'restaurant', restaurant.id, imageKey, imageOne.id);
    }

    /**
     * Sets the visual order of image and text containers inside a restaurant card.
     *
     * @param {HTMLElement} card - The restaurant card container element.
     * @param {boolean} left - Determines the layout direction. If true, image is placed on the left.
     */
    setImageOrder(card, left) {
        const imageContainer = card.querySelector('.restaurant-card-text');
        const textContainer = card.querySelector('.restaurant-card-img');

        if (left) {
            textContainer.style.order = 1;
            imageContainer.style.order = 2;
        } else {
            imageContainer.style.order = 1;
            textContainer.style.order = 2;
        }
    }
}