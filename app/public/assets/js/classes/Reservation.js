export class Reservation {
    constructor(restarantId, dateTime, adults, kids, comment) {
        this.restaurantId = restarantId;
        this.dateTime = dateTime;
        this.adults = adults;
        this.kids = kids;
        this.comment = comment;
    }
}