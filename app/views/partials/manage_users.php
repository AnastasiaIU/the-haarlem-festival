<script type="module" src="../../assets/js/manage_users.js"></script>
<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
    <section class="card col-md-10 col-lg-8 col-xl-7 p-4 m-4 user-management">
            <h5 class="mb-3">User Management</h5>
            <input type="text" id="search-input" placeholder="Search by email" class="form-control mb-3">

            <table class="table">
                <thead>
                    <tr>
                        <th id="email-header" style="cursor: pointer;">Email ⬍</th>
                        <th id="name-header" style="cursor: pointer;">Name ⬍</th>
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
                            <div>
                                <label for="newUserName" class="form-label">Name</label>
                                <input type="name" class="form-control" id="newUserName" required>
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
</main>