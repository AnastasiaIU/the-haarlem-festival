import {fetchFromApi} from "../main.js";
import {CMS} from "./CMS.js";

/**
 * Class that handles the restaurant schedule.
 */
export class RestaurantSchedule {
    async init() {
        this.cms = await CMS.create();
        this.restaurant = await this.fetchRestaurant();
        this.cardsContainer = document.getElementById('restaurantSchedule');

        await this.setTitleAndDescription();
        this.populateSchedule();
    }

    static async create() {
        const instance = new RestaurantSchedule();
        await instance.init();
        return instance;
    }

    populateSchedule() {
        const startDate = new Date(this.restaurant.start_date);
        const endDate = new Date(this.restaurant.end_date);

        this.dates = [];

        while (startDate <= endDate) {
            // Clone the date to avoid mutating startDate
            this.dates.push(new Date(startDate));

            // Move to the next day
            startDate.setDate(startDate.getDate() + 1);
        }

        const lastCard = document.querySelector('.book-card');
        this.populateSessions(lastCard);

        this.dates.forEach((date, i) => {
            if (i !== 0) {
                const cards = document.querySelectorAll('.book-card')
                const lastCard = cards[cards.length - 1];
                const newCard = lastCard.cloneNode(true);
                this.cardsContainer.appendChild(newCard);
            }

            const cards = document.querySelectorAll('.book-card');
            const lastCard = cards[cards.length - 1];

            this.setDate(date, lastCard);
        });

        if (this.restaurant.reservations) {
            this.setAvailability();
        }
    }

    populateSessions(card) {
        const today = (new Date()).toISOString().split('T')[0];
        const sessionStart = new Date(`${today}T${this.restaurant.first_session}`);
        const duration = this.restaurant.duration;

        for (let i = 0; i < this.restaurant.sessions; i++) {
            if (i !== 0) {
                const sessions = card.querySelectorAll('.row')
                const lastSession = sessions[sessions.length - 1];
                const newSession = lastSession.cloneNode(true);
                card.appendChild(newSession);
            }

            const sessions = card.querySelectorAll('.row')
            const lastSession = sessions[sessions.length - 1];

            this.setStartTime(lastSession, sessionStart);

            if (i === 0) {
                this.setDuration(lastSession, duration);
                this.setPrice(lastSession);
                this.setFullAvailability(lastSession);
                this.setButton(lastSession);
            }

            sessionStart.setMinutes(sessionStart.getMinutes() + duration);
        }
    }

    setButton(session) {
        /*const button = session.querySelector('button');
        const modal = document.querySelector('.modal');

        button.addEventListener('click', () => {
            modal.style.display = 'flex';
        });*/
    }

    setAvailability() {
        this.restaurant.reservations.forEach((reservation) => {
            const date = new Date(reservation.date_time);
            const dateIndex = this.dates.map(d => d.getDate()).indexOf(date.getDate());
            const card = document.querySelectorAll('.book-card')[dateIndex];

            const reservedSeats = reservation.adults + reservation.kids;

            const elements = card.querySelectorAll('.start');
            const matchingElement = Array.from(elements).find(el => el.innerHTML.includes(date.getHours().toString())).parentElement;

            const seatsElement = matchingElement.querySelector('.seats');
            const seats = parseInt(seatsElement.innerHTML) - reservedSeats;
            seatsElement.innerHTML = (seats).toString();
            if (seats <= 0) {
                matchingElement.querySelector('button').disabled = true;
                matchingElement.querySelector('button img').src = '/assets/images/shopping_cart_gray.svg';
            }
        })
    }

    setFullAvailability(session) {
        const seats = session.querySelector('.seats');
        seats.innerHTML = this.restaurant.capacity;
    }

    setPrice(session) {
        const price = session.querySelector('.price');
        const adultPrice = this.restaurant.adult_price.toFixed(2).replace('.', ',');
        const kidsPrice = this.restaurant.kids_price.toFixed(2).replace('.', ',');
        price.innerHTML = `€ ${adultPrice} / € ${kidsPrice}`;
    }

    setDuration(session, duration) {
        const durationElement = session.querySelector('.duration');
        durationElement.innerHTML = this.formatMinutesAsTime(`${duration}`);
    }

    formatMinutesAsTime(minutes) {
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;
        return `${hours}:${mins.toString().padStart(2, '0')}`;
    }

    setStartTime(session, sessionStart) {
        const start = session.querySelector('.start');
        start.innerHTML = this.getFormattedTime(sessionStart);
    }

    /**
     * Returns a formatted time string, e.g. '23:00'.
     *
     * @param date The date object.
     * @returns {string} The formatted time string, e.g. '23:00'.
     */
    getFormattedTime(date) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        return `${hours}:${minutes}`;
    }

    setDate(date, card) {
        const day = card.querySelector('.book-day')
        day.innerHTML = this.formatFullDate(date);
    }

    formatFullDate(date) {
        const day = date.getDate();
        const weekday = date.toLocaleDateString('en-US', {weekday: 'long'});
        const month = date.toLocaleDateString('en-US', {month: 'long'});
        const year = date.getFullYear();

        return `${weekday}, ${month} ${day}${this.getOrdinalSuffix(day)}, ${year}`;
    }

    getOrdinalSuffix(n) {
        if (n > 3 && n < 21) return 'th';
        switch (n % 10) {
            case 1:
                return 'st';
            case 2:
                return 'nd';
            case 3:
                return 'rd';
            default:
                return 'th';
        }
    }


    async setTitleAndDescription() {
        const titleElement = document.querySelector('.book-header');
        const title = await fetchFromApi('/api/getCustomByIdentifier/book_table_title');
        titleElement.innerHTML = title.content;

        const descriptionElement = document.querySelector('.book-description');
        const description = await fetchFromApi('/api/getCustomByIdentifier/book_table_description');
        descriptionElement.innerHTML = description.content;
    }

    /**
     * Fetches the restaurant from the API.
     *
     * @returns {Promise<Object>} The restaurant object.
     */
    async fetchRestaurant() {
        const pathSegments = window.location.pathname.split('/').filter(segment => segment !== '');
        const slug = pathSegments[pathSegments.length - 1];

        return await fetchFromApi(`/api/getRestaurantBySlug/${slug}`);
    }
}