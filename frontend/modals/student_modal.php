<!-- Edit Modal -->
    <div class="modal fade" id="edit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="id" name="id" value="">
                                
                                <div class="mb-3">
                                    <label for="editImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="editImage" name="image" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editFirstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="editFirstname" name="firstname" required placeholder="Enter firstname">
                                </div>

                                <div class="mb-3">
                                    <label for="editLastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="editLastname" name="lastname" required placeholder="Enter lastname">
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
                                    <label for="editAge" class="form-label">Age</label>
                                    <input type="text" class="form-control" id="editAge" name="age" required placeholder="Enter age">
                                </div>

                                <div class="mb-3">
                                    <label for="editCourse" class="form-label">Course</label>
                                    <select class="form-select" id="editCourse" name="course" required>
                                        <option value="1">BSIT</option>
                                        <option value="2">BSED-SS</option>
                                        <option value="3">BSED-MATH</option>
                                        <option value="4">BEED</option>
                                        <option value="5">BS-ENTREP</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editYear" class="form-label">Year Level</label>
                                    <select class="form-select" id="editYear" name="year" required>
                                        <option value="1ST Year">1ST Year</option>
                                        <option value="2ND Year">2ND Year</option>
                                        <option value="3RD Year">3RD Year</option>
                                        <option value="4TH Year">4TH Year</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" required placeholder="Enter email">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updatebtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<!-- Delete Modal -->
        <div class="modal fade" id="delete" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id" value="">
                    <p>Are you sure you want to delete this student?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deletebtn">Delete</button>
                </div>
                </div>
            </div>
        </div>
