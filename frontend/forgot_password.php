
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container col-md-4 mt-5">
    <h3 class="text-center mb-4">Forgot Password</h3>
    <form id="forgotPasswordForm">
        <div class="mb-3">
            <label for="email" class="form-label">Enter your email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <p id="statusMessage" class="text-success text-center"></p>
        <a href="reset_password.php" class="btn btn-primary w-100">Submit</a>
    </form>
</div>

<script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;

        fetch('http://127.0.0.1:8000/api/forgot-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                 'Accept': 'application/json'
            },
            body: JSON.stringify({ email })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('statusMessage').textContent = data.status || "Check your email!";
        })
        .catch(error => {
            document.getElementById('statusMessage').textContent = "Something went wrong.";
            console.error(error);
        });
    });
</script>
</body>
</html>
