export class CartItem {
    constructor(id, name, dateTime, price, type, path, subType = null, comment = null) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.type = type;
        this.subType = subType ? subType : '';
        this.path = path;
        this.comment = comment ? comment : '';

        const dateObj = new Date(dateTime);

        // Check if the date is valid
        if (isNaN(dateObj.getTime())) {
            console.error(`Invalid dateTime format: ${dateTime}`);
            this.date = null;
            this.time = null;
        } else {
            this.date = dateObj.toISOString().split('T')[0];
            this.time = dateObj.toTimeString().split(' ')[0];
        }
    }
}