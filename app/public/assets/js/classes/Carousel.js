/**
 * Class that handles the carousel element.
 */
export class Carousel {
    async init() {
        const carousels = document.querySelectorAll('div[id*=carousel]');

        carousels.forEach((carousel) => {
            new bootstrap.Carousel(carousel, {
                interval: 2000,
                touch: false
            })
        });
    }

    static async create() {
        const instance = new Carousel();
        await instance.init();
        return instance;
    }
}