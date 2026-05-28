<?php include '../includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Orders Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

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
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.add-btn{
    background:#9c6644;
    border:none;
    color:white;
    padding:12px 20px;
    border-radius:12px;
    font-weight:600;
}

.editBtn{
    background:#ddb892;
    border:none;
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

.table-dark{
    background:#6f4e37 !important;
}

</style>

</head>

<body>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

<div class="top-section">

    <h1>☕ Orders Management</h1>

    <p>
        Manage customer orders easily
    </p>

</div>

<div class="content-card">

<div class="d-flex justify-content-between mb-3">

    <h3 class="fw-bold" style="color:#6f4e37;">
        Order Records
    </h3>

    <button class="add-btn" id="addOrderBtn">
        + Add Order
    </button>

</div>

<table id="orderTable"
       class="table table-bordered table-striped align-middle">

<thead class="table-dark text-center">

<tr>

    <th>Order ID</th>
    <th>Customer ID</th>
    <th>Employee ID</th>
    <th>Order Date</th>
    <th>Shipper ID</th>
    <th>Action</th>

</tr>

</thead>

</table>

</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="orderModal">

<div class="modal-dialog">

<form id="orderForm">

<div class="modal-content">

<div class="modal-header">

<h5>Order Form</h5>

<button class="btn-close btn-close-white"
        data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<input type="hidden"
       name="OrderID"
       id="OrderID">

<input type="number"
       name="CustomerID"
       class="form-control mb-3"
       placeholder="Customer ID"
       required>

<input type="number"
       name="EmployeeID"
       class="form-control mb-3"
       placeholder="Employee ID"
       required>

<input type="date"
       name="OrderDate"
       class="form-control mb-3"
       required>

<input type="number"
       name="ShipperID"
       class="form-control mb-3"
       placeholder="Shipper ID"
       required>

</div>

<div class="modal-footer">

<button class="save-btn"
        type="submit">
    Save
</button>

</div>

</div>

</form>

</div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>

let modal = new bootstrap.Modal(
    document.getElementById('orderModal')
);

/* DATATABLE */
let table = $('#orderTable').DataTable({

ajax:{
    url:'fetch.php',
    dataSrc:'data'
},

pageLength:10,
lengthChange:false,

columns:[

{ data:'OrderID', defaultContent:'' },

{ data:'CustomerID', defaultContent:'' },

{ data:'EmployeeID', defaultContent:'' },

{ data:'OrderDate', defaultContent:'' },

{ data:'ShipperID', defaultContent:'' },

{
data:null,

render:function(data){

return `

<button class="btn btn-sm editBtn"
        data-id="${data.OrderID}">
    Edit
</button>

<button class="btn btn-sm deleteBtn"
        data-id="${data.OrderID}">
    Delete
</button>

`;

}

}

]

});

/* ADD */
$('#addOrderBtn').click(function(){

$('#orderForm')[0].reset();

$('#OrderID').val('');

modal.show();

});

/* SAVE */
$('#orderForm').submit(function(e){

e.preventDefault();

let url = $('#OrderID').val()
? 'update.php'
: 'insert.php';

$.post(url, $(this).serialize(), function(res){

if(res.success){

    modal.hide();

    table.ajax.reload();

    Swal.fire({
        icon:'success',
        title:'Success',
        text:res.message
    });

}else{

    Swal.fire({
        icon:'error',
        title:'Error',
        text:res.message
    });

}

},'json');

});

/* EDIT */
$(document).on('click','.editBtn',function(){

let id = $(this).data('id');

$.get('fetch.php',{id:id},function(data){

$('#OrderID').val(data.OrderID);

$('[name="CustomerID"]').val(data.CustomerID);

$('[name="EmployeeID"]').val(data.EmployeeID);

$('[name="OrderDate"]').val(data.OrderDate);

$('[name="ShipperID"]').val(data.ShipperID);

modal.show();

},'json');

});

/* DELETE */
$(document).on('click','.deleteBtn',function(){

let id = $(this).data('id');

Swal.fire({

title:'Delete Order?',
icon:'warning',
showCancelButton:true

}).then((r)=>{

if(r.isConfirmed){

$.post('delete.php',{id:id},function(res){

table.ajax.reload();

Swal.fire({

icon:'success',
title:'Deleted',
text:res.message

});

},'json');

}

});

});

</script>

</body>
</html>