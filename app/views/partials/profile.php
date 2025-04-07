<script type="module" src="../../assets/js/profile.js"></script>
<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
    <section class="card col-md-6 col-lg-5 col-xl-4 p-4 m-4" id="dashboardPanel">
    <div class="d-flex flex-column justify-content-center align-items-center gap-3 mb-3">
        <img src="../../assets/images/logo_form.svg" class="img-fluid image-height-40 form-logo" alt="Logo">
        <p class="h5 mb-0 medium-grey-text text-center">Account</p>
    </div>
    
    <div class="row g-2">
        <div class="col-6">
            <a href="/profile/change_account" class="btn btn-primary w-100">Change Account</a>
        </div>
        <div class="col-6">
            <a href="#" class="btn btn-primary w-100">Something Else</a>
        </div>

        <div class="col-6 d-none" id="adminUsersBtn">
            <a href="/profile/manage_users" class="btn btn-primary w-100">Manage Users</a>
        </div>
        <div class="col-6 d-none" id="adminEntitiesBtn">    
            <a href="/profile/manage_events" class="btn btn-primary w-100">Manage Events</a>
        </div>
    </div>
</section>
</main>