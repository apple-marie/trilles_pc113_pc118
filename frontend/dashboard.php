<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/media.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>


<div class="main d-flex gap-0 " style="width:100%;" >
    <div class="left-side" style="width:300px; height:100vh; position:sticky; top:0 ; left:0;">
        <?php include 'partial/sidebar.php'; ?>
    </div>

<div class="d-flex flex-column" style="width: 100%;">
    
    <?php include 'partial/navbar.php'; ?>


       <h3>Welcome back!</h3>


</div> 














 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        fetch('http://127.0.0.1:8000/api/enrolled/students', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => response.json())
        .then(data => {
            let mainCon = document.getElementById('studentCount');
            
            console.log(data.student);
            data.student.forEach(students => {
                let card = document.createElement('div');
                let year = document.createElement('div');
                let count = document.createElement('div');
                year.textContent = students.year_level;
                count.textContent = students.total;

                card.appendChild(year);
                card.appendChild(count);
                mainCon.appendChild(card);
            })
        })
    </script>

</body>
</html>
