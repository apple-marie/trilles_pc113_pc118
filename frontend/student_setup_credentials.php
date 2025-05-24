<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="d-flex justify-content-center my-5">
    <form action="" method="POST" class="card p-5 d-flex shadow" style="width: auto;">
        <h3 class="d-flex justify-content-center text-primary">Setup your account</h3>
        <p id="error" class="text-danger d-flex justify-content-center "></p>
        <div class="d-flex gap-3">
            <div>
                <div class="mb-3">
                    <label for="fname" class="form-label">Firstname</label>
                    <input type="text" class="form-control" id="fname" name="fname" disabled>
                </div>
                <div class="mb-3">
                    <label for="mname" class="form-label">Middlename</label>
                    <input type="text" class="form-control" id="mname" name="mname" disabled>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Lastname</label>
                    <input type="text" class="form-control" id="lname" name="lname" disabled>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" disabled>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" disabled>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" disabled>
                </div>
             <div class="mb-3">
                    <label for="course" class="form-label">Course</label>
                    <input type="text" class="form-control" id="course" name="course" disabled>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary justify-content-center" style="display:flex; align-items:center; gap:5px"id="saveSetup">
            Save
            <div class="spinner-border spinner-border-sm text-light" role="status" id="spinner" style="display:none">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const url = new URLSearchParams(window.location.search);
        const id = url.get('id');
        
        fetch('http://127.0.0.1:8000/api/setup/student', {
            method: 'POST',
            headers: { 
                'Content-type': 'application/json',
                'Accept' : 'application/json',
            },
            body: JSON.stringify({
                id: id,
            })
        })
        .then(response => response.json())
        .then(data => {
            const student = data;

            document.getElementById('fname').value = student.first_name;
            document.getElementById('email').value = student.email;
            document.getElementById('mname').value = student.middle_name;
            document.getElementById('lname').value = student.last_name;
            document.getElementById('address').value = student.address;
            document.getElementById('contact').value = student.contact;
            document.getElementById('age').value = student.age;
            document.getElementById('course').value = student.course.course_name;


        })
    })
</script>


<script>
    const saveSetup = document.getElementById('saveSetup');
    saveSetup.addEventListener('click', function(){
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password != confirmPassword){
            document.getElementById('error').textContent = 'Password and Confirm Password does not match';
        }else{
            const url = new URLSearchParams(window.location.search);
            const id = url.get('id');
            fetch('http://127.0.0.1:8000/api/save', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept' : 'application/json',
                    
                },
                body: JSON.stringify({
                    id: id,
                    password: password,
                })
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = 'index.php';
            })
        }
    })
</script>









</body>
</html>