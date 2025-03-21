import { fetchFromApi } from '../main.js';
import {EventHero} from "./EventHero.js";
import {LoginForm} from "./LoginForm.js";
import {RegistrationForm} from "./RegistrationForm.js";
import {Promo} from "./Promo.js";
import {ArtistCard} from "./ArtistCard.js";
import {DanceSchedule} from "./DanceSchedule.js";
import {ArtistHero} from "./ArtistHero.js";

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
            '/teylers': 'nav-item-teylers',
            '/yummy': 'nav-item-yummy'
        };

        this.routeMap = {
            '/login': [LoginForm],
            '/register': [RegistrationForm],
            '/dance': [EventHero, Promo, ArtistCard, DanceSchedule],
            '/yummy': [EventHero, Promo],
            '/strolls': [EventHero, Promo],
            '/teylers': [EventHero, Promo]
        };

        this.addDynamicRoutes();

        if (this.navItems.hasOwnProperty(this.path)) {
            this.setCurrentNavItem(this.navItems[this.path]);
        }

        if (this.routeMap[this.path]) {
            for (const ClassRef of this.routeMap[this.path]) {
                await ClassRef.create();
            }
        }
    }

    static async create() {
        const instance = new Navigation();
        await instance.init();
        return instance;
    }

    /**
     * Adds dynamic routes to the nav items and route map.
     */
    addDynamicRoutes() {
        const artistMatch = this.path.match(/^\/dance\/([a-z0-9-]+)$/);

        if (artistMatch) {
            this.navItems[this.path] = 'nav-item-dance';
            this.routeMap[this.path] = [ArtistHero];
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
        for (const { slug, menu_name } of this.events) {
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