import { fetchFromApi } from "../main.js";
import { setButton } from "../main.js";

/**
 * Class that handles the DANCE! event schedule.
 */
export class DanceSchedule {
    async init() {
        this.passes = await fetchFromApi('/api/getPasses');

        this.setPrices();
        await this.setButtons();
    }

    static async create() {
        const instance = new DanceSchedule();
        await instance.init();
        return instance;
    }

    /**
     * Sets the prices of the different passes.
     */
    setPrices() {
        const fridayPass = document.getElementById("pass-friday-price");
        const saturdayPass = document.getElementById("pass-saturday-price");
        const sundayPass = document.getElementById("pass-sunday-price");
        const allAccessPass = document.getElementById("pass-all-access-price");

        fridayPass.innerHTML = `€${this.passes[0].price}`;
        saturdayPass.innerHTML = `€${this.passes[1].price}`;
        sundayPass.innerHTML = `€${this.passes[2].price}`;
        allAccessPass.innerHTML = `€${this.passes[3].price}`;
    }

    async setButtons() {
        const passButtons = document.querySelectorAll(".pass-button");
        const passesAvailability = await fetchFromApi('/api/getPassesAvailability');
    
        for (let i = 0; i < passButtons.length; i++) {
            const pass = this.passes[i];
            const cartItem = await fetchFromApi(`/api/cart-item/pass/${pass.id}`);
    
            let dayName;
    
            if (pass.item_name === "Three-days pass" || i === this.passes.length - 1) {
                dayName = "All-Access";
            } else {
                dayName = new Date(cartItem.date.replace(' ', 'T')).toLocaleDateString('en-US', { weekday: 'long' });
            }
    
            const canSell = passesAvailability[dayName];
    
            if (canSell) {
                passButtons[i].disabled = false;
                passButtons[i].classList.remove('disabled');
            } else {
                passButtons[i].disabled = true;
                passButtons[i].classList.add('disabled');
            }
    
            setButton(passButtons[i], cartItem);
            console.log(cartItem);
        }
    }
}