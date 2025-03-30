import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the Magic@Teylers event.
 */
export class Teylers {
    async init() {
        this.cms = await CMS.create();

        await this.setLorentzBackground();
        await this.setLorentzText();
        this.setLorentzButton();
        await this.setAppPromotion();
        this.setTeylerButton();
    }

    static async create() {
        const instance = new Teylers();
        await instance.init();
        return instance;
    }

    /**
     * Loads and populates the app promotion section and the Teyler Museum content
     * with dynamic data fetched from the API. It sets the content of text and image
     * elements and binds editing metadata using CMS methods.
     */
    async setAppPromotion() {
        const appDiscoverTitleElement = document.getElementById('discoverAppTitle');
        const appScanTitleElement = document.getElementById('scanAppTitle');
        const appPromotionDescriptionElement = document.getElementById('discoverAppDescription');
        const appPromotionImage1Element = document.getElementById('appPromotionImage1');
        const appPromotionImage2Element = document.getElementById('appPromotionImage2');
        const teylerTitleElement = document.getElementById('teylerTitle');
        const teylerDescriptionElement = document.getElementById('teylerDescription');

        const appDiscoverTitle = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_title_2');
        const appScanTitle = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_title_3');
        const appPromotionDescription = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_description');
        const appPromotionImage1 = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_image_1');
        const appPromotionImage2 = await fetchFromApi('/api/getCustomByIdentifier/app_promotion_image_2');
        const teylerTitle = await fetchFromApi('/api/getCustomByIdentifier/teyler_title');
        const teylerDescription = await fetchFromApi('/api/getCustomByIdentifier/teyler_description');

        appDiscoverTitleElement.innerHTML = appDiscoverTitle.content;
        appScanTitleElement.innerHTML = appScanTitle.content;
        appPromotionDescriptionElement.innerHTML = appPromotionDescription.content;
        appPromotionImage1Element.src = `/assets/images/${appPromotionImage1.content}`;
        appPromotionImage2Element.src = `/assets/images/${appPromotionImage2.content}`;
        teylerTitleElement.innerHTML = teylerTitle.content;
        teylerDescriptionElement.innerHTML = teylerDescription.content;

        const changeButton1 = appPromotionImage1Element.nextElementSibling;
        const changeButton2 = appPromotionImage2Element.nextElementSibling;

        this.cms.setImageInputDataset(changeButton1.id, 'custom', `${appPromotionImage1.id}`, 'content', appPromotionImage1Element.id);
        this.cms.setImageInputDataset(changeButton2.id, 'custom', `${appPromotionImage2.id}`, 'content', appPromotionImage2Element.id);
        this.cms.setContentInputDataset(appDiscoverTitleElement.id, 'custom', appDiscoverTitle.id, 'content');
        this.cms.setContentInputDataset(appScanTitleElement.id, 'custom', appScanTitle.id, 'content');
        this.cms.setContentInputDataset(appPromotionDescriptionElement.id, 'custom', appPromotionDescription.id, 'content');
        this.cms.setContentInputDataset(teylerTitleElement.id, 'custom', teylerTitle.id, 'content');
        this.cms.setContentInputDataset(teylerDescriptionElement.id, 'custom', teylerDescription.id, 'content');
    }

    /**
     * Enables or disables the Teyler booking button based on the selected date.
     * If no date is selected, the button is disabled.
     */
    setTeylerButton() {
        const button = document.getElementById('teylerButton');
        const date = document.getElementById('teylerDate');

        date.addEventListener('change', () => {
            button.disabled = (date.querySelector('option:checked').value === '');
        })
    }

    /**
     * Enables or disables the Lorentz booking button based on whether both a date
     * and a time have been selected.
     */
    setLorentzButton() {
        const button = document.getElementById('lorentzButton');
        const time = document.getElementById('lorentzTime');
        const date = document.getElementById('lorentzDate');

        time.addEventListener('change', () => {
            button.disabled = (time.querySelector('option:checked').value === '' ||
                date.querySelector('option:checked').value === '');
        })

        date.addEventListener('change', () => {
            button.disabled = (time.querySelector('option:checked').value === '' ||
                date.querySelector('option:checked').value === '');
        })
    }

    /**
     * Fetches and populates the Lorentz title, subtitle, and description
     * from the API and sets them into the DOM.
     */
    async setLorentzText() {
        const lorentzTitleElement = document.getElementById('lorentzTitle');
        const lorentzSubtitleElement = document.getElementById('lorentzSubtitle');
        const lorentzDescriptionElement = document.getElementById('lorentzDescription');

        const title = await fetchFromApi('/api/getCustomByIdentifier/lorentz_title');
        const subtitle = await fetchFromApi('/api/getCustomByIdentifier/lorentz_subtitle');
        const description = await fetchFromApi('/api/getCustomByIdentifier/lorentz_description');

        lorentzTitleElement.innerHTML = title.content;
        lorentzSubtitleElement.innerHTML = subtitle.content;
        lorentzDescriptionElement.innerHTML = description.content;

        this.cms.setContentInputDataset(lorentzTitleElement.id, 'custom', title.id, 'content');
        this.cms.setContentInputDataset(lorentzSubtitleElement.id, 'custom', subtitle.id, 'content');
        this.cms.setContentInputDataset(lorentzDescriptionElement.id, 'custom', description.id, 'content');
    }

    /**
     * Sets the background image for the Lorentz section based on a value fetched
     * from the API.
     */
    async setLorentzBackground() {
        const container = document.getElementById('teylersLorentz');
        const image = await fetchFromApi('/api/getCustomByIdentifier/lorentz_bg');
        container.style.backgroundImage = `url('/assets/images/${image.content}')`;
    }
}