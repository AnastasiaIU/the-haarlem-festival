import {fetchFromApi} from "../main.js";

/**
 * Class that handles the DANCE! event schedule.
 */
export class DanceSchedule {
    async init() {
        this.passes = await fetchFromApi('/api/getPasses');

        this.setPrices();
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
}