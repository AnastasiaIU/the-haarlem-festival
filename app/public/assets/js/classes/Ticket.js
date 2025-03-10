export class Ticket {
    constructor(id, code, name, date, time, price, type, path, subType = null) {
        this.id = id;
        this.code = code;
        this.name = name;
        this.date = date;
        this.time = time;
        this.price = price;
        this.type = type;
        this.subType = subType;
        this.path = path;
    }
}