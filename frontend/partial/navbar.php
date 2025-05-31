<?php 
  $page = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Navbar Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary px-3">
  <div class="container-fluid">
    <div class="title fw-regular fs-4">
        <?php 
            switch($page) {
              case $page == '/dashboard.php':
                echo 'Dashboard';
                break;
              case $page == '/user.php':
                echo 'User Management';
                break;
              case $page == '/student.php':
                echo 'Student Management';
                break;
              case $page == '/course.php':
                echo 'Course Management';
                break;
              case $page == '/report.php':
                echo 'Report';
                break;
            }
        ?>

    </div>

    <!-- Right side: profile + logout -->
    <div class="dropdown d-flex justify-content-center">
      <div 
          class="d-flex gap-2 align-items-center" 
          style="cursor: pointer;" 
          data-bs-toggle="dropdown" 
          aria-expanded="false"
      >
          <div>Profile</div>
      </div>

      <ul class="user-drop dropdown-menu dropdown-menu-lg-end p-0" style="border: 1px solid #e0e0e0; width:200px">
          <li>
              <a href="#" id="profileBtn" class="list-group-item p-2">
                
                  <small class="text-secondary" style="font-size: 12px">Profile</small>
              </a>
          </li>
          <li><hr class="dropdown-divider m-0"></li>
          <li>
              <a class="list-group-item text-danger shadow dropdown-item admin-na py-2"  href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  <svg class="ms-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                      class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                      <path d="M9 12h12l-3 -3" />
                      <path d="M18 15l3 -3" />
                  </svg>
                  Logout
              </a>
          </li>
      </ul>
    

</nav>

<!-- Logout Modal -->
<div class="modal" id="logoutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p> Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="logoutBtn">Logout</button>
      </div>
    </div>
  </div>
</div>

<!-- logout  -->

<script>
  const logoutBtn = document.getElementById('logoutBtn');
  logoutBtn.addEventListener('click', function() {
    fetch('http://localhost:8000/api/users/logout', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      }
    })
    .then(res => res.json())
    .then(data => {
        if(data.message) {
          localStorage.removeItem('token');
          window.location.href = 'index.php';
        }
    })
  })
</script>


</body>
</html>
