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

        await Carousel.create();
    }

    static async create() {
        const instance = new RestaurantCard();
        await instance.init();
        return instance;
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
    }

    setPrice(restaurant, restaurantCard) {
        restaurantCard.querySelector('.restaurant-price-full').innerHTML = `${restaurant.full_price}`;
        restaurantCard.querySelector('.restaurant-price').innerHTML = restaurant.adult_price;
    }

    setButtonLink(restaurant, restaurantCard) {
        const button = restaurantCard.querySelector('.restaurant-card-button a');
        button.href = `/yummy/${restaurant.slug}`;
    }

    setDescription(restaurant, restaurantCard) {
        const description = restaurantCard.querySelector('.restaurant-description');
        description.innerHTML = restaurant.card_description;
    }

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

    createStar(colorName) {
        const star = document.createElement('img');
        star.src = `/assets/images/star_${colorName}.svg`;
        star.alt = '';

        return star;
    }

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

            this.bindDataToType(foodType, container);
        }
    }

    bindDataToType(foodType, container) {
        const foodTypes = container.querySelectorAll('.food-type');
        const lastType = foodTypes[foodTypes.length - 1];
        const icon = lastType.querySelector('.food-type-icon');
        const text = lastType.querySelector('.food-type-text');

        lastType.style.backgroundColor = `#${foodType.bg_color}`;
        icon.src = `/assets/images/${foodType.icon}`;
        icon.alt = `${foodType.name} icon`;
        text.innerHTML = foodType.name;
        text.style.color = `#${foodType.text_color}`;
    }

    setName(restaurant, restaurantCard) {
        const name = restaurantCard.querySelector('.restaurant-name');
        name.innerHTML = restaurant.name;
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
        const cmsInput = cmsButton.nextElementSibling;
        cmsButton.id = `${imageOne.id}Button`;
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