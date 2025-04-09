<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
     
<div class="main d-flex " style="width:100%;" >
    <div class="left-side p-3" style="background-color: blue; width:300px; height:100vh; position:sticky; top:0 ; left:0;">
                <?php include 'partial/sidebar.php'; ?>
    </div>

<div class="d-flex flex-column" style="width: 100%;">
    
    <?php include 'partial/navbar.php'; ?>


    
        
                <div class="container mt-2">

            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addstudent">Add Student</a>

            <table class="table table-striped table-bordered" id="students">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th class="col-1">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>

            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = 'index.php';
            }

            fetch('http://127.0.0.1:8000/api/students', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => response.json())
            .then(data => {
                $('#students').DataTable({
                    data: data,
                    columns: [
                        { data: 'id' },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'email' },
                        {   
                            data: null,
                            render: function(data, type, row){
                                return `
                                <div class="d-flex gap-3" >
                                    <a class="text-decoration-none editbtn"
                                    data-id="${row.id}"
                                    data-firstname="${row.first_name}"
                                    data-lastname="${row.last_name}"
                                    data-email="${row.email}"
                                    data-bs-toggle="modal" data-bs-target="#edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path> <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path> <path d="M16 5l3 3"></path> </svg> 
                                    </a>
                                    <a style="color:red" id="trashcan" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete" data-id="${row.id}">
                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg>
                                    </a>
                                </div>`;
                            }
                        }
                    ]
                });
            })
            .catch(error => console.error("Error fetching students:", error));
        });
    </script>


<!-- edit modal -->
<div class="modal fade" id="edit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card shadow">
        <div class="card-body">
            <form action="" method="POST">
                <input type="hidden" id="id" name="id" value="">
                <!--  Name & lastname Field -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">FirstName</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required placeholder="Enter firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">LastName</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required placeholder="Enter lastname">
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email">
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

<!-- delete modal -->
<div class="modal fade" id="delete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
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

<!-- add student modal -->
<div class="modal fade" id="addstudent" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card shadow">
        <div class="card-body">
            <form action="" method="POST">
                <input type="hidden" id="id" name="id" value="">
                <!--  Name & lastname Field -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">FirstName</label>
                    <input type="text" class="form-control" id="firstName" name="firstname" required placeholder="Enter firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">LastName</label>
                    <input type="text" class="form-control" id="lastName" name="lastname" required placeholder="Enter lastname">
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="addEmail" name="email" required placeholder="Enter email">
                </div>
            </form>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addbtn">Add Student</button>
      </div>
    </div>
  </div>
</div>

   

<!-- pagpadisplay sa pangan nga editonon adto sa modal -->
        <script>
            $(document).on('click', '.editbtn', function() {
                let id = $(this).data('id');
                let firstname = $(this).data('firstname');
                let lastname = $(this).data('lastname');
                let email = $(this).data('email');

                // ipasa ang mga data sa modal
                $('#edit').find("input[name='id']").val(id);
                $('#edit').find("input[name='firstname']").val(firstname);
                $('#edit').find("input[name='lastname']").val(lastname);
                $('#edit').find("input[name='email']").val(email);

            })
        </script>

<!-- pagsaved na sa imong gi update sa database -->
        <script>
            $(document).on('click','#updatebtn', function() {
                let id = document.getElementById('id').value;
                let firstname = document.getElementById('firstname').value;
                let lastname = document.getElementById('lastname').value;
                let email = document.getElementById('email').value;

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/update',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                        'Accept': 'application/json'
                    },
                    data: {
                        id: id,
                        first_name: firstname,
                        last_name: lastname,
                        email: email
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Student Updated!",
                            text: "Student updated successfully.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    },
                       error: function(error) {
                        Swal.fire({
                            title: "Error!",
                            text: "There was an issue updating the student information.",
                            icon: "error"
                        });
                    }
                });

                
            } )
        </script>

<!-- pagdelete sa student -->
        <script>
            $(document).on('click', '#trashcan', function() {
                let id = $(this).data('id');
                
                $(document).on('click', '#deletebtn', function() {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/delete',
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token'),
                            'Accept': 'application/json'
                        },
                        data: {
                            id: id
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        }
                    })
                })
                 
            })
        </script>

<!-- pag add ug bag o nga student -->
        <script>
            $(document).on('click', '#addbtn', function() {
                let firstname = document.getElementById('firstName').value;
                let lastname = document.getElementById('lastName').value;
                let email = document.getElementById('addEmail').value;

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/students',
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    },
                    data:{
                        first_name: firstName,
                        last_name: lastName,
                        email: addEmail
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    }
                })
            })
        </script>   






</body>
</html>