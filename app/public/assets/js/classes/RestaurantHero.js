import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

const MAX_STARS = 5;

/**
 * Class that handles the hero section of a restaurant.
 */
export class RestaurantHero {
    async init() {
        this.cms = await CMS.create();
        this.restaurant = await this.fetchRestaurant();

        this.setBgColor();
        this.setHeroImage();
        this.setHeroShape();
        await this.setContent();
    }

    static async create() {
        const instance = new RestaurantHero();
        await instance.init();
        return instance;
    }

    /**
     * Sets content of the hero section based on the restaurant.
     */
    async setContent() {
        this.setName();
        this.setMichelin();
        this.populateFoodTypes();
        this.setAddress();
        this.setStars();
        this.setDescription();
    }

    /**
     * Populates the restaurant hero's description text.
     */
    setDescription() {
        const description = document.getElementById('heroRestaurantDescription');
        description.innerHTML = this.restaurant.description;
        this.cms.setContentInputDataset(description.id, 'restaurant', this.restaurant.id, 'description');
    }

    /**
     * Renders visual star rating using images based on `restaurant.stars`.
     */
    setStars() {
        const starsContainer = document.querySelector('.restaurant-stars');
        starsContainer.innerHTML = '';
        const starsAmount = this.restaurant.stars;

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
     */
    setAddress() {
        const address = document.querySelector('.hero-restaurant-address a');

        let searchParameter = this.restaurant.name.replace(' ', '+');
        searchParameter += '+haarlem';

        address.href = `https://www.google.com/maps/search/?api=1&query=${searchParameter}`;
        address.innerHTML = this.restaurant.address;
    }

    /**
     * Dynamically populates the food types.
     */
    populateFoodTypes() {
        const container = document.querySelector('.food-types');

        for (let i = 0; i < this.restaurant.food_types.length; i++) {
            const foodType = this.restaurant.food_types[i];

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
     * Adjusts the Michelin badge display based on the restaurant's Michelin status.
     *
     * - Hides the icon if the value is 'Nominated'.
     * - Completely hides the container if no Michelin info exists.
     */
    setMichelin() {
        const michelin = this.restaurant.michelin;

        if (michelin) {
            if (michelin === 'Nominated') {
                document.querySelector('.michelin-icon').style.display = 'none';
            }
        } else {
            const michelinContainer = document.querySelector('.michelin');
            michelinContainer.classList.remove('d-flex');
            michelinContainer.classList.add('d-none');
        }
    }

    /**
     * Sets the restaurant name inside the hero and binds it to a CMS content input for inline editing.
     */
    setName() {
        const heroTitle = document.getElementById("heroRestaurantName");
        heroTitle.innerHTML = this.restaurant.name;
        this.cms.setContentInputDataset(heroTitle.id, 'restaurant', this.restaurant.id, 'name');
    }

    /**
     * Sets the hero shape of the DANCE! event.
     */
    setHeroShape() {
        const heroShape = document.getElementById("heroShape");
        heroShape.style.backgroundImage = `url('/assets/images/yummy_shape.svg')`;
    }

    /**
     * Sets the hero image based on the restaurant.
     */
    setHeroImage() {
        const heroImage = document.getElementById("heroImage");
        heroImage.src = `/assets/images/${this.restaurant.image}`;
        this.cms.setImageInputDataset("heroImageButton", 'restaurant', `${this.restaurant.id}`, 'image', heroImage.id);
    }

    /**
     * Sets the background color of the hero section.
     */
    setBgColor() {
        const heroSection = document.getElementById("heroSection");
        heroSection.style.backgroundColor = '#E66B5B';
    }

    /**
     * Fetches the restaurant from the API.
     *
     * @returns {Promise<Object>} The restaurant object.
     */
    async fetchRestaurant() {
        const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments[pathSegments.length - 1];

        return await fetchFromApi(`/api/getRestaurantBySlug/${slug}`);
    }
}