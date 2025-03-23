import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the restaurants.
 */
export class Restaurant {
    async init() {
        this.cms = await CMS.create();
        this.restaurants = await fetchFromApi('/api/getRestaurants');
        this.restaurantCardsContainer = document.getElementById('restaurantCards');

        await this.populateCards();
    }

    static async create() {
        const instance = new Restaurant();
        await instance.init();
        return instance;
    }

    /**
     * Populates the restaurant cards with data from the API.
     */
    async populateCards() {

    }
}