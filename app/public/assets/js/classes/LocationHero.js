import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the hero section of a location.
 */
export class LocationHero {
    async init() {
        this.cms = await CMS.create();
        this.location = await this.fetchLocation();

        this.setBgColor();
        this.setHeroImage();
        this.setHeroShape();
        await this.setContent();
    }

    static async create() {
        const instance = new LocationHero();
        await instance.init();
        return instance;
    }

    /**
     * Sets content of the hero section based on the location.
     */
    async setContent() {
        const heroTitle = document.getElementById("hero-title");
        const heroSubtitle = document.getElementById("hero-subtitle");
        const heroText = document.getElementById("hero-text");

        const anchor = document.createElement('a');

        let searchParameter = this.location.name.replace(' ', '+');
        searchParameter += '+haarlem';
        anchor.href = `https://www.google.com/maps/search/?api=1&query=${searchParameter}`;
        anchor.target = "_blank";
        anchor.innerHTML = this.location.address;
        heroSubtitle.appendChild(anchor);

        heroTitle.innerHTML = this.location.name;
        heroText.innerHTML = this.location.description;

        this.cms.setContentInputDataset(heroTitle.id, 'location', this.location.id, 'name');
        this.cms.setContentInputDataset(heroSubtitle.id, 'location', this.location.id, 'address');
        this.cms.setContentInputDataset(heroText.id, 'location', this.location.id, 'description');

        heroSubtitle.classList.remove('h4', 'fw-bold');
        heroSubtitle.classList.add('location-address', 'h6');
    }

    /**
     * Sets the hero shape of the History Strolls event.
     */
    setHeroShape() {
        const heroShape = document.getElementById("heroShape");
        heroShape.style.backgroundImage = `url('/assets/images/history_strolls_shape.svg')`;
    }

    /**
     * Sets the hero image based on the location.
     */
    setHeroImage() {
        const heroImage = document.getElementById("heroImage");
        heroImage.src = `/assets/images/${this.location.image}`;
        const button = heroImage.nextElementSibling;
        this.cms.setImageInputDataset(button.id, 'location', `${this.location.id}`, 'image', heroImage.id);
    }

    /**
     * Sets the background color of the hero section.
     */
    setBgColor() {
        const heroSection = document.getElementById("heroSection");
        heroSection.style.backgroundColor = '#D43D25';
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