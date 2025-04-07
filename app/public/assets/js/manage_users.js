document.addEventListener("DOMContentLoaded", async function () {
    await checkAdminStatus();
    await fetchUsers();

    document.getElementById("search-input").addEventListener("input", applyFilters);
    document.getElementById("email-header").addEventListener("click", () => sortUsers("email"));
    document.getElementById("date-header").addEventListener("click", () => sortUsers("created_at"));
    document.getElementById("role-header").addEventListener("click", () => sortUsers("role"));
    document.getElementById("createUserForm").addEventListener("submit", handleCreateUser);
});

let users = [];
let sortDirection = { email: "asc", created_at: "asc", role: "asc" };

async function checkAdminStatus() {
    const response = await fetch('/api/authAdmin');
    const data = await response.json();
    if (!data.isAdmin) {
        document.querySelector(".user-management").style.display = "none";
    }
}

async function fetchUsers() {
    const response = await fetch('/api/getUsers');
    users = await response.json();
    applyFilters();
}

function applyFilters() {
    const searchInput = document.getElementById("search-input").value.toLowerCase();
    const filtered = users.filter(user =>
        user.email.toLowerCase().includes(searchInput) ||
        user.role.toLowerCase().includes(searchInput)
    );
    renderUsers(filtered);
}

function sortUsers(field) {
    sortDirection[field] = sortDirection[field] === "asc" ? "desc" : "asc";
    users.sort((a, b) => {
        if (field === "created_at") {
            return sortDirection[field] === "asc"
                ? new Date(a[field]) - new Date(b[field])
                : new Date(b[field]) - new Date(a[field]);
        } else {
            return sortDirection[field] === "asc"
                ? a[field].localeCompare(b[field])
                : b[field].localeCompare(a[field]);
        }
    });
    applyFilters();
}

function renderUsers(userList) {
    const tableBody = document.getElementById("userTable");
    tableBody.innerHTML = "";

    userList.forEach(user => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="email" class="form-control email-input" value="${user.email}" data-id="${user.id}"></td>
            <td>${user.created_at}</td>
            <td>
                <select class="form-select role-select" data-id="${user.id}">
                    <option value="Customer" ${user.role === 'Customer' ? 'selected' : ''}>Customer</option>
                    <option value="Administrator" ${user.role === 'Administrator' ? 'selected' : ''}>Administrator</option>
                    <option value="Employee" ${user.role === 'Employee' ? 'selected' : ''}>Employee</option>
                </select>
            </td>
            <td>
                <button class="btn btn-danger delete-btn" data-id="${user.id}">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    document.querySelectorAll(".delete-btn").forEach(btn =>
        btn.addEventListener("click", () => deleteUser(btn.dataset.id))
    );

    document.querySelectorAll(".role-select").forEach(select =>
        select.addEventListener("change", function () {
            updateUserRole(this.dataset.id, this.value);
        })
    );

    document.querySelectorAll(".email-input").forEach(input =>
        input.addEventListener("change", function () {
            const newEmail = this.value.trim();
            if (!validateEmail(newEmail)) {
                alert("Invalid email format.");
                this.value = this.defaultValue;
                return;
            }
            updateUserEmail(this.dataset.id, newEmail);
        })
    );
}

function validateEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
}

async function handleCreateUser(e) {
    e.preventDefault();
    const email = document.getElementById("newUserEmail").value.trim();
    const password = document.getElementById("newUserPassword").value.trim();
    const role = document.getElementById("newUserRole").value;

    if (!email || !password) return alert("Email and password are required.");

    const check = await fetch('/api/getUsers');
    const allUsers = await check.json();
    if (allUsers.some(u => u.email.toLowerCase() === email.toLowerCase())) {
        return alert("User with this email already exists.");
    }

    const res = await fetch('/api/createUser', {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password, role })
    });
    const result = await res.json();

    if (result.success) {
        bootstrap.Modal.getInstance(document.getElementById("createUserModal"))?.hide();
        await fetchUsers();
    } else {
        alert("Failed to create user: " + result.error);
    }
}

async function deleteUser(id) {
    const res = await fetch('/api/deleteUser', {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id })
    });
    const result = await res.json();
    if (result.success) {
        users = users.filter(user => user.id !== parseInt(id));
        applyFilters();
    } else {
        alert("Error deleting user.");
    }
}

async function updateUserRole(id, role) {
    const res = await fetch('/api/updateUserRole', {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, role })
    });
    const result = await res.json();
    if (!result.success) alert("Error updating role.");
}

async function updateUserEmail(id, email) {
    const check = await fetch('/api/getUsers');
    const allUsers = await check.json();
    if (allUsers.some(u => u.email.toLowerCase() === email.toLowerCase() && u.id !== parseInt(id))) {
        alert("Email already in use.");
        fetchUsers(); // revert input
        return;
    }

    const res = await fetch('/api/updateUserEmail', {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, email })
    });
    const result = await res.json();
    if (!result.success) alert("Error updating email.");
}
