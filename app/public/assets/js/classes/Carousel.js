/**
 * Class that handles the carousel element.
 */
export class Carousel {
    async init() {
        const carouselOneElement = document.querySelector('#carouselOne');
        const carouselThreeElement = document.querySelector('#carouselThree');

        const carouselOne = new bootstrap.Carousel(carouselOneElement, {
            interval: 2000,
            touch: false
        })

        const carouselThree = new bootstrap.Carousel(carouselThreeElement, {
            interval: 2000,
            touch: false
        })
    }

    static async create() {
        const instance = new Carousel();
        await instance.init();
        return instance;
    }
}