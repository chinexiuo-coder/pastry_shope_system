<?php include '../includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Employees Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

body{
    display:flex;
    background:#f8f3ee;
    font-family:'Poppins', sans-serif;
}

/* SIDEBAR (UNCHANGED) */
.sidebar{
    width:260px;
    height:100vh;
    background:#6f4e37;
    color:white;
    position:fixed;
    padding-top:20px;
    box-shadow:4px 0 15px rgba(0,0,0,0.1);
}

.sidebar h2{
    text-align:center;
    margin-bottom:35px;
    font-weight:700;
}

.sidebar ul{
    list-style:none;
    padding:0;
}

.sidebar ul li{
    margin:8px 15px;
    border-radius:12px;
}

.sidebar ul li:hover{
    background:#8b5e3c;
}

.sidebar ul li a{
    color:white;
    text-decoration:none;
    display:block;
    padding:14px 20px;
    font-size:15px;
    font-weight:500;
}


.main-content{
    margin-left:260px;
    width:100%;
    padding:35px;
}

.top-section{
    background:linear-gradient(135deg,#c8a27a,#e6ccb2);
    border-radius:25px;
    padding:35px;
    color:white;
    margin-bottom:30px;
}

.content-card{
    background:white;
    border-radius:22px;
    padding:25px;
}

.add-btn{
    background:#9c6644;
    border:none;
    color:white;
    padding:12px 20px;
    border-radius:12px;
}

.editBtn{
    background:#ddb892;
    border:none;
    color:#4e342e;
}

.deleteBtn{
    background:#b56576;
    border:none;
    color:white;
}

.modal-header{
    background:#6f4e37;
    color:white;
}

.save-btn{
    background:#7f5539;
    border:none;
    color:white;
    padding:10px 18px;
    border-radius:10px;
}

</style>

</head>

<body>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<div class="top-section">
<h1>☕ Employees Management</h1>
<p>Clean CRUD system</p>
</div>

<div class="content-card">

<div class="d-flex justify-content-between mb-3">
<h4>Employee Records</h4>
<button class="add-btn" id="addBtn">+ Add Employee</button>
</div>

<table id="empTable" class="table table-bordered table-striped align-middle">

<thead class="table-dark text-center">
<tr>
<th>ID</th>
<th>Last Name</th>
<th>First Name</th>
<th>Birth Date</th>
<th>Action</th>
</tr>
</thead>

</table>

</div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal">
<div class="modal-dialog">

<form id="form">
<div class="modal-content">

<div class="modal-header">
<h5>Employee Form</h5>
<button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<input type="hidden" name="EmployeeID" id="EmployeeID">

<input class="form-control mb-2" name="LastName" placeholder="Last Name" required>
<input class="form-control mb-2" name="FirstName" placeholder="First Name" required>
<input class="form-control mb-2" type="date" name="BirthDate">

</div>

<div class="modal-footer">
<button class="save-btn" type="submit">Save</button>
</div>

</div>
</form>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>

let modal = new bootstrap.Modal(document.getElementById('modal'));

/* DATATABLE (PLASTERED STYLE) */
let table = $('#empTable').DataTable({
    ajax: 'fetch.php',
    columns: [
        { data: 'EmployeeID' },
        { data: 'LastName' },
        { data: 'FirstName' },
        { data: 'BirthDate' },
        {
            data: null,
            render: function(data){
                return `
                    <button class="btn btn-sm editBtn" data-id="${data.EmployeeID}">Edit</button>
                    <button class="btn btn-sm deleteBtn" data-id="${data.EmployeeID}">Delete</button>
                `;
            }
        }
    ]
});

/* ADD */
$('#addBtn').click(function(){
    $('#form')[0].reset();
    $('#EmployeeID').val('');
    modal.show();
});

/* SAVE (INSERT + UPDATE) */
$('#form').submit(function(e){
    e.preventDefault();

    let url = $('#EmployeeID').val() ? 'update.php' : 'insert.php';

    $.post(url, $(this).serialize(), function(res){

        modal.hide();
        table.ajax.reload();

        Swal.fire({
            icon:'success',
            title:'Success',
            text:res.message
        });

    },'json');
});

/* EDIT */
$(document).on('click','.editBtn',function(){

    let id = $(this).data('id');

    $.get('fetch.php',{id:id},function(data){

        $('#EmployeeID').val(data.EmployeeID);
        $('[name="LastName"]').val(data.LastName);
        $('[name="FirstName"]').val(data.FirstName);
        $('[name="BirthDate"]').val(data.BirthDate);

        modal.show();

    },'json');

});

/* DELETE */
$(document).on('click','.deleteBtn',function(){

    let id = $(this).data('id');

    Swal.fire({
        title:'Delete employee?',
        icon:'warning',
        showCancelButton:true
    }).then(res=>{

        if(res.isConfirmed){

            $.post('delete.php',{id:id},function(r){

                table.ajax.reload();

                Swal.fire({
                    icon:'success',
                    title:'Deleted',
                    text:r.message
                });

            },'json');

        }

    });

});

</script>

</body>
</html>