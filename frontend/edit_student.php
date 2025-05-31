<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/media.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/dropify.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/dist/css/dropify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="main d-flex " style="width:100%;" >
    <div class="left-side" style=" width:300px; height:100vh; position:sticky; top:0 ; left:0;">
                <?php include 'partial/sidebar.php'; ?>
    </div>

    <div class="d-flex flex-column" style="width: 100%;">
        <?php include 'partial/navbar.php'; ?>

        <div class="shadow container my-3 p-5" style="width:80%;"> 
            <form action="" method="POST">
                <input type="hidden" value="">
                <div class="mb-3" style="width: 400px;">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control image" id="image" name="image" required placeholder="Upload image">  
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">FirstName</label>
                    <input type="text" class="form-control" id="firstName" name="firstname" required placeholder="Enter firstname">
                </div>
                <div class="mb-3">
                    <label for="middlename" class="form-label">MiddleName</label>
                    <input type="text" class="form-control" id="middleName" name="middlename" required placeholder="Enter middlename">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">LastName</label>
                    <input type="text" class="form-control" id="lastName" name="lastname" required placeholder="Enter lastname">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" required placeholder="Enter age">
                </div>
                <select class="form-select mb-3" id="gender" name="course" aria-label="Default select example">
                    <option selected disabled>Gender</option>
                    <option value="1">Female</option>
                    <option value="2">Male</option>
                </select>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required placeholder="Enter address">
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required placeholder="Enter contact">
                </div>
                <select class="form-select mb-3" id="addCourse" name="course" aria-label="Default select example">
                    <option selected disabled>Course</option>

                </select>
                <select class="form-select " id="year" name="year" aria-label="Default select example">
                    <option selected disabled>Year Level</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                </select>
                    
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="schoolYear" class="form-label">S.Y</label>
                    <input type="text" class="form-control" id="schoolYear" name="schoolYear"  placeholder="Enter school year">
                </div>
                <select class="form-select mb-3" id="statusOption" name="" aria-label="Default select example">
                    <option selected disabled>Status</option>
                    <option value="Enrolled">Enrolled</option>
                    <option value="Withdrawn">Withdrawn</option>
                    <option value="Graduated">Graduated</option>
                    <option value="Dropped">Dropped</option>
                </select>
                <div class="mb-3">
                    <a href="student.php" class="btn btn-secondary">Back</a>
                <button type="button" class="btn btn-primary" id="addbtn">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const url = new URLSearchParams(window.location.search);
        const id = url.get('id');
        fetch('http://127.0.0.1:8000/api/get/student', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            body: JSON.stringify({ id: id }),
        })
        .then(response => response.json())
        .then(data => {
            const student = data.student;
            console.log(student.status);
            document.getElementById('firstName').value = student.first_name;
            document.getElementById('middleName').value = student.middle_name;
            document.getElementById('lastName').value = student.last_name;
            document.getElementById('age').value = student.age;
            document.getElementById('address').value = student.address;
            document.getElementById('contact').value = student.contact;
            document.getElementById('email').value = student.email;
            document.getElementById('schoolYear').value = student.school_year;
            document.getElementById('year').value = student.year_level;
            console.log(document.getElementById('statusOption').value = student.status);
            document.getElementById('gender').value = student.gender;
            document.getElementById('addCourse').value = student.course.course_name;
        })
    })
</script>

<!-- pagsave ug data sa student -->
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addbtn').addEventListener('click', function(){
            const url = new URLSearchParams(window.location.search);
            const id = url.get('id');

            const formData = new FormData();
            formData.append('id', id);
            let image = document.getElementById('image').files[0];
            if(image) {
                formData.append('image', image);
            }
            
            formData.append('first_name', document.getElementById('firstName').value);
            formData.append('middle_name', document.getElementById('middleName').value);
            formData.append('last_name', document.getElementById('lastName').value);
            formData.append('age', document.getElementById('age').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('contact', document.getElementById('contact').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('school_year', document.getElementById('schoolYear').value);
            formData.append('year_level', document.getElementById('year').value);
            formData.append('status', document.getElementById('statusOption').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('course_id', document.getElementById('addCourse').value);



        
            fetch('http://127.0.0.1:8000/api/update', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            body: formData,
            contentType: false,
            processData: false,
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    Swal.fire({
                        title: "Student Added!",
                        text: "Student added successfully.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "student.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to update student',
                        text: data.message,
                    });
                }
            })
        })
    })


</script>


     <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://127.0.0.1:8000/api/course',{
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
            })
            .then(response => response.json())
            .then(data => {
                let courseCon = document.getElementById('addCourse');
                data.forEach(course => {
                    let option = document.createElement('option');
                    option.value = course.id;
                    option.textContent = course.course_name;
                    courseCon.appendChild(option);
                })
            })
        })
     </script>

</body>
</html>