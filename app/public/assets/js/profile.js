document.addEventListener("DOMContentLoaded", async function () {
    await checkAdminStatus();
    await fetchUsers();
    await populateProfileForm();
    
    document.getElementById("search-input").addEventListener("input", applyFilters);
    document.getElementById("email-header").addEventListener("click", () => sortUsers("email"));
    document.getElementById("date-header").addEventListener("click", () => sortUsers("created_at"));
    document.getElementById("role-header").addEventListener("click", () => sortUsers("role"));

    document.getElementById("create-user-btn").addEventListener("click", function() {});
    document.getElementById("createUserForm").addEventListener("submit", handleCreateUser);

    document.getElementById("editProfileForm").addEventListener("submit", handleProfileUpdate);
    document.getElementById("showEditPasswordCheck").addEventListener("change", togglePasswordVisibility);
});

async function checkAdminStatus() {
    const response = await fetch('/api/authAdmin');
    const data = await response.json();

    if (!data.isAdmin) {
        document.querySelector(".user-management").style.display = "none";
    }
}

let users = [];
let sortDirection = { email: "asc", created_at: "asc" };

async function fetchUsers() {
    const response = await fetch('/api/getUsers');
    users = await response.json();
    applyFilters();
}

function applyFilters() {
    const searchInput = document.getElementById("search-input").value.toLowerCase();
    let filteredUsers = searchUsers(users, searchInput);
    renderUsers(filteredUsers);
}

function searchUsers(users, searchInput) {
    return users.filter(user => {
        return user.email.toLowerCase().includes(searchInput) || 
               user.role.toLowerCase().includes(searchInput);
    });
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

function renderUsers(usersToRender) {
    const tableBody = document.getElementById("userTable");
    tableBody.innerHTML = "";
    
    usersToRender.forEach(user => {
        const normalizedRole = user.role.charAt(0).toUpperCase() + user.role.slice(1).toLowerCase();
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="email" class="form-control email-input" value="${user.email}" data-id="${user.id}"></td>
            <td>${user.created_at}</td>
            <td>
                <select class="form-select role-select" data-id="${user.id}">
                    <option value="Customer" ${normalizedRole === 'Customer' ? 'selected' : ''}>Customer</option>
                    <option value="Administrator" ${normalizedRole === 'Administrator' ? 'selected' : ''}>Administrator</option>
                    <option value="Employee" ${normalizedRole === 'Employee' ? 'selected' : ''}>Employee</option>
                </select>
            </td>
            <td>
                <button class="btn btn-danger delete-btn" data-id="${user.id}">Delete</button>
            </td>
        `;

        tableBody.appendChild(row);
    });

    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", () => deleteUser(button.getAttribute("data-id")));
    });

    document.querySelectorAll(".role-select").forEach(select => {
        select.addEventListener("change", function () {
            updateUserRole(this.getAttribute("data-id"), this.value);
        });
    });
    document.querySelectorAll(".email-input").forEach(input => {
        input.addEventListener("change", function () {
            const newEmail = this.value.trim();
            const userId = this.getAttribute("data-id");

            if (!validateEmail(newEmail)) {
                alert("Invalid email format! Please enter a valid email.");
                this.value = this.defaultValue; 
                return;
            }
            updateUserEmail(userId, newEmail);
        });
    });
}

function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    return emailPattern.test(email);
}

async function deleteUser(userId) {
    const response = await fetch('/api/deleteUser', {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: userId })
    });

    const result = await response.json();
    
    if (result.success) {
        users = users.filter(user => user.id !== parseInt(userId));
        applyFilters();
    } else {
        alert("Error deleting user");
    }
}

async function updateUserRole(userId, newRole) {
    try {
        const response = await fetch('/api/updateUserRole', {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: userId, role: newRole })
        });
        
        const result = await response.json();

        if (result.success) {
            users = users.map(user => 
                user.id === parseInt(userId) ? { ...user, role: newRole } : user
            );
            applyFilters();
        } else {
            alert("Error updating user role");
        }
    } catch (error) {
        console.error("Error updating user role:", error);
        alert("Error updating user role");
    }
}

async function updateUserEmail(userId, newEmail) {
    try {
        const usersResponse = await fetch('/api/getUsers');
        const users = await usersResponse.json();

        if (users.some(user => user.email.toLowerCase() === newEmail.toLowerCase() && user.id !== parseInt(userId))) {
            alert("Error: This email is already in use.");
            document.querySelector(`.email-input[data-id='${userId}']`).value = users.find(user => user.id === parseInt(userId)).email;
            return;
        }

        const response = await fetch('/api/updateUserEmail', {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: userId, email: newEmail })
        });

        const result = await response.json();
        if (result.success) {
            users = users.map(user => 
                user.id === parseInt(userId) ? { ...user, email: newEmail } : user
            );
            applyFilters();
        } else {
            alert("Error updating user email");
        }
    } catch (error) {
        console.error("Error updating user email:", error);
        alert("Error updating user email");
    }
}

function openCreateUserModal() {
    let modal = new bootstrap.Modal(document.getElementById("createUserModal"));
    modal.show();
}

async function handleCreateUser(event) {
    event.preventDefault(); 

    const email = document.getElementById("newUserEmail").value.trim();
    const password = document.getElementById("newUserPassword").value.trim();
    const role = document.getElementById("newUserRole").value;

    if (!email || !password) {
        alert("Email and password are required.");
        return;
    }

    try {
        const usersResponse = await fetch('/api/getUsers');
        const users = await usersResponse.json();

        if (users.some(user => user.email.toLowerCase() === email.toLowerCase())) {
            alert("Error: A user with this email already exists.");
            return;
        }

        const response = await fetch('/api/createUser', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email, password, role })
        });

        const result = await response.json();

        if (result.success) {
            let modalElement = document.getElementById("createUserModal");
            let modalInstance = bootstrap.Modal.getInstance(modalElement);
            
            if (modalInstance) {
                modalInstance.hide(); // ✅ Correct Bootstrap method
            }

            // ✅ If Bootstrap doesn't work, manually remove modal backdrop
            setTimeout(() => {
                modalElement.style.display = "none";
                document.body.classList.remove("modal-open"); 
                document.querySelector(".modal-backdrop")?.remove();
            }, 300);

            await fetchUsers(); 
        } else {
            alert("Error: " + result.error);
        }
    } catch (error) {
        console.error("Error creating user:", error);
        alert("Failed to create user.");
    }
}

async function populateProfileForm() {
    try {
        const response = await fetch('/api/getUserEmailById');
        if (!response.ok) throw new Error("Failed to fetch profile");

        const user = await response.json();

        if (user) {
            document.getElementById("editEmail").value = user.email || "";
        }
    } catch (error) {
        console.error("Error fetching user profile:", error);
    }
}


async function handleProfileUpdate(event) {
    event.preventDefault();

    const emailField = document.getElementById("editEmail");
    const passwordField = document.getElementById("editPassword");
    const successMessage = document.getElementById("profileSuccessMessage");

    const newEmail = emailField?.value.trim();
    const newPassword = passwordField?.value.trim();

    if (!newEmail && !newPassword) {
        alert("Please enter a new email or password.");
        return;
    }

    if (newEmail && !validateEmail(newEmail)) {
        alert("Invalid email format!");
        return;
    }

    const updates = {};
    if (newEmail) updates.email = newEmail;
    if (newPassword) updates.password = newPassword;

    try {
        const response = await fetch('/api/updateUserProfile', {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(updates)
        });

        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }

        const result = await response.json();

        if (result.success) {
            if (newEmail) emailField.defaultValue = newEmail;
            passwordField.value = ""; 

            successMessage.classList.remove("d-none");
            setTimeout(() => {
                successMessage.classList.add("d-none");
            }, 3000);
        } else {
            alert("Error updating profile: " + (result.error || "Unknown error"));
        }
    } catch (error) {
        console.error("Error updating profile:", error);
        alert("Error updating profile. Check console for details.");
    }
}

function togglePasswordVisibility() {
    const passwordField = document.getElementById("editPassword");
    passwordField.type = this.checked ? "text" : "password";
}