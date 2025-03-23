import {fetchFromApi} from "../main.js";

/**
 * Class that handles an artist schedule.
 */
export class ArtistSchedule {
    async init() {
        this.shows = await this.fetchDanceShows();
        this.artistScheduleContainer = document.getElementById('artistSchedule');

        await this.populateShows();
    }

    static async create() {
        const instance = new ArtistSchedule();
        await instance.init();
        return instance;
    }

    /**
     * Populates the dance shows with data from the API.
     */
    async populateShows() {
        for (let i = 0; i < this.shows.length; i++) {
            const show = this.shows[i];

            if (i !== 0) {
                const showCards = this.artistScheduleContainer.querySelectorAll('.show-card');
                const lastShowCard = showCards[showCards.length - 1];

                const clone = lastShowCard.cloneNode(true);
                this.artistScheduleContainer.appendChild(clone);
            }

            await this.bindDataToShowCard(show, i % 2 !== 0);

            if (i !== this.shows.length - 1) {
                const hr = document.createElement('hr');
                this.artistScheduleContainer.appendChild(hr);
            }
        }
    }

    /**
     * Binds data to a show card based on the provided dance show object.
     *
     * @param show The dance show object to bind.
     * @param left If the card image should be placed on the left side of the screen.
     */
    async bindDataToShowCard(show, left = false) {
        const showCards = this.artistScheduleContainer.querySelectorAll('.show-card');
        const lastShowCard = showCards[showCards.length - 1];

        this.setDate(show, lastShowCard);
        this.setPrice(show, lastShowCard);
        await this.setText(show, lastShowCard);
        this.setButton(show, lastShowCard);

        this.reorderImage(lastShowCard, left);
    }

    /**
     * Sets the button for a card.
     *
     * @param show The dance show object.
     * @param showCard The show card element.
     */
    setButton(show, showCard) {
        // Set the button for a card here
    }

    /**
     * Places the image on the left or right side of the card.
     *
     * @param card The show card element.
     * @param left If the card image should be placed on the left side on the card.
     */
    reorderImage(card, left) {
        const imageContainer = card.querySelector('.show-image-container');
        const textContainer = card.querySelector('.show-text-container');
        const nameContainer = card.querySelector('.show-name-container');
        const dateContainer = card.querySelector('.show-date-container');

        dateContainer.style.order = 1;
        nameContainer.style.order = 2;

        if (left) {
            textContainer.style.order = 3;
            imageContainer.style.order = 4;
        } else {
            imageContainer.style.order = 3;
            textContainer.style.order = 4;
        }
    }

    /**
     * Sets the text of the show card.
     *
     * @param show The dance show object.
     * @param showCard The show card element.
     */
    async setText(show, showCard) {
        const showName = showCard.querySelector('.show-name');

        const artists = show.participants;
        showName.textContent = artists
            .map(a => a.artist.stage_name)
            .join(' / ');

        const venue = await fetchFromApi(`/api/getVenueById/${show.venue_id}`);
        showName.textContent += ` at ${venue.name}`;

        const showText = showCard.querySelector('.show-text');
        const date = new Date(show.date_time.replace(' ', 'T'));
        const participants = artists
            .map(a => a.artist.stage_name)
            .join(', ');
        const formattedDate = this.getFormattedDate(date);
        showText.innerHTML = `Visit ${venue.name} on ${formattedDate} to hear ${participants}.<br><br>Address: ${venue.address}`;
    }

    /**
     * Returns a formatted date string, e.g. 'Friday 25th at 23:00'.
     *
     * @param date The date object.
     * @returns {string} The formatted date string, e.g. 'Friday 25th at 23:00'.
     */
    getFormattedDate(date) {
        const dayOfWeek = date.toLocaleDateString(undefined, {weekday: 'long'});
        const day = date.getDate();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        function getOrdinal(n) {
            const s = ["th", "st", "nd", "rd"];
            const v = n % 100;
            return n + (s[(v - 20) % 10] || s[v] || s[0]);
        }

        return `${dayOfWeek} ${getOrdinal(day)} at ${hours}:${minutes}`;
    }

    /**
     * Sets the date of the show.
     *
     * @param show The dance show object.
     * @param showCard The show card element.
     */
    setDate(show, showCard) {
        const showDate = showCard.querySelector('.show-date');
        const showDay = showCard.querySelector('.show-day');
        const showTime = showCard.querySelector('.show-time');

        const date = new Date(show.date_time.replace(' ', 'T'));
        const options = {weekday: 'long'};

        showDate.innerHTML = date.getDate();
        showDay.innerHTML = date.toLocaleDateString('en-US', options);
        showTime.innerHTML = date.toTimeString().split(':').slice(0, 2).join(':');
    }

    /**
     * Sets the price of the show.
     *
     * @param show The dance show object.
     * @param showCard The show card element.
     */
    setPrice(show, showCard) {
        const showPrice = showCard.querySelector('.show-price');
        showPrice.innerHTML = `€${show.price}`;
    }

    /**
     * Fetches the dance shows for the artist from the API.
     *
     * @returns {Promise<Object>} The dance show object.
     */
    async fetchDanceShows() {
        const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments[pathSegments.length - 1];

        return await fetchFromApi(`/api/getDanceShowsByArtist/${slug}`);
    }
}