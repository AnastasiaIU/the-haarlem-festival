<script type="module" src="../../assets/js/manage_events.js"></script>
<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
<section class="card col-md-12 col-lg-10 col-xl-9 p-4 m-4">
        <h5 class="mb-3">Manage Locations</h5>
        
        <!-- Search Bar -->
        <input type="text" id="searchLocationInput" placeholder="Search by name or address" class="form-control mb-3">

        <!-- Locations Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Card Description</th>
                        <th>Image</th>
                        <th>Card Image</th>
                        <th>Carousel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="locationsTable"></tbody>
            </table>
        </div>

        <!-- Add Location Button -->
        <button id="create-location-btn" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#locationModal">
            Add Location
        </button>
    </section>

    <!-- Location Modal (Add/Edit) -->
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
                            <img id="locationCardImagePreview" src="" width="100">
                            <img id="locationCarousel1Preview" src="" width="80">
                            <img id="locationCarousel2Preview" src="" width="80">
                            <img id="locationCarousel3Preview" src="" width="80">
                            <img id="locationCarousel4Preview" src="" width="80">
                            <img id="locationCarousel5Preview" src="" width="80">
                            <img id="locationCarousel6Preview" src="" width="80">
                        </div>
                    </div>
                    <label class="form-label">Upload Images</label>
                    <div class="mb-3">
                        <label class="form-label">Upload New Images</label>
                        <input type="file" class="form-control" id="locationImageUpload" accept="image/*">
                        <img id="locationImagePreview" src="" width="100" class="mt-2">
                        
                        <input type="file" class="form-control mt-2" id="locationCardImageUpload" accept="image/*">
                        <img id="locationCardImagePreview" src="" width="100" class="mt-2">
                        
                        <input type="file" class="form-control mt-2" id="locationCarousel1Upload" accept="image/*">
                        <img id="locationCarousel1Preview" src="" width="80" class="mt-2">

                        <input type="file" class="form-control mt-2" id="locationCarousel2Upload" accept="image/*">
                        <img id="locationCarousel2Preview" src="" width="80" class="mt-2">

                        <input type="file" class="form-control mt-2" id="locationCarousel3Upload" accept="image/*">
                        <img id="locationCarousel3Preview" src="" width="80" class="mt-2">

                        <input type="file" class="form-control mt-2" id="locationCarousel4Upload" accept="image/*">
                        <img id="locationCarousel4Preview" src="" width="80" class="mt-2">

                        <input type="file" class="form-control mt-2" id="locationCarousel5Upload" accept="image/*">
                        <img id="locationCarousel5Preview" src="" width="80" class="mt-2">

                        <input type="file" class="form-control mt-2" id="locationCarousel6Upload" accept="image/*">
                        <img id="locationCarousel6Preview" src="" width="80" class="mt-2">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>