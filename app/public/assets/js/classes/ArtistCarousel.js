import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the artist carousel.
 */
export class ArtistCarousel {
    async init() {
        this.cms = await CMS.create();
        this.artist = await this.fetchArtist();

        this.bindImages();
    }

    static async create() {
        const instance = new ArtistCarousel();
        await instance.init();
        return instance;
    }

    bindImages() {
        for (let i = 1; i <= 6; i++) {
            this.setCarouselImage(i);
        }
    }

    setCarouselImage(index) {
        const imageKey = `carousel_image${index}`;
        const imageSrc = `/assets/images/${this.artist[imageKey]}`;

        const imageOne = document.getElementById(`carouselOneImage${index}`);
        const imageThree = document.getElementById(`carouselThreeImage${index}`);

        imageOne.src = imageSrc;
        imageThree.src = imageSrc;

        this.cms.setImageInputDataset(`carouselOneImage${index}Button`, 'artist', this.artist.id, imageKey, imageOne.id);
        this.cms.setImageInputDataset(`carouselThreeImage${index}Button`, 'artist', this.artist.id, imageKey, imageThree.id);
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