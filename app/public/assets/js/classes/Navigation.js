import { fetchFromApi } from '../main.js';

/**
 * Class that handles the creation of nav items.
 */
export class Navigation {
    constructor() {
        this.init();
    }

    async init() {
        this.events = await fetchFromApi('/api/getEvents');
        this.navbar = document.getElementById('navbar');
        this.sitemap = document.getElementById('sitemap');

        this.createNavItems();
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