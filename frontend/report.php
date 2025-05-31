<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/reports.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>


<div class="main d-flex gap-0 " style="width:100%;" >
    <div class="left-side" style="width:300px; height:100vh; position:sticky; top:0 ; left:0;">
        <?php include 'partial/sidebar.php'; ?>
    </div>

<div class="d-flex flex-column" style="width: 100%;">
    
    <?php include 'partial/navbar.php'; ?>
    <div class='d-flex justify-content-end m-3'>
        <button class="btn btn-primary" id="exportCSV">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-export"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
            Export CSV
        </button>
    </div>
    


    <div id="studentCount" class="" style="display: flex; flex-wrap: wrap; gap: 8px; margin: 12px"></div>
    <div id="courseYearCardReport" class="d-flex flex-wrap gap-3 p-3"></div>


</div> 









 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded" , function() {
        const studentCount = document.getElementById("studentCount");
        fetch('http://127.0.0.1:8000/api/enrolled/students', {
            method: 'GET',
            headers: {
                'Accept' :  'application/json',
                'Authorization' : 'Bearer ' + localStorage.getItem('token'),
            },
        })
        .then(response => response.json())
        .then(data => {
            data.student.forEach(student => {
                const studentCon = document.createElement('div');
                const year_level = document.createElement('div');
                const total = document.createElement('div');

                studentCon.classList.add('student-card');


                year_level.textContent = student.year_level;
                total.textContent = student.total;
                studentCon.appendChild(year_level);
                studentCon.appendChild(total);
                studentCount.appendChild(studentCon);
                
            })
        })
    })
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const courseYearCardReport = document.getElementById("courseYearCardReport");

    fetch('http://127.0.0.1:8000/api/report/courses', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        }
    })
        .then(response => response.json())
        .then(data => {
            const grouped = {};

            data.course_year_report.forEach(entry => {
                if (!grouped[entry.course_name]) {
                    grouped[entry.course_name] = [];
                }
                grouped[entry.course_name].push(entry);
            });

            for (const course in grouped) {
                const groupDiv = document.createElement('div');
                groupDiv.classList.add('course-card-group');

                const title = document.createElement('div');
                title.classList.add('course-title');
                title.textContent = `${course}`;
                groupDiv.appendChild(title);

                const flexWrap = document.createElement('div');
                flexWrap.classList.add('d-flex', 'flex-wrap', 'gap-3');

                grouped[course].forEach(row => {
                    const card = document.createElement('div');
                    card.classList.add('card-stat');

                    const year = document.createElement('div');
                    year.textContent = row.year_level;

                    const total = document.createElement('div');
                    total.textContent = row.total;

                    card.appendChild(year);
                    card.appendChild(total);
                    flexWrap.appendChild(card);
                });

                groupDiv.appendChild(flexWrap);
                courseYearCardReport.appendChild(groupDiv);
            }
        });
});
</script>

<script>
    document.getElementById("exportCSV").addEventListener("click", function() {
        fetch('http://127.0.0.1:8000/api/report/export', {
            method: 'GET',
            headers: {
                'Accept': 'text/csv',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'enrollment_report.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        })
    })
       
</script>














</body>
</html>
