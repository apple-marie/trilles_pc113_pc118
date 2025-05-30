
<!-- Mobile Toggle Button -->
<button class="sidebar-toggle burger" onclick="toggleSidebar()">☰</button>
<div id="overlay" class="overlay" onclick="toggleSidebar()"></div>

<div class="sidebar pt-2 bg-primary" style="height: 100vh; position: sticky; top: 0; left: 0;">
    <img src="http://127.0.0.1:8000/storage/images/logo.png" alt="" class="mx-2 d-flex" style="height: 100px; width: 80%; object-fit: cover;">
    <ul class="sidebar-menu d-flex flex-column list-unstyled pt-2" style="color: #F5EFFF; border-top: 1px solid #F5EFFF;">
        <li>
            <a class="text-decoration-none d-flex align-items-center gap-2" href="dashboard.php" style="color: #F5EFFF">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"></path>
                <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"></path>
                <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"></path>
                <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"></path>
            </svg>
                Dashboard
            </a>
        </li>
        <li id="userMenu" style="display: none">
            <a class="text-decoration-none d-flex align-items-center gap-2" href="user.php" style="color: #F5EFFF;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                Users
            </a>
        </li>
        <li id="studentMenu" style="display: none">
            <a class="text-decoration-none d-flex align-items-center gap-2" href="student.php" style="color: #F5EFFF">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
            </svg>
                Students
            </a>
        </li>
        <li id="courseMenu" style="display: none">
            <a class="text-decoration-none d-flex align-items-center gap-2" href="course.php" style="color: #F5EFFF">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73"></path>
                <path d="M6 9l12 0"></path>
                <path d="M6 12l3 0"></path>
                <path d="M6 15l2 0"></path>
             </svg>
                Courses
            </a>
        </li>
        <li id="gradeMenu">
            <a class="text-decoration-none d-flex align-items-center gap-2" href="#" style="color: #F5EFFF">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                <path d="M9 17l0 -5"></path>
                <path d="M12 17l0 -1"></path>
                <path d="M15 17l0 -3"></path>
                </svg>
                Grades
            </a>
        </li>
        <li id="subjectMenu">
            <a class="text-decoration-none d-flex align-items-center gap-2" href="#" style="color: #F5EFFF">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                <path d="M9 17h6"></path>
                <path d="M9 13h6"></path>
                </svg>
                Subject
            </a>
        </li>
        <li id="reportMenu" style="display: none">
            <a class="text-decoration-none d-flex align-items-center gap-2" href="report.php" style="color: #F5EFFF">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="1">
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                <path d="M9 17l0 -5"></path>
                <path d="M12 17l0 -1"></path>
                <path d="M15 17l0 -3"></path>
                </svg>
                Reports
            </a>
        </li>
        
        
    </ul>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const  userMenu = document.getElementById('userMenu');
        fetch('http://127.0.0.1:8000/api/get/user', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json',
        }
        })
        .then(response => response.json())
        .then(data => {
            if (data.user.role == 0) {
                userMenu.style.display = 'block';
            }
            if(data.user.role == 0 || data.user.role == 1) {
                document.getElementById('gradeMenu').style.display = 'none';
                document.getElementById('subjectMenu').style.display = 'none';
                document.getElementById('studentMenu').style.display = 'block';
                document.getElementById('courseMenu').style.display = 'block';
                document.getElementById('reportMenu').style.display = 'block';
            }
        })
    })
</script>



<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}
</script>
