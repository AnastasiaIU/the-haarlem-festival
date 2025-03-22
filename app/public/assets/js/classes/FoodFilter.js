import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the food filters of the Yummy! event.
 */
export class FoodFilter {
    async init() {
        this.cms = await CMS.create();
        this.filters = await fetchFromApi('/api/getFoodTypes');

        await this.setFiltersPrompt();
        await this.populateFoodFilters();
    }

    static async create() {
        const instance = new FoodFilter();
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
    async bindDataToFilter(filter, container) {
        const filterElements = container.querySelectorAll('.food-filter-disabled');
        const lastFilter = filterElements[filterElements.length - 1];
        const icon = lastFilter.querySelector('.filter-icon');
        const text = lastFilter.querySelector('.filter-text');

        icon.src = `/assets/images/${filter.icon}`;
        text.innerHTML = filter.name;
    }

    /**
     * Dynamically populates the food filter UI with available filter data.
     */
    async populateFoodFilters() {
        for (let i = 0; i < this.filters.length; i++) {
            const filter = this.filters[i];
            const container = document.getElementById('foodTypes');

            if (i !== 0) {
                const filterElements = container.querySelectorAll('.food-filter-disabled');
                const lastFilter = filterElements[filterElements.length - 1];
                const clone = lastFilter.cloneNode(true);
                container.appendChild(clone);
            }

            await this.bindDataToFilter(filter, container);
        }
    }
}