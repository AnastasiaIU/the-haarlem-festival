import {fetchFromApi} from '../main.js';
import {EventHero} from "./EventHero.js";
import {LoginForm} from "./LoginForm.js";
import {RegistrationForm} from "./RegistrationForm.js";
import {Promo} from "./Promo.js";
import {ArtistCard} from "./ArtistCard.js";
import {DanceSchedule} from "./DanceSchedule.js";
import {ArtistHero} from "./ArtistHero.js";
import {ArtistSchedule} from "./ArtistSchedule.js";
import {ArtistCarousel} from "./ArtistCarousel.js";
import {Track} from "./Track.js";
import {RestaurantCard} from "./RestaurantCard.js";
import {RestaurantHero} from "./RestaurantHero.js";
import {RestaurantSchedule} from "./RestaurantSchedule.js";
import {StrollsSchedule} from "./StrollsSchedule.js";
import {Teylers} from "./Teylers.js";
import {Restaurant} from "./Restaurant.js";
import {RestaurantCarousel} from "./RestaurantCarousel.js";
import {Strolls} from "./Strolls.js";
import {LocationHero} from "./LocationHero.js";
import {Location} from "./Location.js";
import {LocationCarousel} from "./LocationCarousel.js";

/**
 * Class that handles the navigation for the website.
 */
export class Navigation {
    async init() {
        this.events = await fetchFromApi('/api/getEvents');
        this.navbar = document.getElementById('navbar');
        this.sitemap = document.getElementById('sitemap');

        this.createNavItems();

        this.path = window.location.pathname;

        this.navItems = {
            '/': 'nav-item-',
            '/cart': 'nav-item-cart',
            '/dance': 'nav-item-dance',
            '/login': '',
            '/profile': 'nav-item-profile',
            '/register': '',
            '/strolls': 'nav-item-strolls',
            '/strolls/schedule': 'nav-item-strolls',
            '/teylers': 'nav-item-teylers',
            '/yummy': 'nav-item-yummy'
        };

        this.routeMap = {
            '/login': [LoginForm],
            '/register': [RegistrationForm],
            '/dance': [EventHero, Promo, ArtistCard, DanceSchedule],
            '/yummy': [EventHero, Promo, RestaurantCard],
            '/strolls': [EventHero, Promo, Strolls],
            '/strolls/schedule': [StrollsSchedule],
            '/teylers': [EventHero, Promo, Teylers]
        };

        this.styles = {
            '/': ['homepage'],
            '/dance': ['hero', 'promo', 'artist', 'artist-carousel'],
            '/yummy': ['hero', 'promo', 'restaurant', 'yummy-carousel'],
            '/strolls': ['hero', 'promo', 'strolls'],
            '/strolls/schedule': ['strolls'],
            '/teylers': ['hero', 'promo', 'teylers'],
            '/profile/personal-plan': ['profile'],
            '/cart': ['shopping-cart'],
            '/cart/checkout': ['shopping-cart'],
            '/cart/checkout/confirmation': ['shopping-cart']
        };

        this.addDynamicRoutes();

        if (this.styles[this.path]) {
            for (const style of this.styles[this.path]) {
                this.loadPageStyles(`/assets/css/${style}.css`);
            }
        }

        if (this.navItems.hasOwnProperty(this.path)) {
            this.setCurrentNavItem(this.navItems[this.path]);
        }

        if (this.routeMap[this.path]) {
            for (const ClassRef of this.routeMap[this.path]) {
                await ClassRef.create();
            }
        }

        // Add delay before hiding the loader
        await new Promise(resolve => setTimeout(resolve, 1000));

        // Fade out and remove loader
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.style.opacity = '0';
            loader.style.pointerEvents = 'none';
            setTimeout(() => loader.remove(), 300);
        }
    }

    static async create() {
        const instance = new Navigation();
        await instance.init();
        return instance;
    }

    loadPageStyles(href) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = href;
        document.head.appendChild(link);
    }

    /**
     * Adds dynamic routes to the nav items and route map.
     */
    addDynamicRoutes() {
        const artistMatch = this.path.match(/^\/dance\/([a-z0-9-]+)$/);
        const restaurantMatch = this.path.match(/^\/yummy\/([a-z0-9-]+)$/);
        const locationMatch = this.path.match(/^\/strolls\/([a-z0-9-]+)$/);

        if (artistMatch) {
            this.navItems[this.path] = 'nav-item-dance';
            this.routeMap[this.path] = [ArtistHero, ArtistSchedule, ArtistCarousel, Track];
            this.styles[this.path] = ['hero', 'artist', 'artist-carousel'];
        }

        if (restaurantMatch) {
            this.navItems[this.path] = 'nav-item-yummy';
            this.routeMap[this.path] = [RestaurantHero, RestaurantSchedule, Restaurant, RestaurantCarousel];
            this.styles[this.path] = ['hero', 'restaurant', 'restaurant-carousel'];
        }

        if (locationMatch && this.path !== '/strolls/schedule') {
            this.navItems[this.path] = 'nav-item-strolls';
            this.routeMap[this.path] = [LocationHero, Location, LocationCarousel];
            this.styles[this.path] = ['hero', 'location', 'location-carousel'];
        }
    }

    /**
     * Sets the current navigation item as active based on the provided ID.
     *
     * @param {string} id The ID of the navigation item to set as active.
     */
    setCurrentNavItem(id) {
        const navItems = document.querySelectorAll('.nav-link');
        navItems.forEach(item => {
            if (item.id === id) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }

    /**
     * Create nav items for each event.
     */
    createNavItems() {
        for (const {slug, menu_name} of this.events) {
            const navItem = this.createNavItem(slug, menu_name);
            this.navbar.appendChild(navItem);
            const sitemapItem = this.createSitemapItem(slug, menu_name);
            this.sitemap.appendChild(sitemapItem);
        }
    }

    /**
     * Creates a nav item.
     *
     * @param slug The slug of the event.
     * @param name The name of the event.
     * @returns {HTMLLIElement} The nav item.
     */
    createNavItem(slug, name) {
        const navItem = document.createElement('li');
        navItem.className = 'nav-item';
        navItem.innerHTML = `<a class="nav-link" id="nav-item-${slug}" href="/${slug}">${name}</a>`;

        return navItem;
    }

    /**
     * Creates a sitemap item.
     *
     * @param slug The slug of the event.
     * @param name The name of the event.
     * @returns {HTMLAnchorElement} The sitemap item.
     */
    createSitemapItem(slug, name) {
        const sitemapItem = document.createElement('a');
        sitemapItem.className = 'footer-link';
        sitemapItem.href = `/${slug}`;
        sitemapItem.innerHTML = `${name}`;

        return sitemapItem;
    }
}