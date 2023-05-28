<!-- Add user modal -->
<div class="modal fade" id="add-user-modal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
            </div>
            <div class="modal-body">
                <form action="users-add.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off"
                            id="username" name="username" maxlength="15" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control form-control-sm shadow-none" autocomplete="off"
                            id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off"
                            id="fullname" name="fullname" maxlength="150" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select form-select-sm shadow-none" id="role" name="role">
                            <option value="Cashier" selected>Cashier</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary" name="submit">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit user modal -->
<div class="modal fade" id="edit-user-modal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
            </div>
            <div class="modal-body">
                <form action="users-edit.php" method="POST">
                    <input type="hidden" id="user-id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off"
                            id="username" name="username" maxlength="15" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off"
                            id="fullname" name="fullname" maxlength="150" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select form-select-sm shadow-none" id="role" name="role">
                            <option value="Cashier" selected>Cashier</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success" name="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete user modal -->
<div class="modal fade" id="delete-user-modal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
            </div>
            <div class="modal-body">
                <p>Do you want to remove this user?</p>
                <form action="users-delete.php" method="POST">
                    <input type="hidden" id="user-id" name="id">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger" name="submit">Confirm Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>