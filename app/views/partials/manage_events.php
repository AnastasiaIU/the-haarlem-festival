<script type="module" src="../../assets/js/manage_events.js"></script>
<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
<section class="card col-md-12 col-lg-10 col-xl-9 p-4 m-4">
        <h5 class="mb-3">Manage Locations</h5>
        
        <input type="text" id="searchLocationInput" placeholder="Search by name or address" class="form-control mb-3">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="locationsTable"></tbody>
            </table>
        </div>

        <button id="create-location-btn" class="btn btn-primary m-2">
            Add Location
        </button>
    </section>

    <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalTitle">Add Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="locationForm">
                    <input type="hidden" id="locationId">
                    <div class="mb-3">
                        <label for="locationName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="locationName" required>
                    </div>
                    <div class="mb-3">
                        <label for="locationSlug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="locationSlug">
                    </div>
                    <div class="mb-3">
                        <label for="locationAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="locationAddress">
                    </div>
                    <div class="mb-3">
                        <label for="locationDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="locationDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="locationCardDescription" class="form-label">Card Description</label>
                        <textarea class="form-control" id="locationCardDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload New Images</label>
                        <div class="d-flex flex-wrap gap-2">
                            <img id="locationImagePreview" src="" width="100">
                            <input type="file" class="form-control" id="locationImageUpload" accept="image/*">
                            <img id="locationCardImagePreview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCardImageUpload" accept="image/*">
                            <img id="locationCarousel1Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCarousel1Upload" accept="image/*">
                            <img id="locationCarousel2Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCarousel2Upload" accept="image/*">
                            <img id="locationCarousel3Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCarousel3Upload" accept="image/*">
                            <img id="locationCarousel4Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCarousel4Upload" accept="image/*">
                            <img id="locationCarousel5Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCarousel5Upload" accept="image/*">
                            <img id="locationCarousel6Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="locationCarousel6Upload" accept="image/*">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="card col-md-12 col-lg-10 col-xl-9 p-4 m-4">
    <h5 class="mb-3">Manage Artists</h5>
    
    <input type="text" id="searchArtistInput" placeholder="Search by artist's name" class="form-control mb-3">

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="artistsTable"></tbody>
        </table>
    </div>

    <button id="create-artist-btn" class="btn btn-primary m-2">
        Add Artist
    </button>
</section>

<div class="modal fade" id="artistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="artistModalTitle">Add Artist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="artistForm">
                    <input type="hidden" id="artistId">
                    <div class="mb-3">
                        <label for="artistStageName" class="form-label">Stage Name</label>
                        <input type="text" class="form-control" id="artistStageName" required>
                    </div>
                    <div class="mb-3">
                        <label for="artistSlug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="artistSlug">
                    </div>
                    <div class="mb-3">
                        <label for="artistGenre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="artistGenre">
                    </div>
                    <div class="mb-3">
                        <label for="artistHeroDescription" class="form-label">Hero Description</label>
                        <textarea class="form-control" id="artistHeroDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="artistCardDescription" class="form-label">Card Description</label>
                        <textarea class="form-control" id="artistCardDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Images</label>
                        <div class="d-flex flex-wrap gap-2">
                            <img id="artistImagePreview" src="" width="100">
                            <input type="file" class="form-control" id="artistImageUpload" accept="image/*">
                            <img id="artistCardImagePreview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCardImageUpload" accept="image/*">
                            <img id="artistCarousel1Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCarousel1Upload" accept="image/*">
                            <img id="artistCarousel2Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCarousel2Upload" accept="image/*">
                            <img id="artistCarousel3Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCarousel3Upload" accept="image/*">
                            <img id="artistCarousel4Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCarousel4Upload" accept="image/*">
                            <img id="artistCarousel5Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCarousel5Upload" accept="image/*">
                            <img id="artistCarousel6Preview" src="" width="100">
                            <input type="file" class="form-control mt-2" id="artistCarousel6Upload" accept="image/*">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Artist</button>
                </form>
            </div>
        </div>
    </div>
</div>

</main>