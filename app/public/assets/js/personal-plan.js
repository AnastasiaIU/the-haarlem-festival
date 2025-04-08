import { fetchFromApi } from "./main.js";

document.addEventListener("DOMContentLoaded", async () => {
    const personalPlanContainer = document.getElementById("personalPlanContainer");
    const bookings = await fetchFromApi("/api/bookings/user");
    const groupedBookings = groupBy(bookings, "order_number");

    personalPlanContainer.innerHTML = "";

    Object.entries(groupedBookings).forEach(([orderNumber, items]) => {
        const bookingCard = document.createElement("div");
        bookingCard.classList.add("booking-card");

        bookingCard.innerHTML = `
            <div class="booking-header">
                <h3>Order #${orderNumber}</h3>
            </div>
            <div class="booking-details">
                ${items
                    .map(
                        item => `
                    <div class="item-card">
                        <p><strong>Ticket Type:</strong> ${capitalizeWords(item.booking.ticket_type.replace("_", " "))}</p>
                        <p><strong>Quantity:</strong> ${item.booking.quantity}</p>
                        <p><strong>Email:</strong> ${item.booking.receiving_email}</p>
                        <p><strong>Name:</strong> ${item.user_name}</p>
                        <p><strong>Ticket Subtype:</strong> ${item.booking.ticket_subtype ? capitalizeWords(item.booking.ticket_subtype) : "-"}</p>
                    </div>
                `
                    )
                    .join("")}
            </div>
        `;

        personalPlanContainer.appendChild(bookingCard);
    });
});

function groupBy(array, key) {
    return array.reduce((result, currentValue) => {
        (result[currentValue.booking[key]] = result[currentValue.booking[key]] || []).push(currentValue);
        return result;
    }, {});
}

function capitalizeWords(str) {
    return str
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
}