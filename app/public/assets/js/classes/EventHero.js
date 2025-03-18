import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

export class EventHero {
    constructor() {
        this.init();
    }

    async init() {
        this.cms = new CMS();

        // Get the slug from the current URL
        let pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        if (pathSegments.length === 0) {
            this.event = await fetchFromApi(`/api/getEventById/1`);
        } else {
            const slug = pathSegments[pathSegments.length - 1];
            this.event = await fetchFromApi(`/api/getEventBySlug/${slug}`);
        }

        const bgColors = {
            'dance': '#6A7AB3',
            'strolls': '#D43D25',
            'teylers': '#00796B',
            'yummy': '#E66B5B'
        };

        this.heroSection = document.getElementById("heroSection");
        this.heroSection.style.backgroundColor = bgColors[this.event.slug];

        this.heroImage = document.getElementById("heroImage");
        this.heroImage.src = `/assets/images/${this.event.image}`;

        this.cms.setImageInputDataset("heroImageButton", 'event', `${this.event.id}`, 'image', `${this.heroImage.id}`);

        this.heroShape = document.getElementById("heroShape");
        this.heroShape.style.backgroundImage = `url('/assets/images/${this.event.shape}')`;
    }
}