import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";
import {Carousel} from "./Carousel.js";

/**
 * Class that handles the restaurants.
 */
export class Restaurant {
    async init() {
        this.cms = await CMS.create();
        this.filters = await fetchFromApi('/api/getFoodTypes');
        this.restaurants = await fetchFromApi('/api/getRestaurants');
        this.restaurantCardsContainer = document.getElementById('restaurantCards');

        await Carousel.create();
    }

    static async create() {
        const instance = new Restaurant();
        await instance.init();
        return instance;
    }
}