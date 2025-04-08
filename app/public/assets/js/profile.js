document.addEventListener("DOMContentLoaded", function () {
    checkAdminStatus();
});

async function checkAdminStatus() {
    const response = await fetch('/api/authAdmin');
    const data = await response.json();

    if (data.isAdmin) {
        document.getElementById("adminUsersBtn").classList.remove("d-none");
        document.getElementById("adminEntitiesBtn").classList.remove("d-none");
        document.getElementById("adminOrdersBtn").classList.remove("d-none");
    }
}
