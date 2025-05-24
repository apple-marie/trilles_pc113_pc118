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


     
<div class="main d-flex " style="width:100%;" >
        <div class="container mt-5">

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
                    searching: false,
                    paging:false,
                    info: false,

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
            .finally(() => {
                window.print();
            })
            .catch(error => console.error("Error fetching students:", error))
        });
    </script>

    <script>
        window.addEventListener('afterprint', function() {
            window.close();
        })
    </script>