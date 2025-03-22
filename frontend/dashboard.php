<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous">
    </script>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-3 text-center">Student List</h2>

        <a href="add-user.php" class="btn btn-primary mb-3">Add Student</a>

        <table class="table table-striped table-bordered" id="students">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th class="col-1">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = 'index.php';
            }

            fetch('http://127.0.0.1:8000/api/students', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => response.json())
            .then(data => {
                $('#students').DataTable({
                    data: data,
                    columns: [
                        { data: 'id' },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'email' },
                        {   
                            data: null,
                            render: function(data, type, row){
                                return `
                                <div class="d-flex gap-3">
                                    <a class="text-decoration-none" href="edit.php?id=${row.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path> <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path> <path d="M16 5l3 3"></path> </svg> 
                                    </a>
                                    <a style="color:red" class="text-decoration-none" href="delete.php?id=${row.id}">
                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg>
                                    </a>
                                </div>`;
                            }
                        }
                    ]
                });
            })
            .catch(error => console.error("Error fetching students:", error));
        });
    </script>

</body>
</html>
