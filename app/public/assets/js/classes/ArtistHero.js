import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the hero section of an artist.
 */
export class ArtistHero {
    async init() {
        this.cms = await CMS.create();
        this.artist = await this.fetchArtist();

        this.setBgColor();
        this.setHeroImage();
        this.setHeroShape();
        await this.setContent();
    }

    static async create() {
        const instance = new ArtistHero();
        await instance.init();
        return instance;
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
     * Sets content of the hero section based on the artist.
     */
    async setContent() {
        const heroTitle = document.getElementById("hero-title");
        const heroSubtitle = document.getElementById("hero-subtitle");
        const heroText = document.getElementById("hero-text");

        heroTitle.innerHTML = this.artist.stage_name;
        heroSubtitle.innerHTML = this.artist.genre;
        heroText.innerHTML = this.artist.hero_description;

        this.cms.setContentInputDataset(heroTitle.id, 'artist', this.artist.id, 'stage_name');
        this.cms.setContentInputDataset(heroSubtitle.id, 'artist', this.artist.id, 'genre');
        this.cms.setContentInputDataset(heroText.id, 'artist', this.artist.id, 'hero_description');

        heroSubtitle.classList.remove('h4', 'fw-bold');
        heroSubtitle.classList.add('h5');

        const buyTicketsButton = await fetchFromApi(`/api/getButtonById/13`);
        const button = this.cms.createButton(buyTicketsButton, 'btn btn-primary-red font-p-16 fw-bold');

        this.appendToHeroContent(button);

        button.addEventListener('click', () => {
            document.getElementById("artistSchedule").scrollIntoView({behavior: "smooth"});
        })
    }

    /**
     * Sets the hero shape of the DANCE! event.
     */
    setHeroShape() {
        const heroShape = document.getElementById("heroShape");
        heroShape.style.backgroundImage = `url('/assets/images/dance_shape.svg')`;
    }

    /**
     * Sets the hero image based on the artist.
     */
    setHeroImage() {
        const heroImage = document.getElementById("heroImage");
        heroImage.src = `/assets/images/${this.artist.image}`;
        this.cms.setImageInputDataset("heroImageButton", 'artist', `${this.artist.id}`, 'image', heroImage.id);
    }

    /**
     * Sets the background color of the hero section.
     */
    setBgColor() {
        const heroSection = document.getElementById("heroSection");
        heroSection.style.backgroundColor = '#6A7AB3';
    }

    /**
     * Fetches the artist from the API.
     *
     * @returns {Promise<Object>} The artist object.
     */
    async fetchArtist() {
        let pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments[pathSegments.length - 1];

        return await fetchFromApi(`/api/getArtistBySlug/${slug}`);
    }
}