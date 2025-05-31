<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>


<div class="main d-flex " style="width:100%;" >
    <div class="left-side " style="width:300px; height:100vh; position:sticky; top:0 ; left:0;">
        <?php include 'partial/sidebar.php'; ?>
    </div>

<div class="d-flex flex-column" style="width: 100%;">
    
    <?php include 'partial/navbar.php'; ?>


    <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
       
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
    </div>

    <table id="courseTable" class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


</div>
<?php include 'modals/course_modal.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>



<!-- display courses -->
<script>
    $(document).ready(function() {
        fetch('http://localhost:8000/api/course', {
            method: 'GET',
            headers: {
                'Accept':'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')         
            }
        })
        .then(response => response.json())
        .then(data => {
            let courseTable = $('#courseTable').DataTable({
                data: data,
                columns: [
                    {data: 'id'},
                    {data: 'course_name'},
                    {data: 'description'},
                    {
                        data: null,
                        render: function(data, type, row){
                            return `<div class="d-flex gap-2">
                            <a href="" class= "btn btn-primary btn-sm" data-bs-toggle="modal" 
                            data-id="${row.id}"
                            data-course_name="${row.course_name}"
                            data-description="${row.description}"
                            data-bs-target="#editCourseModal" id="btnEditCourse">Edit</a>

                            <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-id="${row.id}"
                            data-bs-target="#deleteModal" id="btnDeleteCourse">Delete</a>
                            </div>`
                        }
                    }
                ],
            })
        })  
    })
</script>

<!-- mag add ug course -->
<script>
    $(document).on('click', '#saveCourse', function(e){
        e.preventDefault();
        let course_name = document.getElementById('courseName').value;
        let description = document.getElementById('courseDescription').value;

        fetch('http://localhost:8000/api/course', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
           },
           body: JSON.stringify({
                course_name: course_name,
                description: description
            })
        })
        .then(response => response.json())
        .then(response => {
            if(response.error){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.error,
                })
            }else{
                swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                }).then(() =>{
                    window.location.reload();
                })
            }
        })
    })

</script>

<!-- edit courses -->
 <script>
    $(document).on('click', '#editCourse', function(e){
        e.preventDefault();
        let course_name = document.getElementById('editCourseName').value;
        let description = document.getElementById('editCourseDescription').value;
        let course_id = document.getElementById('editCourseId').value;

        fetch('http://localhost:8000/api/course/update', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            body: JSON.stringify({
                course_name: course_name,
                description: description,
                id: course_id
            })
            .then(response => response.json())
            .then(response => {
                if(response.error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error,
                    })
                }else{
                    swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }).then(() =>{
                        window.location.reload();
                    })
                }
            })
        })
    })
 </script>

 <!-- pagdisplay sa update tonun  -->
  <script>
    $(document).on('click', '#btnEditCourse', function(e) {
        e.preventDefault();
        let course_id = $(this).data('id');
        let course_name = $(this).data('course_name');
        let description = $(this).data('description');

        $('#editCourseModal').find("input[name='id']").val(course_id);
        $('#editCourseModal').find("input[name='editCourse']").val(course_name);
        $('#editCourseModal').find("textarea[name='editDescription']").val(description);
        
    })
  </script>



<!-- delete courses -->
 <script>
    $(document).on('click', '#deletebtn', function(e) {
        e.preventDefault();
        let course_id = document.getElementById('deleteCourseId').value

        fetch('http://localhost:8000/api/course/delete', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            body: JSON.stringify({
                id: course_id
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.error){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error,
                })
            }else{
                swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                }).then(() =>{
                    window.location.reload();
                })
            }
        })

    })
 </script>


<!-- pagdisplay sa deletetonon -->
 <script>
    $(document).on('click', '#btnDeleteCourse', function() {
        let course_id = $(this).data('id');
        $('#deleteModal').find("input[name='id']").val(course_id);
        console.log(course_id);

    })
 </script>



</body>
</html>
