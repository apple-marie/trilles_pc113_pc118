<!-- reset_password.php -->
<?php
$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container col-md-4 mt-5">
    <h3 class="text-center mb-4">Reset Password</h3>
    <form id="resetPasswordForm">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <p id="statusMessage" class="text-success text-center"></p>
        <button type="submit" class="btn btn-success w-100">Reset Password</button>
    </form>
</div>

<script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        fetch('http://127.0.0.1:8000/api/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                 'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('statusMessage').textContent = data.status || "Password has been reset!";
        })
        .catch(error => {
            document.getElementById('statusMessage').textContent = "Something went wrong.";
            console.error(error);
        });
    });
</script>
</body>
</html>
