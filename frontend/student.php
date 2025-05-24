<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<style media="print">
    .left-side, .navbar, .btn {
        display: none !important;
    }
</style>

     
<div class="main d-flex " style="width:100%;" >
    <div class="left-side" style=" width:300px; height:100vh; position:sticky; top:0 ; left:0;">
                <?php include 'partial/sidebar.php'; ?>
    </div>

    <div class="d-flex flex-column" style="width: 100%;">
        <?php include 'partial/navbar.php'; ?>

        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <a href="add_student.php" class="btn btn-primary mb-3">Add Student</a>
                <button class="btn btn-danger btn-sm mb-3" onclick="printTable()">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#ffffff"
                    stroke-width="1"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                    </svg>
                    Print
                </button>
            </div>
            <table class="table table-striped table-bordered" id="students">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Status</th>
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
        function printTable() {
            const printContent = document.querySelector('.container').innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // Reload the page to bring back event listeners
        }
    </script>

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
                                    return `<img src="http://127.0.0.1:8000/storage/${data}" alt="Student Image" style="width: 50px; height: 50px; border-radius: 50%;">`;
                                }
                            }
                        },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'address' },
                        
                        {   
                            data: null,
                            render: function(data, type, row) {
                                return row.course ? row.course.course_name : 'N/A';
                            }
                        },
                        
                        { data: 'year_level' },
                        { data: 'status' },
                        {   
                            data: null,
                            render: function(data, type, row){
                                return `
                                <div class="d-flex gap-3" >
                                    <a class="text-decoration-none editbtn" href="edit_student.php?id=${data.id}" style="color:blue">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.image').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            }
        })
    })
</script>

 <?php include 'modals/student_modal.php'; ?>

<!-- pag display sa id nga deletonun -->
<script>
        $(document).on('click', '#trashcan', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#delete').find("input[name='id']").val(id);
    })
</script>

<!-- pagDelete na sa student -->
<script>
    $(document).on('click', '#deletebtn', function(e){
        e.preventDefault();
        let id = document.getElementById('deleteId').value;

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


   





</body>
</html>