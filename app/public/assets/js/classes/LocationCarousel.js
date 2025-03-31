import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";
import {Carousel} from "./Carousel.js";

/**
 * Class that handles the location carousel.
 */
export class LocationCarousel {
    async init() {
        this.cms = await CMS.create();
        this.location = await this.fetchLocation();

        this.bindImages();

        await Carousel.create();
    }

    static async create() {
        const instance = new LocationCarousel();
        await instance.init();
        return instance;
    }

    /**
     * Binds carousel images for the current location.
     */
    bindImages() {
        for (let i = 1; i <= 6; i++) {
            this.setCarouselImage(i);
        }
    }

    /**
     * Sets the image source and CMS bindings for a specific location carousel image.
     *
     * @param {number} index - The numeric index of the image slot (1 to 6).
     */
    setCarouselImage(index) {
        const imageKey = `carousel_image${index}`;
        const imageSrc = `/assets/images/${this.location[imageKey]}`;

        const imageOne = document.getElementById(`carouselOneImage${index}`);
        const imageThree = document.getElementById(`carouselThreeImage${index}`);

        imageOne.src = imageSrc;
        imageThree.src = imageSrc;

        this.cms.setImageInputDataset(`carouselOneImage${index}Button`, 'location', this.location.id, imageKey, imageOne.id);
        this.cms.setImageInputDataset(`carouselThreeImage${index}Button`, 'location', this.location.id, imageKey, imageThree.id);
    }

    /**
     * Fetches the location from the API.
     *
     * @returns {Promise<Object>} The location object.
     */
    async fetchLocation() {
        const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments[pathSegments.length - 1];

        return await fetchFromApi(`/api/getLocationBySlug/${slug}`);
    }
}