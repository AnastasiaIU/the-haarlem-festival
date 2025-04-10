document.addEventListener("DOMContentLoaded", () => {
    fetchLocations();
    document.getElementById("create-location-btn").addEventListener("click", openCreateModal);
    document.getElementById("searchLocationInput").addEventListener("input", applySearchLocations);

    fetchArtists();
    document.getElementById("searchArtistInput").addEventListener("input", applySearchArtists);
    document.getElementById("create-artist-btn").addEventListener("click", openCreateArtistModal);
});

let locations = [];

function fetchLocations() {
    const tableBody = document.getElementById("locationsTable");
    if (!tableBody) {
        console.error("Locations table element not found!");
        return;
    }

    fetch("/api/getLocations")
        .then(response => response.json())
        .then(data => {
            locations = data; 
            applySearchLocations();    
        })
        .catch(error => {
            console.error("Error fetching locations:", error);
        });
}

function applySearchLocations() {
    const searchInput = document.getElementById("searchLocationInput").value.toLowerCase();
    const filtered = locations.filter(location =>
        location.name.toLowerCase().includes(searchInput) ||
        location.address.toLowerCase().includes(searchInput)
    );
    renderLocations(filtered);
}

function renderLocations(locationList) {
    const tableBody = document.getElementById("locationsTable");
    tableBody.innerHTML = "";  // Clear any existing rows

    locationList.forEach(location => {
        const row = document.createElement("tr");
        row.id = `location-row-${location.id}`;
        row.innerHTML = `
            <td>${location.name}</td>
            <td>${location.slug}</td>
            <td>${location.address}</td>
            <td>
                <button class="btn btn-primary btn-sm mb-1" onclick="openEditModal(
                    ${location.id}, 
                    '${location.name}', 
                    '${location.slug}', 
                    '${location.address}', 
                    \`${location.description || ""}\`, 
                    \`${location.card_description || ""}\`, 
                    '${location.image || ""}', 
                    '${location.card_image || ""}', 
                    '${location.carousel_image1 || ""}', 
                    '${location.carousel_image2 || ""}', 
                    '${location.carousel_image3 || ""}', 
                    '${location.carousel_image4 || ""}', 
                    '${location.carousel_image5 || ""}', 
                    '${location.carousel_image6 || ""}'
                )">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteLocation(${location.id})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
/** 
 * Edit Location
*/
window.openEditModal = function(id, name, slug, address, description, card_description, image, card_image, carousel1, carousel2, carousel3, carousel4, carousel5, carousel6) {
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

        document.getElementById("locationImagePreview").src = `/assets/images/${image}`;
        document.getElementById("locationCardImagePreview").src = `/assets/images/${card_image}`;
        document.getElementById("locationCarousel1Preview").src = carousel1 ? `/assets/images/${carousel1}` : "";
        document.getElementById("locationCarousel2Preview").src = carousel2 ? `/assets/images/${carousel2}` : "";
        document.getElementById("locationCarousel3Preview").src = carousel3 ? `/assets/images/${carousel3}` : "";
        document.getElementById("locationCarousel4Preview").src = carousel4 ? `/assets/images/${carousel4}` : "";
        document.getElementById("locationCarousel5Preview").src = carousel5 ? `/assets/images/${carousel5}` : "";
        document.getElementById("locationCarousel6Preview").src = carousel6 ? `/assets/images/${carousel6}` : "";

        document.getElementById("locationModalTitle").innerText = "Edit Location";
        new bootstrap.Modal(document.getElementById("locationModal")).show();
    } else {
        console.error("One or more modal input elements are missing!");
    }
};

document.getElementById("locationForm").addEventListener("submit", function (e) {
    e.preventDefault();
    
    const id = document.getElementById("locationId").value;
    const formData = new FormData();

    formData.append("name", document.getElementById("locationName").value);
    formData.append("slug", document.getElementById("locationSlug").value);
    formData.append("address", document.getElementById("locationAddress").value);
    formData.append("description", document.getElementById("locationDescription").value);
    formData.append("card_description", document.getElementById("locationCardDescription").value);

    const locationImageFields = [
        { id: "locationImageUpload", key: "image", previewId: "locationImagePreview" },
        { id: "locationCardImageUpload", key: "card_image", previewId: "locationCardImagePreview" },
        { id: "locationCarousel1Upload", key: "carousel_image1", previewId: "locationCarousel1Preview" },
        { id: "locationCarousel2Upload", key: "carousel_image2", previewId: "locationCarousel2Preview" },
        { id: "locationCarousel3Upload", key: "carousel_image3", previewId: "locationCarousel3Preview" },
        { id: "locationCarousel4Upload", key: "carousel_image4", previewId: "locationCarousel4Preview" },
        { id: "locationCarousel5Upload", key: "carousel_image5", previewId: "locationCarousel5Preview" },
        { id: "locationCarousel6Upload", key: "carousel_image6", previewId: "locationCarousel6Preview" }
    ];

    locationImageFields.forEach(({ id, key, previewId }) => {
        const file = document.getElementById(id).files[0];
        if (file) {
            formData.append(key, file);

            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    const apiUrl = id ? `/api/updateLocation/${id}` : '/api/createLocation';

    fetch(apiUrl, {
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
        alert("An error occurred while saving the location.");
    });
});

const locationImageFields = [
    ["locationImageUpload", "locationImagePreview"],
    ["locationCardImageUpload", "locationCardImagePreview"],
    ["locationCarousel1Upload", "locationCarousel1Preview"],
    ["locationCarousel2Upload", "locationCarousel2Preview"],
    ["locationCarousel3Upload", "locationCarousel3Preview"],
    ["locationCarousel4Upload", "locationCarousel4Preview"],
    ["locationCarousel5Upload", "locationCarousel5Preview"],
    ["locationCarousel6Upload", "locationCarousel6Preview"],
];

locationImageFields.forEach(([inputId, previewId]) => handleImageUpload(inputId, previewId));

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

/**
 * Create Location
 */
function openCreateModal() {
    document.getElementById("locationId").value = "";  
    document.getElementById("locationName").value = ""; 
    document.getElementById("locationSlug").value = "";  
    document.getElementById("locationAddress").value = "";  
    document.getElementById("locationDescription").value = "";
    document.getElementById("locationCardDescription").value = ""; 

    document.getElementById("locationImagePreview").src = ""; 
    document.getElementById("locationCardImagePreview").src = "";
    document.getElementById("locationCarousel1Preview").src = "";
    document.getElementById("locationCarousel2Preview").src = "";
    document.getElementById("locationCarousel3Preview").src = "";
    document.getElementById("locationCarousel4Preview").src = "";
    document.getElementById("locationCarousel5Preview").src = "";
    document.getElementById("locationCarousel6Preview").src = "";

    document.getElementById("locationModalTitle").innerText = "Add Location";

    new bootstrap.Modal(document.getElementById("locationModal")).show();
}

/**
 * Delete Location
 */
window.deleteLocation = function(id) {
    fetch(`/api/deleteLocation/${id}`, {
        method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const row = document.getElementById(`location-row-${id}`);
            if (row) {
                row.remove();
            }
        } else {
            alert("Failed to delete location.");
        }
    })
    .catch(error => {
        console.error("Error deleting location:", error);
        alert("An error occurred while deleting the location.");
    });
};

/**
 * Artists
 */
let artists = [];

function fetchArtists() {
    const tableBody = document.getElementById("artistsTable");
    if (!tableBody) {
        console.error("Artists table element not found!");
        return;
    }

    fetch("/api/getArtists")
        .then(response => response.json())
        .then(data => {
            artists = data;
            applySearchArtists();
        })
        .catch(error => {
            console.error("Error fetching artists:", error);
        });
}

function applySearchArtists() {
    const searchInput = document.getElementById("searchArtistInput").value.toLowerCase();
    const filtered = artists.filter(artist =>
        artist.stage_name.toLowerCase().includes(searchInput) ||
        artist.genre.toLowerCase().includes(searchInput)
    );
    renderArtists(filtered);
}

function renderArtists(artistList) {
    const tableBody = document.getElementById("artistsTable");
    tableBody.innerHTML = "";

    artistList.forEach(artist => {
        const heroDesc = escapeHTMLAttribute(artist.hero_description || "");
        const cardDesc = escapeHTMLAttribute(artist.card_description || "");
        const row = document.createElement("tr");
        row.id = `artist-row-${artist.id}`;
        row.innerHTML = `
            <td>${artist.stage_name}</td>
            <td>${artist.slug}</td>
            <td>${artist.genre}</td>
            <td>
                <button class="btn btn-primary btn-sm mb-1" onclick="openEditArtistModal(
                    ${artist.id}, 
                    '${artist.stage_name}', 
                    '${artist.slug}', 
                    '${artist.genre}', 
                    \`${heroDesc}\`, 
                    \`${cardDesc}\`,
                    '${artist.image || ""}',
                    '${artist.card_image || ""}',
                    '${artist.carousel_image1 || ""}',
                    '${artist.carousel_image2 || ""}',
                    '${artist.carousel_image3 || ""}',
                    '${artist.carousel_image4 || ""}',
                    '${artist.carousel_image5 || ""}',
                    '${artist.carousel_image6 || ""}'
                )">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteArtist(${artist.id})">Delete</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function escapeHTMLAttribute(str) {
    return str
        .replace(/&/g, "&amp;")
        .replace(/"/g, "&quot;")  
        .replace(/'/g, "&#39;")  
        .replace(/`/g, "&#96;"); 
}

/**
 * Edit Artist
 */
window.openEditArtistModal = function(id, stageName, slug, genre, heroDescription, cardDescription, image, cardImage, carousel1, carousel2, carousel3, carousel4, carousel5, carousel6) {
    const artistIdField = document.getElementById("artistId");
    const artistStageNameField = document.getElementById("artistStageName");
    const artistSlugField = document.getElementById("artistSlug");
    const artistGenreField = document.getElementById("artistGenre");
    const artistHeroDescriptionField = document.getElementById("artistHeroDescription");
    const artistCardDescriptionField = document.getElementById("artistCardDescription");

    if (artistIdField && artistStageNameField && artistSlugField && artistGenreField && artistHeroDescriptionField && artistCardDescriptionField) {
        artistIdField.value = id;
        artistStageNameField.value = stageName;
        artistSlugField.value = slug;
        artistGenreField.value = genre;
        artistHeroDescriptionField.value = heroDescription;
        artistCardDescriptionField.value = cardDescription;

        document.getElementById("artistImagePreview").src = image ? `/assets/images/${image}` : "";
        document.getElementById("artistCardImagePreview").src = cardImage ? `/assets/images/${cardImage}` : "";
        document.getElementById("artistCarousel1Preview").src = carousel1 ? `/assets/images/${carousel1}` : "";
        document.getElementById("artistCarousel2Preview").src = carousel2 ? `/assets/images/${carousel2}` : "";
        document.getElementById("artistCarousel3Preview").src = carousel3 ? `/assets/images/${carousel3}` : "";
        document.getElementById("artistCarousel4Preview").src = carousel4 ? `/assets/images/${carousel4}` : "";
        document.getElementById("artistCarousel5Preview").src = carousel5 ? `/assets/images/${carousel5}` : "";
        document.getElementById("artistCarousel6Preview").src = carousel6 ? `/assets/images/${carousel6}` : "";

        document.getElementById("artistModalTitle").innerText = "Edit Artist";
        new bootstrap.Modal(document.getElementById("artistModal")).show();
    } else {
        console.error("One or more modal input elements are missing!");
    }
};

document.getElementById("artistForm").addEventListener("submit", function (e) {
    e.preventDefault();
    
    const id = document.getElementById("artistId").value;
    const formData = new FormData();

    formData.append("stage_name", document.getElementById("artistStageName").value);
    formData.append("slug", document.getElementById("artistSlug").value);
    formData.append("genre", document.getElementById("artistGenre").value);
    formData.append("hero_description", document.getElementById("artistHeroDescription").value);
    formData.append("card_description", document.getElementById("artistCardDescription").value);

    const locationImageFields = [
        { id: "artistImageUpload", key: "image", previewId: "artistImagePreview" },
        { id: "artistCardImageUpload", key: "card_image", previewId: "artistCardImagePreview" },
        { id: "artistCarousel1Upload", key: "carousel_image1", previewId: "artistCarousel1Preview" },
        { id: "artistCarousel2Upload", key: "carousel_image2", previewId: "artistCarousel2Preview" },
        { id: "artistCarousel3Upload", key: "carousel_image3", previewId: "artistCarousel3Preview" },
        { id: "artistCarousel4Upload", key: "carousel_image4", previewId: "artistCarousel4Preview" },
        { id: "artistCarousel5Upload", key: "carousel_image5", previewId: "artistCarousel5Preview" },
        { id: "artistCarousel6Upload", key: "carousel_image6", previewId: "artistCarousel6Preview" }
    ];

    locationImageFields.forEach(({ id, key, previewId }) => {
        const file = document.getElementById(id).files[0];
        if (file) {
            formData.append(key, file);

            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    const apiUrl = id ? `/api/updateArtist/${id}`: '/api/createArtist';

    fetch(apiUrl, {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchArtists(); 
            bootstrap.Modal.getInstance(document.getElementById("artistModal")).hide();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert("An error occurred while updating the artist.");
    });
});

/**
 * Create Artist
 */
function openCreateArtistModal() {
    document.getElementById("artistId").value = "";  
    document.getElementById("artistStageName").value = ""; 
    document.getElementById("artistSlug").value = "";  
    document.getElementById("artistGenre").value = "";  
    document.getElementById("artistHeroDescription").value = "";
    document.getElementById("artistCardDescription").value = ""; 

    document.getElementById("artistImagePreview").src = ""; 
    document.getElementById("artistCardImagePreview").src = "";
    document.getElementById("artistCarousel1Preview").src = "";
    document.getElementById("artistCarousel2Preview").src = "";
    document.getElementById("artistCarousel3Preview").src = "";
    document.getElementById("artistCarousel4Preview").src = "";
    document.getElementById("artistCarousel5Preview").src = "";
    document.getElementById("artistCarousel6Preview").src = "";

    document.getElementById("artistModalTitle").innerText = "Add Artist";

    new bootstrap.Modal(document.getElementById("artistModal")).show();
}

const artistImageFields = [
    ["artistImageUpload", "artistImagePreview"],
    ["artistCardImageUpload", "artistCardImagePreview"],
    ["artistCarousel1Upload", "artistCarousel1Preview"],
    ["artistCarousel2Upload", "artistCarousel2Preview"],
    ["artistCarousel3Upload", "artistCarousel3Preview"],
    ["artistCarousel4Upload", "artistCarousel4Preview"],
    ["artistCarousel5Upload", "artistCarousel5Preview"],
    ["artistCarousel6Upload", "artistCarousel6Preview"],
];

artistImageFields.forEach(([inputId, previewId]) => handleImageUpload(inputId, previewId));

/**
 * Delete Artist
 */
window.deleteArtist = function(id) {
    fetch(`/api/deleteArtist/${id}`, {
        method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const row = document.getElementById(`artist-row-${id}`);
            if (row) {
                row.remove();
            }
        } else {
            alert("Failed to delete artist.");
        }
    })
    .catch(error => {
        console.error("Error deleting artist:", error);
        alert("An error occurred while deleting the artist.");
    });
};