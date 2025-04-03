<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="container col-md-4 mt-5">
    <div class="card shadow">
        <div class="card-header text-center">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            <form action="../backend/add-user.php" method="POST">
                <!--  Name & lastname Field -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">FirstName</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required placeholder="Enter firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">LastName</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required placeholder="Enter lastname">
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Edit User</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>







<script>
    $(document).ready(function() {
        const idFromUrl = window.location.search.match(/id=([^&]+)/);
        const id = idFromUrl ? idFromUrl[1] : null;

        fetch('http://127.0.0.1:8000/api/students', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({
                id: id,
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
    })
</script>
</body>
</html>