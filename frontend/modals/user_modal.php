
<!-- Edit Modal -->
    <div class="modal fade editUser" id="editUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="card-body">
                            <form id="editUserForm" method="POST" enctype="multipart/form-data">
                                <input type="text" name="id" id="userId" hidden>
                                <div class="mb-3">
                                    <label for="editImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="editImage" name="image" required placeholder="Upload image">
                                </div>

                                <div class="mb-3">
                                    <label for="editFname" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="editFname" name="fname" required placeholder="Enter name">
                                </div>

                                <div class="mb-3">
                                    <label for="editAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="editAddress" name="address" required placeholder="Enter address">
                                </div>

                                <div class="mb-3">
                                    <label for="editContact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="editContact" name="contact" required placeholder="Enter contact">
                                </div>

                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" required placeholder="Enter email">
                                </div>

                                <div class="mb-3">
                                    <label for="editRole" class="form-label">Role</label>
                                    <select class="form-select" id="editRole" name="role" required>
                                        <option value="" disabled selected>Select role</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Registrar</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="editUserForm" class="btn btn-primary" id="editbtn">Update User</button>
                </div>
            </div>
        </div>
    </div>

<!-- Delete Modal -->
    <div class="modal fade" id="deleteUser" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <input type="text" name="id" id="deleteId" hidden>
          <div class="modal-body">
            <p>Are you sure you want to delete this student?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deletebtn">Delete</button>
          </div>
        </div>
      </div>
    </div>

<!-- Add User Modal --> 
    <div class="modal fade" id="addUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control image" id="image" name="image" required placeholder="Upload image">
                            <div class="mb-3">
                                <label for="fname" class="form-label">Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" required placeholder="Enter name">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required placeholder="Enter address">
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" required placeholder="Enter contact">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="addEmail" name="email" required placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Select role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Registrar</option>
                                </select>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" style="display:flex; align-items:center; gap:5px"id="addbtn">
                        Add User
                        <div class="spinner-border spinner-border-sm text-light" role="status" id="spinner" style="display:none">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

