import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the hero section of the events.
 */
export class EventHero {
    constructor() {
        this.init();
    }

    async init() {
        this.cms = new CMS();
        this.event = await this.fetchEvent();

        this.setBgColor();
        this.setHeroImage();
        this.setHeroShape();
        this.setCommonContent();
        await this.setSpecialContent();
    }

    /**
     * Sets the special content of the hero section based on the event.
     *
     * @returns {Promise<void>}
     */
    async setSpecialContent() {
        const contentSetters = {
            dance: this.setDanceContent,
            strolls: this.setStrollsContent,
            teylers: this.setTeylersContent
        };

        if (this.event.slug in contentSetters) {
            await contentSetters[this.event.slug].call(this);
        }
    }

    /**
     * Sets the hero content for the Magic@Teylers event.
     *
     * @returns {Promise<void>} A promise that resolves when the content is set.
     */
    async setTeylersContent() {
        const appPromotionTitle = await fetchFromApi(`/api/getCustomByIdentifier/app_promotion_title`);
        const appPromotionSubtitle = await fetchFromApi(`/api/getCustomByIdentifier/app_promotion_subtitle`);

        const promotionTitle = document.getElementById("appPromotionTitle");
        const promotionSubtitle = document.getElementById("appPromotionSubtitle");

        promotionTitle.innerHTML = appPromotionTitle.content;
        promotionSubtitle.innerHTML = appPromotionSubtitle.content;

        const appPromotionHero = document.getElementById("appPromotionHero");
        appPromotionHero.style.display = "block";

        this.cms.setContentInputDataset(promotionTitle.id, 'custom', appPromotionTitle.id, 'content');
        this.cms.setContentInputDataset(promotionSubtitle.id, 'custom', appPromotionSubtitle.id, 'content');
    }

    /**
     * Appends an element to the hero content.
     *
     * @param element The element to append.
     */
    appendToHeroContent(element) {
        const heroContent = document.querySelector('.hero-content');
        heroContent.appendChild(element);
    }

    /**
     * Sets the hero content for the History Strolls event.
     *
     * @returns {Promise<void>} A promise that resolves when the content is set.
     */
    async setStrollsContent() {
        const buyTicketsButton = await fetchFromApi(`/api/getButtonById/6`);
        const button = this.cms.createButton(buyTicketsButton, 'btn btn-primary font-p-16 fw-bold');
        this.appendToHeroContent(button);
    }

    /**
     * Sets the hero content for the DANCE! event.
     *
     * @returns {Promise<void>} A promise that resolves when the content is set.
     */
    async setDanceContent() {
        const buyPassButton = await fetchFromApi(`/api/getButtonById/5`);
        const button = this.cms.createButton(buyPassButton, 'btn btn-primary-red font-p-16 fw-bold');
        this.appendToHeroContent(button);
    }

    /**
     * Sets the common content of the hero section based on the event.
     */
    setCommonContent() {
        const heroTitle = document.getElementById("hero-title");
        const heroSubtitle = document.getElementById("hero-subtitle");
        const heroText = document.getElementById("hero-text");

        heroTitle.innerHTML = this.event.hero_title;
        heroSubtitle.innerHTML = this.event.hero_subtitle;
        heroText.innerHTML = this.event.hero_description;

        this.cms.setContentInputDataset(heroTitle.id, 'event', this.event.id, 'hero_title');
        this.cms.setContentInputDataset(heroSubtitle.id, 'event', this.event.id, 'hero_subtitle');
        this.cms.setContentInputDataset(heroText.id, 'event', this.event.id, 'hero_description');
    }

    /**
     * Sets the hero shape based on the event.
     */
    setHeroShape() {
        const heroShape = document.getElementById("heroShape");
        heroShape.style.backgroundImage = `url('/assets/images/${this.event.shape}')`;
    }

    /**
     * Sets the hero image based on the event.
     */
    setHeroImage() {
        const heroImage = document.getElementById("heroImage");
        heroImage.src = `/assets/images/${this.event.image}`;
        this.cms.setImageInputDataset("heroImageButton", 'event', `${this.event.id}`, 'image', `${heroImage.id}`);
    }

    /**
     * Sets the background color of the hero section based on the event slug.
     */
    setBgColor() {
        const bgColors = {
            'dance': '#6A7AB3',
            'strolls': '#D43D25',
            'teylers': '#00796B',
            'yummy': '#E66B5B'
        };

        const heroSection = document.getElementById("heroSection");
        heroSection.style.backgroundColor = bgColors[this.event.slug];
    }

    /**
     * Fetches the event from the API.
     *
     * @returns {Promise<Object>} The event object.
     */
    async fetchEvent() {
        let pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments.length ? pathSegments[pathSegments.length - 1] : null;
        const endpoint = slug ? `/api/getEventBySlug/${slug}` : '/api/getEventById/1';

        return await fetchFromApi(endpoint);
    }
}