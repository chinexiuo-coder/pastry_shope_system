<?php include '../includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customers Management</title>

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

        .form-control{
            border-radius:12px;
            padding:12px;
            border:1px solid #d6ccc2;
        }

        .form-control:focus{
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
            ☕ Customers Management
        </h1>

        <p>
            Manage your pastry shop customers with a modern coffee-inspired dashboard.
        </p>

    </div>

    <!-- CARD -->
    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold" style="color:#6f4e37;">
                Customer Records
            </h3>

            <button class="add-btn" id="addBtn">
                + Add Customer
            </button>

        </div>

        <!-- TABLE -->
        <table id="customerTable" class="table table-bordered table-striped align-middle">

            <thead class="table-dark text-center">

                <tr>

                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Contact Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Country</th>
                    <th width="180">Action</th>

                </tr>

            </thead>

        </table>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="customerModal" tabindex="-1">

    <div class="modal-dialog">

        <form id="customerForm">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Customer Form
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input type="hidden"
                           name="CustomerID"
                           id="CustomerID">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Customer Name
                        </label>

                        <input type="text"
                               name="CustomerName"
                               class="form-control"
                               placeholder="Enter customer name"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Contact Name
                        </label>

                        <input type="text"
                               name="ContactName"
                               class="form-control"
                               placeholder="Enter contact name">

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Address
                        </label>

                        <input type="text"
                               name="Address"
                               class="form-control"
                               placeholder="Enter address">

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            City
                        </label>

                        <input type="text"
                               name="City"
                               class="form-control"
                               placeholder="Enter city">

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Country
                        </label>

                        <input type="text"
                               name="Country"
                               class="form-control"
                               placeholder="Enter country">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="save-btn">
                        Save
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

let table = $('#customerTable').DataTable({

    ajax: 'fetch.php',

    columns: [

        { data: 'CustomerID' },
        { data: 'CustomerName' },
        { data: 'ContactName' },
        { data: 'Address' },
        { data: 'City' },
        { data: 'Country' },

        {
            data: null,

            render: function(data){

                return `
                    <button class="btn btn-sm editBtn"
                            data-id="${data.CustomerID}">
                        Edit
                    </button>

                    <button class="btn btn-sm deleteBtn"
                            data-id="${data.CustomerID}">
                        Delete
                    </button>
                `;
            }
        }

    ]

});

let modal = new bootstrap.Modal(
    document.getElementById('customerModal')
);

/* ADD BUTTON */

$('#addBtn').click(function(){

    $('#customerForm')[0].reset();

    $('#CustomerID').val('');

    modal.show();

});

/* INSERT + UPDATE */

$('#customerForm').submit(function(e){

    e.preventDefault();

    let formData = $(this).serialize();

    let url = $('#CustomerID').val()
        ? 'update.php'
        : 'insert.php';

    $.post(url, formData, function(response){

        modal.hide();

        table.ajax.reload();

        Swal.fire({
            icon:'success',
            title:'Success',
            text:response.message,
            confirmButtonColor:'#7f5539'
        });

    }, 'json');

});

/* EDIT */

$(document).on('click', '.editBtn', function(){

    let id = $(this).data('id');

    $.get('fetch.php', { id:id }, function(data){

        let customer = data[0];

        $('#CustomerID').val(customer.CustomerID);

        $('[name="CustomerName"]').val(customer.CustomerName);

        $('[name="ContactName"]').val(customer.ContactName);

        $('[name="Address"]').val(customer.Address);

        $('[name="City"]').val(customer.City);

        $('[name="Country"]').val(customer.Country);

        modal.show();

    }, 'json');

});

/* DELETE */

$(document).on('click', '.deleteBtn', function () {

    let id = $(this).attr('data-id');

    Swal.fire({

        title: "Delete customer?",
        text:"This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor:'#b56576',
        cancelButtonColor:'#6c757d'

    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: 'delete.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',

                success: function (res) {

                    Swal.fire({
                        icon:'success',
                        title:'Deleted',
                        text:res.message,
                        confirmButtonColor:'#7f5539'
                    });

                    $('#customerTable').DataTable().ajax.reload(null, false);

                }

            });

        }

    });

});

</script>

</body>
</html>