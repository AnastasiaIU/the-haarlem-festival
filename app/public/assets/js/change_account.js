document.addEventListener("DOMContentLoaded", async function () {
    await populateProfileForm();

    document.getElementById("editProfileForm").addEventListener("submit", handleProfileUpdate);
    document.getElementById("showEditPasswordCheck").addEventListener("change", togglePasswordVisibility);
});

async function populateProfileForm() {
    try {
        const response = await fetch('/api/getUserEmailById');
        if (!response.ok) throw new Error("Failed to fetch profile");

        const user = await response.json();
        if (user && user.email) {
            document.getElementById("editEmail").value = user.email;
            document.getElementById("editName").value = user.name || "";
        }
    } catch (error) {
        console.error("Error fetching user profile:", error);
    }
}

function togglePasswordVisibility() {
    const passwordField = document.getElementById("editPassword");
    passwordField.type = this.checked ? "text" : "password";
}

function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

async function handleProfileUpdate(event) {
    event.preventDefault();

    const emailField = document.getElementById("editEmail");
    const passwordField = document.getElementById("editPassword");
    const successMessage = document.getElementById("profileSuccessMessage");
    const nameField = document.getElementById("editName");

    const newEmail = emailField.value.trim();
    const newPassword = passwordField.value.trim();
    const newName = nameField.value.trim();

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
    if (newName) updates.name = newName;

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
