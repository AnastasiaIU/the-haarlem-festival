import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the promo section of the events.
 */
export class Promo {
    async init() {
        if (window.location.pathname === '/teylers') {
            this.disableForTeylers();
        } else {
            this.cms = await CMS.create();
            this.event = await this.fetchEvent();

            this.setContent();
        }
    }

    static async create() {
        const instance = new Promo();
        await instance.init();
        return instance;
    }

    /**
     * Fetches the event from the API.
     *
     * @returns {Promise<Object>} The event object.
     */
    async fetchEvent() {
        const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments.length ? pathSegments[pathSegments.length - 1] : null;
        const endpoint = slug ? `/api/getEventBySlug/${slug}` : '/api/getEventById/1';

        return await fetchFromApi(endpoint);
    }

    /**
     * Sets the content of the promo section based on the event.
     */
    setContent() {
        const title = document.getElementById("promo-title");
        const subtitle = document.getElementById("promo-subtitle");

        title.innerHTML = this.event.title;
        subtitle.innerHTML = this.event.subtitle;

        this.cms.setContentInputDataset(title.id, 'event', this.event.id, 'title');
        this.cms.setContentInputDataset(subtitle.id, 'event', this.event.id, 'subtitle');
    }

    /**
     * Disables the promo section for the Teylers event.
     */
    disableForTeylers() {
        const promoSection = document.getElementById("promoSection");
        promoSection.style.display = 'none';
    }
}