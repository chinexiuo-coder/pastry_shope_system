<?php include '../includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

/* SIDEBAR */

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
    transition:0.3s;
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

/* MAIN CONTENT */

.main-content{
    margin-left:260px;
    width:100%;
    padding:35px;
}

/* HEADER */

.top-section{
    background:linear-gradient(
        135deg,
        #c8a27a,
        #e6ccb2
    );
    border-radius:25px;
    padding:35px;
    color:white;
    margin-bottom:30px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

.top-section h1{
    font-size:38px;
    font-weight:700;
}

.top-section p{
    margin-top:10px;
    font-size:16px;
}

/* CARD */

.content-card{
    background:white;
    border-radius:22px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

/* BUTTONS */

.add-btn{
    background:#9c6644;
    border:none;
    color:white;
    padding:12px 20px;
    border-radius:12px;
    font-weight:600;
    transition:0.3s;
}

.add-btn:hover{
    background:#7f5539;
}

.editBtn{
    background:#ddb892;
    border:none;
    color:#4e342e;
    font-weight:600;
}

.editBtn:hover{
    background:#c79a74;
}

.deleteBtn{
    background:#b56576;
    border:none;
    color:white;
}

.deleteBtn:hover{
    background:#9d4b5d;
}

/* TABLE */

.table{
    border-radius:15px;
    overflow:hidden;
}

.table-dark{
    background:#6f4e37 !important;
}

.table tbody tr:hover{
    background:#f3e5d8;
    transition:0.2s;
}

/* MODAL */

.modal-content{
    border:none;
    border-radius:22px;
    overflow:hidden;
}

.modal-header{
    background:#6f4e37;
    color:white;
}

.form-control,
.form-select{
    border-radius:12px;
    padding:12px;
    border:1px solid #d6ccc2;
}

.form-control:focus,
.form-select:focus{
    border-color:#b08968;
    box-shadow:none;
}

.save-btn{
    background:#7f5539;
    border:none;
    padding:10px 18px;
    border-radius:10px;
    color:white;
    font-weight:600;
}

.save-btn:hover{
    background:#5e3b28;
}

.close-btn{
    border-radius:10px;
}

/* DATATABLE */

.dataTables_wrapper .dataTables_filter input{
    border-radius:10px;
    border:1px solid #ccc;
    padding:5px 10px;
}

.dataTables_wrapper .dataTables_length select{
    border-radius:10px;
    padding:5px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->
<?php include '../includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div class="main-content">

    <!-- HEADER -->
    <div class="top-section">

        <h1>
            🍰 Products Management
        </h1>

        <p>
            Manage all pastry shop products and menu items with a coffee-inspired dashboard.
        </p>

    </div>

    <!-- CARD -->
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold" style="color:#6f4e37;">
                Product Records
            </h3>

            <button class="add-btn" id="addBtn">
                + Add Product
            </button>

        </div>

        <!-- TABLE -->
        <table id="productTable" class="table table-bordered table-striped align-middle">

            <thead class="table-dark text-center">

                <tr>

                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th width="180">Action</th>

                </tr>

            </thead>

        </table>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="productModal" tabindex="-1">

    <div class="modal-dialog">

        <form id="productForm">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Product Form
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input type="hidden"
                           name="ProductID"
                           id="ProductID">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Product Name
                        </label>

                        <input type="text"
                               name="ProductName"
                               class="form-control"
                               placeholder="Enter product name"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Category
                        </label>

                        <select name="CategoryID"
                                class="form-select"
                                required>

                            <option value="">
                                Select Category
                            </option>

                            <?php

                            $categories = $pdo->query("SELECT * FROM categories");

                            while($c = $categories->fetch()){

                                echo "
                                <option value='{$c['CategoryID']}'>
                                    {$c['CategoryName']}
                                </option>
                                ";

                            }

                            ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Unit
                        </label>

                        <input type="text"
                               name="Unit"
                               class="form-control"
                               placeholder="ex. box, tray, piece">

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Price
                        </label>

                        <input type="number"
                               name="Price"
                               class="form-control"
                               placeholder="Enter product price">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="save-btn">
                        Save Product
                    </button>

                    <button type="button"
                            class="btn btn-secondary close-btn"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>

let table = $('#productTable').DataTable({

    ajax:'fetch.php',

    columns:[

        { data:'ProductID' },

        { data:'ProductName' },

        { data:'CategoryName' },

        { data:'Unit' },

        {
            data:'Price',
            render:function(data){
                return '₱ ' + parseFloat(data).toFixed(2);
            }
        },

        {
            data:null,

            render:function(data){

                return `
                    <button class="btn btn-sm editBtn"
                            data-id="${data.ProductID}">
                        Edit
                    </button>

                    <button class="btn btn-sm deleteBtn"
                            data-id="${data.ProductID}">
                        Delete
                    </button>
                `;
            }
        }

    ]

});

let modal = new bootstrap.Modal(
    document.getElementById('productModal')
);

/* ADD BUTTON */

$('#addBtn').click(function(){

    $('#productForm')[0].reset();

    $('#ProductID').val('');

    modal.show();

});

/* INSERT + UPDATE */

$('#productForm').submit(function(e){

    e.preventDefault();

    let url = $('#ProductID').val()
        ? 'update.php'
        : 'insert.php';

    $.post(url, $(this).serialize(), function(res){

        modal.hide();

        table.ajax.reload();

        Swal.fire({
            icon:'success',
            title:'Success',
            text:res.message,
            confirmButtonColor:'#7f5539'
        });

    }, 'json');

});

/* EDIT */

$(document).on('click', '.editBtn', function(){

    let id = $(this).data('id');

    $.get('fetch.php', {id:id}, function(data){

        let p = data[0];

        $('#ProductID').val(p.ProductID);

        $('[name="ProductName"]').val(p.ProductName);

        $('[name="CategoryID"]').val(p.CategoryID);

        $('[name="Unit"]').val(p.Unit);

        $('[name="Price"]').val(p.Price);

        modal.show();

    }, 'json');

});

/* DELETE */

$(document).on('click', '.deleteBtn', function(){

    let id = $(this).data('id');

    Swal.fire({

        title:'Delete Product?',
        text:'This action cannot be undone.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Delete',
        confirmButtonColor:'#b56576',
        cancelButtonColor:'#6c757d'

    }).then((result)=>{

        if(result.isConfirmed){

            $.post('delete.php', {id:id}, function(res){

                table.ajax.reload();

                Swal.fire({
                    icon:'success',
                    title:'Deleted',
                    text:res.message,
                    confirmButtonColor:'#7f5539'
                });

            }, 'json');

        }

    });

});

</script>

</body>
</html>