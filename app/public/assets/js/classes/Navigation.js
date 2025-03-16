export class Navigation {
    constructor() {
        this.navbar = document.getElementById('navbar');
        this.sitemap = document.getElementById('sitemap');

        for (const { slug, menu_name } of events) {
            const navItem = this.createNavItem(slug, menu_name);
            this.navbar.appendChild(navItem);
            const sitemapItem = this.createSitemapItem(slug, menu_name);
            this.sitemap.appendChild(sitemapItem);
        }
    }

    createNavItem(slug, name) {
        const navItem = document.createElement('li');
        navItem.className = 'nav-item';
        navItem.innerHTML = `<a class="nav-link" id="nav-item-${slug}" href="/${slug}">${name}</a>`;

        return navItem;
    }

    createSitemapItem(slug, name) {
        const sitemapItem = document.createElement('a');
        sitemapItem.className = 'footer-link';
        sitemapItem.href = `/${slug}`;
        sitemapItem.innerHTML = `${name}`;

        return sitemapItem;
    }
}