<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/media.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>


     
<div class="main d-flex " style="width:100%;" >
    <div class="left-side" style=" width:300px; height:100vh; position:sticky; top:0 ; left:0;">
                <?php include 'partial/sidebar.php'; ?>
    </div>

    <div class="d-flex flex-column" style="width: 100%;">
        <?php include 'partial/navbar.php'; ?>

        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <a href="add_student.php" class="btn btn-primary mb-3">Add Student</a>
                <div class="d-flex flex-column align-items-end">
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
    
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                        Import Students
                    </button>
                </div>


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
            window.open('partial/print.php', '_blank');
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
                    scrollx: true,
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
                                    <a class="qrcode-btn" 
                                            data-id="${row.id}"
                                            data-name="${row.first_name} ${row.middle_name ?? ''} ${row.last_name}"
                                            data-first="${row.first_name}"
                                            data-middle="${row.middle_name ?? ''}"
                                            data-last="${row.last_name}"
                                            data-address="${row.address}"
                                            data-contact="${row.contact}"
                                            data-email="${row.email}"
                                            data-age="${row.age}"
                                            data-gender="${row.gender}"
                                            data-course="${row.course ? row.course.course_name : 'N/A'}"
                                            data-year="${row.year_level}"
                                            data-status="${row.status}"
                                            data-sy="${row.school_year}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M7 17l0 .01" /><path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M7 7l0 .01" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M17 7l0 .01" /><path d="M14 14l3 0" /><path d="M20 14l0 .01" /><path d="M14 14l0 3" /><path d="M14 20l3 0" /><path d="M17 17l3 0" /><path d="M20 17l0 3" /></svg>
                                    </a>

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

 <!-- QR Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <h5 class="modal-title mb-3" id="qrModalLabel">Student QR Code</h5>
            <div id="qrcode" class="d-flex justify-content-center"></div>
            <div id="qr-name" class="mt-2 fw-bold"></div>
        </div>
    </div>
</div>

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
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            data: { id: id },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Student Deleted Successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
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

<script>
    $(document).on('click', '.qrcode-btn', function () {
        const name = $(this).data('name');
        const first = $(this).data('first');
        const middle = $(this).data('middle');
        const last = $(this).data('last');
        const address = $(this).data('address');
        const contact = $(this).data('contact');
        const email = $(this).data('email');
        const age = $(this).data('age');
        const gender = $(this).data('gender');
        const course = $(this).data('course');
        const year = $(this).data('year');
        const status = $(this).data('status');
        const sy = $(this).data('sy');

        const qrText = 
            `Name: ${first} ${middle} ${last}
            Course: ${course}
            Year Level: ${year}
            Age: ${age}
            Gender: ${gender}
            Address: ${address}
            Contact: ${contact}
            Email: ${email}
            Status: ${status}
            S.Y: ${sy}`;


        $('#qr-name').text(name);
        $('#qrcode').html('');
        new QRCode(document.getElementById("qrcode"), {
            text: qrText,
            width: 200,
            height: 200
        });

        //  Ipakita ang modal
        $('#qrModal').modal('show');
    });
</script>


<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <div class="modal-content">
            <form id="importForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="importFile" class="form-label">Choose CSV or Excel file</label>
                        <input type="file" class="form-control" id="importFile" name="file" accept=".csv,.xlsx,.xls" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('importForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData();
        let file = document.getElementById('importFile').files[0];
        formData.append('file', file);

        fetch('http://127.0.0.1:8000/api/report/import', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(text);
                });
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Import Successful!',
                text: data.message || 'Data has been imported.'
            });
            location.href = 'student.php'; // Refresh the page to see the new data
        })
        .catch(error => {
            console.error('Import error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Import Failed',
                text: 'Something went wrong:\n' + error.message
            });
        });
    });
</script>

   





</body>
</html>