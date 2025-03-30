import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the main section of a location.
 */
export class Location {
    async init() {
        this.cms = await CMS.create();
        this.location = await this.fetchLocation();
        this.descriptions = await fetchFromApi(`/api/getDescriptionsByLocationId/${this.location.id}`);

        this.setTextContent();
    }

    static async create() {
        const instance = new Location();
        await instance.init();
        return instance;
    }

    /**
     * Sets the text content of the location descriptions.
     */
    setTextContent() {
        this.descriptions.forEach((item) => {
            const titleElement = document.getElementById(`location-header-${item.display_order}`);
            const textElement = document.getElementById(`location-text-${item.display_order}`);

            titleElement.innerHTML = item.title.title;
            textElement.innerHTML = item.description;

            this.cms.setContentInputDataset(titleElement.id, 'title', item.title.title_id, 'title');
            this.cms.setContentInputDataset(textElement.id, 'description', item.id, 'description');
        })
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