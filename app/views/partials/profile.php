<script type="module" src="../../assets/js/profile.js"></script>
<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
<section class="card col-md-6 col-lg-5 col-xl-4 p-4 m-4">
        <form class="d-flex flex-column gap-2 needs-validation" id="editProfileForm" method="post" novalidate>
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <img src="../../assets/images/logo_form.svg" class="img-fluid image-height-40 form-logo"
                     alt="Logo">
                <p class="h5 mb-3 medium-grey-text">Edit Your Profile</p>
            </div>
            
            <!-- Email Field -->
            <div class="form-group">
                <label for="editEmail">Email address</label>
                <input type="email" name="email" class="form-control" id="editEmail"
                       placeholder="Enter new email" autocomplete="email" required>
                <div class="invalid-feedback" id="editEmailPrompt">
                    Email address cannot be empty.
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group mb-2">
                <label for="editPassword">New Password</label>
                <input type="password" name="password" class="form-control" id="editPassword"
                       placeholder="Enter new password" autocomplete="new-password">
                <div class="invalid-feedback" id="editPasswordPrompt">
                    Password cannot be empty.
                </div>
            </div>

            <!-- Show Password Toggle -->
            <div class="d-flex align-items-center mb-4">
                <input class="checkbox me-2" type="checkbox" value="" id="showEditPasswordCheck">
                <label for="showEditPasswordCheck">Show password</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
        </form>
    </section>

    <!-- Success Message -->
    <div id="profileSuccessMessage" class="alert alert-success col-md-6 col-lg-5 col-xl-4 d-none" role="alert">
        Profile updated successfully!
    </div>

<section class="card col-md-10 col-lg-8 col-xl-7 p-4 mb-4 user-management">
        <h5 class="mb-3">User Management</h5>
        <input type="text" id="search-input" placeholder="Search by email" class="form-control mb-3">

        <table class="table">
            <thead>
                <tr>
                    <th id="email-header" style="cursor: pointer;">Email ⬍</th>
                    <th id="date-header" style="cursor: pointer;">Registration Date ⬍</th>
                    <th id="role-header" style="cursor: pointer;">Role ⬍</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTable"></tbody>
        </table>

        <button id="create-user-btn" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Create User
        </button>
    </section>

    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createUserForm">
                        <div class="mb-3">
                            <label for="newUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="newUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="newUserPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="newUserPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newUserRole" class="form-label">Role</label>
                            <select class="form-select" id="newUserRole">
                                <option value="Customer">Customer</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Employee">Employee</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<a href="/profile/manage_events" class="btn btn-primary mb-3">Manage Events</a>
</main>