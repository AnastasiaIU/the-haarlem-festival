import { fetchFromApi } from "../main.js";
import { CMS } from "./CMS.js";
import { CartItem } from "./CartItem.js";
import { ShoppingCart } from "./ShoppingCart.js";

const RESERVATION_FEE = 10.00;
const shoppingCart = ShoppingCart.getInstance();

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

        this.modal = document.getElementById('bookingModal');
        if (this.modal) {
            this.modal.addEventListener('show.bs.modal', event => {
                this.setModal(event);
            });
        }
    }

    static async create() {
        const instance = new RestaurantSchedule();
        await instance.init();
        return instance;
    }

    updatePrices(event) {
        const adults = this.getSelectedValue('optionsAdult');
        const kids = this.getSelectedValue('optionsKids');

        const fullPrice = (adults * this.restaurant.adult_price) + (kids * this.restaurant.kids_price);
        const reservationPrice = (adults + kids) * RESERVATION_FEE;

        // Format to 0,00 format for EU display
        document.getElementById('fullPrice').innerText = fullPrice.toFixed(2).replace('.', ',');
        document.getElementById('reservationPrice').innerText = reservationPrice.toFixed(2).replace('.', ',');

        this.setButtons(event, this.restaurant);
    }

    async setButtons(event, restaurant) {
        const addButton = document.querySelector('.add-button-r');
        const adultCount = this.getSelectedValue('optionsAdult');
        const kidCount = this.getSelectedValue('optionsKids');
        const date = event.relatedTarget.dataset.bookDate;
        const time = event.relatedTarget.dataset.bookTime;
        const fullDate = new Date(`${date}T${time}`);
        const comment = document.getElementById('message-text').value;
    
        const cartItemPathType = await fetchFromApi(`/api/cart-item/restaurant/${restaurant.id}`);
    
        // Clear previous cart items
        let cartItems = [];
    
        // Add kid tickets
        for (let i = 0; i < kidCount; i++) {
            const cartItem = new CartItem(
                restaurant.id,
                restaurant.name,
                fullDate,
                RESERVATION_FEE,
                cartItemPathType.type,
                cartItemPathType.image,
                'Kids',
                comment
            );
            cartItems.push(cartItem);
        }
    
        // Add adult tickets
        for (let i = 0; i < adultCount; i++) {
            const cartItem = new CartItem(
                restaurant.id,
                restaurant.name,
                fullDate,
                RESERVATION_FEE,
                cartItemPathType.type,
                cartItemPathType.image,
                'Adults',
                comment
            );
            cartItems.push(cartItem);
        }
    
        // Remove any existing event listener
        if (addButton.addButtonClickListener) {
            addButton.removeEventListener('click', addButton.addButtonClickListener);
        }
    
        // Define the new event listener
        const addButtonClickListener = function () {
            cartItems.forEach(cartItem => {
                shoppingCart.addItem(cartItem);
            });
        };
    
        // Attach the new event listener
        addButton.addEventListener('click', addButtonClickListener);
        addButton.addButtonClickListener = addButtonClickListener;
    }

    getSelectedValue(groupName) {
        const selected = document.querySelector(`input[name="${groupName}"]:checked`);
        if (!selected) return 0;

        const label = document.querySelector(`label[for="${selected.id}"]`);
        return parseInt(label.innerText);
    }

    setModal(event) {
        const button = event.relatedTarget;

        const date = button.dataset.bookDate;
        const start = button.dataset.bookTime;
        const fullDate = new Date(`${date}T${start}`);
        const end = new Date(`${date}T${start}`);
        end.setMinutes(fullDate.getMinutes() + this.restaurant.duration)

        const modalTitle = this.modal.querySelector('.modal-title');
        const modalTime = this.modal.querySelector('.modal-time');

        modalTitle.textContent = this.formatFullDate(fullDate);
        modalTime.textContent = `${this.getFormattedTime(fullDate)} - ${this.getFormattedTime(end)}`;

        document.querySelectorAll('input[name="optionsAdult"], input[name="optionsKids"]').forEach(input => {
            input.addEventListener('change', () => this.updatePrices(event));
        });

        this.updatePrices(event);
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

            lastCard.dataset.bookDate = this.getFormattedDate(new Date(date));

            this.setDate(date, lastCard);

            const sessions = lastCard.querySelectorAll('.session');
            sessions.forEach(session => {
                session.dataset.bookDate = lastCard.dataset.bookDate;
                session.querySelector('button').dataset.bookDate = lastCard.dataset.bookDate;
            })
        });

        if (this.restaurant.reservations) {
            this.setAvailability();
        }
    }

    getFormattedDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    populateSessions(card) {
        const today = new Date();
        const dateString = this.getFormattedDate(today);
        const sessionStart = new Date(`${dateString}T${this.restaurant.first_session}`);
        const duration = this.restaurant.duration;

        for (let i = 0; i < this.restaurant.sessions; i++) {
            if (i !== 0) {
                const sessions = card.querySelectorAll('.session')
                const lastSession = sessions[sessions.length - 1];
                const newSession = lastSession.cloneNode(true);
                card.appendChild(newSession);
            }

            const sessions = card.querySelectorAll('.session')
            const lastSession = sessions[sessions.length - 1];

            const button = lastSession.querySelector('button');

            lastSession.dataset.bookTime = this.getFormattedTime(sessionStart, true);
            button.dataset.bookTime = this.getFormattedTime(sessionStart, true);

            this.setStartTime(lastSession, sessionStart);

            if (i === 0) {
                this.setDuration(lastSession, duration);
                this.setPrice(lastSession);
                this.setFullAvailability(lastSession);
            }

            sessionStart.setMinutes(sessionStart.getMinutes() + duration);
        }
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
     * Returns a formatted time string, e.g. '23:00' or '23:00:00'.
     *
     * @param date The date object.
     * @param withSeconds Whether to include the seconds.
     * @returns {string} The formatted time string, e.g. '23:00' or '23:00:00'.
     */
    getFormattedTime(date, withSeconds = false) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        if (withSeconds) {
            return `${hours}:${minutes}:${seconds}`;
        } else {
            return `${hours}:${minutes}`;
        }
    }

    setDate(date, card) {
        const day = card.querySelector('.book-day')
        day.innerHTML = this.formatFullDate(date);
    }

    formatFullDate(date) {
        const day = date.getDate();
        const weekday = date.toLocaleDateString('en-US', { weekday: 'long' });
        const month = date.toLocaleDateString('en-US', { month: 'long' });
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
        this.cms.setContentInputDataset(titleElement.id, 'custom', title.id, 'content');

        const descriptionElement = document.querySelector('.book-description');
        const description = await fetchFromApi('/api/getCustomByIdentifier/book_table_description');
        descriptionElement.innerHTML = description.content;
        this.cms.setContentInputDataset(descriptionElement.id, 'custom', description.id, 'content');
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