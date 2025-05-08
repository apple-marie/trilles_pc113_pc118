<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/side.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
     
<div class="main d-flex " style="width:100%;" >
    <div class="left-side" style=" width:300px; height:100vh; position:sticky; top:0 ; left:0;">
                <?php include 'partial/sidebar.php'; ?>
    </div>

    <div class="d-flex flex-column" style="width: 100%;">
        <?php include 'partial/navbar.php'; ?>

        <div class="container mt-2">
            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addstudent">Add Student</a>
            <table class="table table-striped table-bordered" id="students">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Age</th>
                        <th>Course</th>
                        <th>Year</th>
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
                console.log(data);
                $('#students').DataTable({
                    data: data,
                    columns: [
                        { data: 'id' },
                        {
                            data:'image',
                            render: function(data, type, row) {
                                if(data == null) {
                                    return `<div>No image</div>`
                                }else{
                                    return `<img src="http://localhost:8000/storage/${data}" alt="Student Image" style="width: 50px; height: 50px; border-radius: 50%;">`;
                                }
                            }
                        },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'address' },
                        { data: 'contact' },
                        { data: 'age' },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return row.course ? row.course.course_name : 'N/A';
                            }
                        },
                        { data: 'year_level' },
                        { data: 'email' },
                        {   
                            data: null,
                            render: function(data, type, row){
                                return `
                                <div class="d-flex gap-3" >
                                    <a class="text-decoration-none editbtn"
                                    data-id="${row.id}"
                                    data-image="${row.image}"
                                    data-firstname="${row.first_name}"
                                    data-lastname="${row.last_name}"
                                    data-address="${row.address}"
                                    data-contact="${row.contact}"
                                    data-age="${row.age}"
                                    data-course="${row.course_id}"
                                    data-year="${row.year_level}"
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



 <?php include 'modals/student_modal.php'; ?>

   
<!-- pagpa display sa content sa modal -->
          <script>
              $(document).on('click', '.editbtn', function() {
                  let id = $(this).data('id');
                  let firstname = $(this).data('firstname');
                  let lastname = $(this).data('lastname');
                  let address = $(this).data('address');
                  let contact = $(this).data('contact');
                  let email = $(this).data('email');
                  let age = $(this).data('age');
                  let course = $(this).data('course');
                  let year = $(this).data('year');
  
                  // ipasa ang mga data sa modal
                  $('#edit').find("input[name='id']").val(id);
                  $('#edit').find("input[name='firstname']").val(firstname);
                  $('#edit').find("input[name='lastname']").val(lastname);
                  $('#edit').find("input[name='address']").val(address);
                  $('#edit').find("input[name='contact']").val(contact);
                  $('#edit').find("input[name='email']").val(email);
                  $('#edit').find("input[name='age']").val(age);
                  $('#edit').find("input[name='course']").val(course);
                  $('#edit').find("input[name='year']").val(year);
              })
          </script>
          
<!-- pagsaved na sa imong gi update sa database -->
        <script>
            $(document).on('click','#updatebtn', function() {
                let id = document.getElementById('id').value;
                let firstname = document.getElementById('editFirstname').value;
                let lastname = document.getElementById('editLastname').value;
                let address = document.getElementById('editAddress').value;
                let contact = document.getElementById('editContact').value;
                let image = document.getElementById('editImage').files[0];
                let email = document.getElementById('editEmail').value;
                let age = document.getElementById('editAge').value;
                let course = document.getElementById('editCourse').value;
                let year = document.getElementById('editYear').value;

                console.log(id, firstname, lastname, address, contact, image, email, age, course, year);

                let formData = new FormData();
                formData.append('id', id);
                formData.append('first_name', firstname);
                formData.append('last_name', lastname);
                formData.append('address', address);
                formData.append('contact', contact);
                if (image) {
                    formData.append('image', image);
                }
                formData.append('email', email);
                formData.append('age', age);
                formData.append('course_id', course);
                formData.append('year_level', year);
                

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/update',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                        'Accept': 'application/json'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
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

<!-- Display the data in modal -->
<script>
    $(document).on('click', '.trashcanBtn', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#delete').find("input[name='id']").val(id); // make sure the modal id is #delete
        $('#delete').modal('show');
    });
</script>

<!-- Delete the student -->
<script>
    $(document).on('click', '#deletebtn', function(e){
        e.preventDefault();
        let id = $('#delete').find("input[name='id']").val();

        $.ajax({
            url: 'http://localhost:8000/api/delete',
            type: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            data: { id: id },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Student Deleted Successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload(); // or remove the row using jQuery
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'Something went wrong',
                });
            }
        });
    });
</script>


<!-- pag add ug bag o nga student -->
        <script>
            $(document).on('click', '#addbtn', function() {
                let image = document.getElementById('image').files[0];
                let firstname = document.getElementById('firstName').value;
                let lastname = document.getElementById('lastName').value;
                let address = document.getElementById('address').value;
                let contact = document.getElementById('contact').value;
                let email = document.getElementById('addEmail').value;
                let password = document.getElementById('password').value;
                let age = document.getElementById('age').value;
                let course_id = document.getElementById('addCourse').value;
                let year_level = document.getElementById('addYear').value;

                let formData = new FormData();
                if(image) {
                    formData.append('image', image);
                }
                formData.append('first_name', firstname);
                formData.append('last_name', lastname);
                formData.append('address', address);
                formData.append('contact', contact);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('age', age);
                formData.append('course_id', course_id);
                formData.append('year_level', year_level);


                $.ajax({
                    url: 'http://127.0.0.1:8000/api/create',
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Student Added!",
                            text: "Student added successfully.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    }
                })
            })
        </script>   





</body>
</html>