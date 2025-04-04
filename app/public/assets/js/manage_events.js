document.addEventListener("DOMContentLoaded", () => {
    fetchLocations();
});

function fetchLocations() {
    // Ensure this is only run after the DOM is ready
    const tableBody = document.getElementById("locationsTable");
    if (!tableBody) {
        console.error("Locations table element not found!");
        return; // Exit if the table body is missing
    }

    fetch("/api/getLocations")
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = "";  // Clear existing content
            data.forEach(location => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${location.name}</td>
                        <td>${location.slug}</td>
                        <td>${location.address}</td>
                        <td>${location.description.substring(0, 50)}...</td>
                        <td>${location.card_description.substring(0, 50)}...</td>
                        <td><img src="/assets/images/${location.image}" width="100"></td>
                        <td><img src="/assets/images/${location.card_image}" width="100"></td>
                        <td>
                            ${location.carousel_image1 ? `<img src="/assets/images/${location.carousel_image1}" width="80">` : ""}
                            ${location.carousel_image2 ? `<img src="/assets/images/${location.carousel_image2}" width="80">` : ""}
                            ${location.carousel_image3 ? `<img src="/assets/images/${location.carousel_image3}" width="80">` : ""}
                            ${location.carousel_image4 ? `<img src="/assets/images/${location.carousel_image4}" width="80">` : ""}
                            ${location.carousel_image5 ? `<img src="/assets/images/${location.carousel_image5}" width="80">` : ""}
                            ${location.carousel_image6 ? `<img src="/assets/images/${location.carousel_image6}" width="80">` : ""}
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm mb-1" onclick="openEditModal(
                                ${location.id}, 
                                '${location.name}', 
                                '${location.slug}', 
                                '${location.address}', 
                                '${location.description}', 
                                '${location.card_description}', 
                                '${location.image}', 
                                '${location.card_image}', 
                                '${location.carousel_image1}', 
                                '${location.carousel_image2}', 
                                '${location.carousel_image3}', 
                                '${location.carousel_image4}', 
                                '${location.carousel_image5}', 
                                '${location.carousel_image6}'
                            )">
                            Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteLocation(${location.id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error("Error fetching locations:", error);
        });
}

window.openEditModal = function(id, name, slug, address, description, card_description, image, card_image, carousel1, carousel2, carousel3, carousel4, carousel5, carousel6) {
    // Check that elements exist before attempting to modify them
    const locationIdField = document.getElementById("locationId");
    const locationNameField = document.getElementById("locationName");
    const locationSlugField = document.getElementById("locationSlug");
    const locationAddressField = document.getElementById("locationAddress");
    const locationDescriptionField = document.getElementById("locationDescription");
    const locationCardDescriptionField = document.getElementById("locationCardDescription");

    if (locationIdField && locationNameField && locationSlugField && locationAddressField && locationDescriptionField && locationCardDescriptionField) {
        locationIdField.value = id;
        locationNameField.value = name;
        locationSlugField.value = slug;
        locationAddressField.value = address;
        locationDescriptionField.value = description;
        locationCardDescriptionField.value = card_description;

        // Show current images
        document.getElementById("locationImagePreview").src = `/assets/images/${image}`;
        document.getElementById("locationCardImagePreview").src = `/assets/images/${card_image}`;
        document.getElementById("locationCarousel1Preview").src = carousel1 ? `/assets/images/${carousel1}` : "";
        document.getElementById("locationCarousel2Preview").src = carousel2 ? `/assets/images/${carousel2}` : "";
        document.getElementById("locationCarousel3Preview").src = carousel3 ? `/assets/images/${carousel3}` : "";
        document.getElementById("locationCarousel4Preview").src = carousel4 ? `/assets/images/${carousel4}` : "";
        document.getElementById("locationCarousel5Preview").src = carousel5 ? `/assets/images/${carousel5}` : "";
        document.getElementById("locationCarousel6Preview").src = carousel6 ? `/assets/images/${carousel6}` : "";

        // Show the modal
        document.getElementById("locationModalTitle").innerText = "Edit Location";
        new bootstrap.Modal(document.getElementById("locationModal")).show();
    } else {
        console.error("One or more modal input elements are missing!");
    }
};
// Open Edit Modal & Populate Fields
function openEditModal(id, name, slug, address, description, card_description, image, card_image, carousel1, carousel2, carousel3, carousel4, carousel5, carousel6) {
    document.getElementById("locationId").value = id;
    document.getElementById("locationName").value = name;
    document.getElementById("locationSlug").value = slug;
    document.getElementById("locationAddress").value = address;
    document.getElementById("locationDescription").value = description;
    document.getElementById("locationCardDescription").value = card_description;

    // Show current images
    document.getElementById("locationImagePreview").src = `/assets/images/${image}`;
    document.getElementById("locationCardImagePreview").src = `/assets/images/${card_image}`;
    document.getElementById("locationCarousel1Preview").src = carousel1 ? `/assets/images/${carousel1}` : "";
    document.getElementById("locationCarousel2Preview").src = carousel2 ? `/assets/images/${carousel2}` : "";
    document.getElementById("locationCarousel3Preview").src = carousel3 ? `/assets/images/${carousel3}` : "";
    document.getElementById("locationCarousel4Preview").src = carousel4 ? `/assets/images/${carousel4}` : "";
    document.getElementById("locationCarousel5Preview").src = carousel5 ? `/assets/images/${carousel5}` : "";
    document.getElementById("locationCarousel6Preview").src = carousel6 ? `/assets/images/${carousel6}` : "";
    
    // Show the modal
    document.getElementById("locationModalTitle").innerText = "Edit Location";
    new bootstrap.Modal(document.getElementById("locationModal")).show();
}

// Save Changes (Update Location)
document.getElementById("locationForm").addEventListener("submit", function (e) {
    e.preventDefault();
    
    const id = document.getElementById("locationId").value;
    const formData = new FormData();

    // Append text fields
    formData.append("name", document.getElementById("locationName").value);
    formData.append("slug", document.getElementById("locationSlug").value);
    formData.append("address", document.getElementById("locationAddress").value);
    formData.append("description", document.getElementById("locationDescription").value);
    formData.append("card_description", document.getElementById("locationCardDescription").value);

    // Append images only if selected
    const imageFields = [
        { id: "locationImageUpload", key: "image", previewId: "locationImagePreview" },
        { id: "locationCardImageUpload", key: "card_image", previewId: "locationCardImagePreview" },
        { id: "locationCarousel1Upload", key: "carousel_image1", previewId: "locationCarousel1Preview" },
        { id: "locationCarousel2Upload", key: "carousel_image2", previewId: "locationCarousel2Preview" },
        { id: "locationCarousel3Upload", key: "carousel_image3", previewId: "locationCarousel3Preview" },
        { id: "locationCarousel4Upload", key: "carousel_image4", previewId: "locationCarousel4Preview" },
        { id: "locationCarousel5Upload", key: "carousel_image5", previewId: "locationCarousel5Preview" },
        { id: "locationCarousel6Upload", key: "carousel_image6", previewId: "locationCarousel6Preview" }
    ];

    imageFields.forEach(({ id, key, previewId }) => {
        const file = document.getElementById(id).files[0];
        if (file) {
            formData.append(key, file);
            
            // Display image preview
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    fetch(`/api/updateLocation/${id}`, {
        method: "POST", 
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchLocations(); 
            bootstrap.Modal.getInstance(document.getElementById("locationModal")).hide();
        } else {
            alert(data.message); 
        }
    })
    .catch(error => {
        alert("An error occurred while updating the location.");
    });
});

document.getElementById("locationImageUpload").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("locationImagePreview").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

function handleImageUpload(inputId, previewId) {
    document.getElementById(inputId).addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

const imageFields = [
    ["locationImageUpload", "locationImagePreview"],
    ["locationCardImageUpload", "locationCardImagePreview"],
    ["locationCarousel1Upload", "locationCarousel1Preview"],
    ["locationCarousel2Upload", "locationCarousel2Preview"],
    ["locationCarousel3Upload", "locationCarousel3Preview"],
    ["locationCarousel4Upload", "locationCarousel4Preview"],
    ["locationCarousel5Upload", "locationCarousel5Preview"],
    ["locationCarousel6Upload", "locationCarousel6Preview"],
];

imageFields.forEach(([inputId, previewId]) => handleImageUpload(inputId, previewId));