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
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/dropify.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/dropify.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>


<div class="main d-flex " style="width:100%;" >
    <div class="left-side">
        <?php include 'partial/sidebar.php'; ?>
    </div>

    <div class="d-flex flex-column" style="width: 100%;">
        
        <?php include 'partial/navbar.php'; ?>


        <div class="container mt-4">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Add User</button>
            </div>


            <table id="userTable" class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include 'modals/user_modal.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
<script src="http://127.0.0.1:8000/dist/js/dropify.js"></script>
<script src="http://127.0.0.1:8000/dist/js/dropify.min.js"></script>

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

<!-- display Users -->
<script>
    $(document).ready(function() {
        fetch('http://localhost:8000/api/users', {
            method: 'GET',
            headers: {
                'Accept':'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')         
            }
        })
        .then(response => response.json())
        .then(data => {
            let userTable = $('#userTable').DataTable({
                data: data,
                scrollX: true,
                columns: [
                    {data: 'id'},
                    {
                        data:'image',
                        render: function(data, type, row){
                            return `<img src="http://localhost:8000/storage/${data}" alt="User Image" style="width: 50px; height: 50px; border-radius: 50%;">`
                        }
                    },
                    {data: 'name'},
                    {data: 'address'},
                    {data: 'contact'},
                    {data: 'email'},
                    {
                        data:'role',
                        render:function(data, type, row){
                            return data == 0 ? 'Admin' : 'Registrar';
                        }
                    },

                    {
                        data: null,
                        render: function(data, type, row){
                            return `<div class="d-flex gap-2">
                            <a href="" class="btn btn-primary btn-sm"
                            data-id="${row.id}"
                            data-name="${row.name}"
                            data-email="${row.email}"
                            data-address="${row.address}"
                            data-contact="${row.contact}"
                            data-role="${row.role}"
                            data-bs-toggle="modal" data-bs-target="#editUser" id="btnEditUser">Edit</a>

                            <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-id="${row.id}"
                            data-bs-target="#deleteUser" id="btnDelete">Delete</a>
                            </div>`
                        }
                    }
                ],
            })
        })  
    })
</script>

<!-- Add User -->
    <script>
        $(document).on('click', '#addbtn', function() {
            document.getElementById('spinner').style.display = 'block';
            let image = document.getElementById('image').files[0];
            let fullname = document.getElementById('fname').value;
            let address = document.getElementById('address').value;
            let contact = document.getElementById('contact').value;
            let email = document.getElementById('addEmail').value;
            let password = document.getElementById('password').value;
            let role = document.getElementById('role').value;
            console.log(image);

            let formData = new FormData();
            if (image){
                formData.append('image', image);
            }
            formData.append('name', fullname);
            formData.append('address', address);
            formData.append('contact', contact);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('role', role);

            $.ajax({
                url: 'http://127.0.0.1:8000/api/user',
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
                        title: "User Added!",
                        text: "User added successfully.",
                        icon: "success"
                    }).then(() => {
                        location.reload();
                    });
                },
                complete: function() {
                    document.getElementById('spinner').style.display = 'none';
                }
            })
        })
    </script>   



<!-- pagdisplay sa editonun nga user -->
 <script>
    $(document).on('click', '#btnEditUser', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let name = $(this).data('name');
        let address = $(this).data('address');
        let contact = $(this).data('contact');
        let email = $(this).data('email');
        let role = $(this).data('role');

    // pagpaasa ug data sa edit modal
        $('#editUser').find("input[name='id']").val(id);
        $('#editUser').find("input[name='fname']").val(name);
        $('#editUser').find("input[name='address']").val(address);
        $('#editUser').find("input[name='contact']").val(contact);
        $('#editUser').find("input[name='email']").val(email);
        $('#editUser').find("select[name='role']").val(role);

    })
 </script>
 
 <!-- pag update sa na edit nga user -->
 <script>
    $(document).on('click', '#editbtn', function(e){
        e.preventDefault();
        let id = $('#editUser').find("input[name='id']").val();
        let image = document.getElementById('editImage').files[0];
        let name = $('#editUser').find("input[name='fname']").val();
        let address = $('#editUser').find("input[name='address']").val();
        let contact = $('#editUser').find("input[name='contact']").val();
        let email = $('#editUser').find("input[name='email']").val();
        let role = $('#editUser').find("select[name='role']").val();

        let formData = new FormData();
        formData.append('id', id);
        formData.append('image', image);
        formData.append('name', name);
        formData.append('address', address);
        formData.append('contact', contact);
        formData.append('email', email);
        formData.append('role', role);


        $.ajax({
            url: 'http://localhost:8000/api/user/update',
            type: 'POST',
            headers: {
                'Accept': 'application/json',

            },
            data: formData,
            contentType: false,
            processData: false,

                success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User Updated Successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
               .then(() => {
                    location.reload()
                })
            },
        });
    })
 </script>

<!-- pag display sa deletonun -->
 <script>
        $(document).on('click', '#btnDelete', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#deleteUser').find("input[name='id']").val(id);
    })
 </script>
 
 <!-- pagdelete na sa data -->
 <script>


    $(document).on('click', '#deletebtn', function(e){
        e.preventDefault();
        let id = $('#deleteUser').find("input[name='id']").val();

        $.ajax({
            url: 'http://localhost:8000/api/user/delete',
            type: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User Deleted Successfully',
                    showConfirmButton: false,
                    timer: 1500
                })
               .then(() => {
                    location.reload()
                })
            },
        });
    })
 </script>

<script>
    $('#importForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData();
        let file = document.getElementById('importFile').files[0];
        formData.append('file', file);

        fetch('http://localhost:8000/api/users/import', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Import Successful',
                text: 'Users imported successfully.',
                confirmButtonText: 'OK'
            }).then(() => location.reload());
        })
    });
</script>

</body>
</html>
