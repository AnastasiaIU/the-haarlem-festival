import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";
import {Carousel} from "./Carousel.js";

/**
 * Class that handles the restaurant carousel.
 */
export class RestaurantCarousel {
    async init() {
        this.cms = await CMS.create();
        this.restaurant = await this.fetchRestaurant();

        this.bindImages();

        await Carousel.create();
    }

    static async create() {
        const instance = new RestaurantCarousel();
        await instance.init();
        return instance;
    }

    /**
     * Binds carousel images for the current restaurant.
     */
    bindImages() {
        for (let i = 1; i <= 6; i++) {
            this.setCarouselImage(i);
        }
    }

    /**
     * Sets the image source and CMS bindings for a specific restaurant carousel image.
     *
     * @param {number} index - The numeric index of the image slot (1 to 6).
     */
    setCarouselImage(index) {
        const imageKey = `carousel_image${index}`;
        const imageSrc = `/assets/images/${this.restaurant[imageKey]}`;

        const imageOne = document.getElementById(`carouselOneImage${index}`);
        const imageThree = document.getElementById(`carouselThreeImage${index}`);

        imageOne.src = imageSrc;
        imageThree.src = imageSrc;

        this.cms.setImageInputDataset(`carouselOneImage${index}Button`, 'restaurant', this.restaurant.id, imageKey, imageOne.id);
        this.cms.setImageInputDataset(`carouselThreeImage${index}Button`, 'restaurant', this.restaurant.id, imageKey, imageThree.id);
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