import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";
import {Carousel} from "./Carousel.js";

/**
 * Class that handles the restaurants.
 */
export class Restaurant {
    async init() {
        this.cms = await CMS.create();
        this.restaurant = await this.fetchRestaurant();
        this.chef = await fetchFromApi(`/api/getChefByRestaurantId/${this.restaurant.id}`);
        this.socials = await fetchFromApi(`/api/getSocialMediaByRestaurantId/${this.restaurant.id}`);

        this.setMenu();

        if (this.chef) {
            this.showChef();
        }

        this.setContacts();
        await this.setContactForm();

        await Carousel.create();
    }

    static async create() {
        const instance = new Restaurant();
        await instance.init();
        return instance;
    }

    /**
     * Initializes the contact form by setting its title content and binding the submit event handler.
     * The form title is fetched via an API and made editable via the CMS.
     */
    async setContactForm() {
        const formTitleElement = document.getElementById("contactFormTitle");
        const formTitle = await fetchFromApi('/api/getCustomByIdentifier/contact_restaurant_title');
        formTitleElement.textContent = formTitle.content;
        this.cms.setContentInputDataset(formTitleElement.id, 'custom', formTitle.id, 'content');

        const form = document.getElementById("contactForm");
        form.addEventListener('submit', event => {
            event.preventDefault();
            this.submitForm(event);
        });
    }

    /**
     * Resets the contact form and removes any validation styles.
     * Ensures that the form does not stay in a validated state after submission.
     */
    clearForm() {
        const form = document.getElementById("contactForm");
        form.reset();
        form.classList.remove('was-validated');
    }

    /**
     * Handles form submission logic.
     * If the form is valid, shows a toast and clears the form.
     * If invalid, prevents default behavior and marks the form as validated.
     *
     * @param {Event} event - The form submission event.
     */
    submitForm(event) {
        if (event.target.checkValidity()) {
            this.cms.showToast("Thank you. Your message was sent.");
            event.target.classList.add('was-validated');
            this.clearForm();
        } else {
            // Stop the form submission
            event.stopPropagation()
            event.target.classList.add('was-validated');
        }
    }

    /**
     * Sets the contact details on the page using the current restaurant and social media data.
     * This includes setting links and text content for address, phone, email, Facebook, and Instagram.
     */
    setContacts() {
        const restaurantAddress = document.querySelector('#restaurantAddress a');
        const restaurantPhone = document.querySelector('#restaurantPhone a');
        const restaurantEmail = document.querySelector('#restaurantEmail a');
        const facebook = document.getElementById('restaurantFacebook');
        const instagram = document.getElementById('restaurantInstagram');

        let searchParameter = this.restaurant.name.replace(' ', '+');
        searchParameter += '+haarlem';

        restaurantAddress.href = `https://www.google.com/maps/search/?api=1&query=${searchParameter}`;
        restaurantAddress.innerHTML = this.restaurant.address;

        restaurantPhone.href = `tel:${this.restaurant.phone}`;
        restaurantPhone.innerHTML = this.restaurant.phone;

        restaurantEmail.href = `mailto:${this.restaurant.email}`;
        restaurantEmail.innerHTML = this.restaurant.email;

        facebook.href = this.socials[0].link;
        instagram.href = this.socials[1].link;
    }

    /**
     * Displays the chef information on the page including name, image, and description.
     * Makes the image and description editable via the CMS.
     */
    showChef() {
        const chefContainer = document.getElementById("restaurantChef");
        const chefName = document.getElementById("chefName");
        const chefImage = document.getElementById("chefImage");
        const chefDescription = document.getElementById("chefDescription");

        chefName.innerHTML = `Chef ${this.chef.name}`;
        chefImage.src = `/assets/images/${this.chef.image}`;
        chefDescription.innerHTML = this.chef.description;

        const changeButton = chefImage.nextElementSibling;

        this.cms.setImageInputDataset(changeButton.id, 'chef', `${this.chef.id}`, 'image', chefImage.id);
        this.cms.setContentInputDataset(chefDescription.id, 'chef', this.chef.id, 'description');

        chefContainer.style.display = "flex";
    }

    /**
     * Displays the restaurant's menu image and binds the CMS image input for admin editing.
     */
    setMenu() {
        const menuElement = document.getElementById("menuImg");
        menuElement.src = `/assets/images/${this.restaurant.menu}`;

        const changeButton = menuElement.nextElementSibling;

        this.cms.setImageInputDataset(changeButton.id, 'restaurant', `${this.restaurant.id}`, 'menu', menuElement.id);
    }

    /**
     * Fetches the restaurant from the API by the slug.
     *
     * @returns {Promise<Object>} The restaurant object.
     */
    async fetchRestaurant() {
        const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments[pathSegments.length - 1];

        return await fetchFromApi(`/api/getRestaurantBySlug/${slug}`);
    }
}