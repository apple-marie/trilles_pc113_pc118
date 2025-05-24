<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sidebar.css">
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
                <select class="form-select mb-3" id="addGender" name="course" aria-label="Default select example">
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
                <select class="form-select " id="addYear" name="year" aria-label="Default select example">
                    <option selected>Year Level</option>
                    <option value="1ST Year">1ST Year</option>
                    <option value="2ND Year">2ND Year</option>
                    <option value="3RD Year">3RD Year</option>
                    <option value="4TH Year">4TH Year</option>
                </select>
                    
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="addEmail" name="email" required placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="school_year" class="form-label">S.Y</label>
                    <input type="school_year" class="form-control" id="school_year" name="school_year" required placeholder="Enter school year">
                </div>
                <div class="mb-3">
                    <a href="student.php" class="btn btn-secondary">Back</a>
                <button type="button" class="btn btn-primary" id="addbtn">Add Student</button>
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


<!-- pag add ug bag o nga student -->
    <script>   
        $(document).on('click', '#addbtn', function() {
            // console.log('add student button clicked');
            let image = document.getElementById('image').files[0];
            let firstname = document.getElementById('firstName').value;
            let middlename = document.getElementById('middleName').value;
            let lastname = document.getElementById('lastName').value;
            let address = document.getElementById('address').value;
            let contact = document.getElementById('contact').value;
            let email = document.getElementById('addEmail').value;
            let password = document.getElementById('password').value;
            let gender = document.getElementById('addGender').value;
            let age = document.getElementById('age').value;
            let course_id = document.getElementById('addCourse').value;
            let year_level = document.getElementById('addYear').value;
            let school_year = document.getElementById('school_year').value;

            let formData = new FormData();
            if(image) {
                formData.append('image', image);
            }
            formData.append('first_name', firstname);
            formData.append('middle_name', middlename);
            formData.append('last_name', lastname);
            formData.append('address', address);
            formData.append('contact', contact);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('age', age);
            formData.append('gender', gender);
            formData.append('course_id', course_id);
            formData.append('year_level', year_level);
            formData.append('school_year', school_year);
            formData.append('status', status);


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
                        window.location.href = 'student.php';
                    });
                }
            })
        })
    </script>

    <!-- magkuha ug courses adto sa backend dle na cja hardcode -->
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