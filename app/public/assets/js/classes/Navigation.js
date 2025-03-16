export class Navigation {
    constructor() {
        this.navbar = document.getElementById('navbar');

        for (const { slug, menu_name } of events) {
            const navItem = this.createNavItem(slug, menu_name);
            this.navbar.appendChild(navItem);
        }
    }

    createNavItem(slug, name) {
        const listItem = document.createElement('li');
        listItem.className = 'nav-item';
        listItem.innerHTML = `<a class="nav-link" id="nav-item-${slug}" href="/${slug}">${name}</a>`;

        return listItem;
    }
}