<?php include 'includes/db.php'; ?>

<?php

/* TOTAL COUNTS */

$customers = $pdo->query("
    SELECT COUNT(*) as total
    FROM customers
")->fetch();

$products = $pdo->query("
    SELECT COUNT(*) as total
    FROM products
")->fetch();

$orders = $pdo->query("
    SELECT COUNT(*) as total
    FROM orders
")->fetch();

$suppliers = $pdo->query("
    SELECT COUNT(*) as total
    FROM suppliers
")->fetch();

$employees = $pdo->query("
    SELECT COUNT(*) as total
    FROM employees
")->fetch();

$categories = $pdo->query("
    SELECT COUNT(*) as total
    FROM categories
")->fetch();

/* RECENT ORDERS */

$recentOrders = $pdo->query("
    SELECT
        orders.OrderID,
        customers.CustomerName,
        orders.OrderDate
    FROM orders
    JOIN customers
    ON orders.CustomerID = customers.CustomerID
    ORDER BY orders.OrderID DESC
    LIMIT 5
");

/* PRODUCT LIST */

$productList = $pdo->query("
    SELECT ProductName, Unit, Price
    FROM products
    ORDER BY ProductID DESC
    LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Pastry Shop Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">

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
    background:linear-gradient(
        to bottom,
        #6f4e37,
        #4e342e
    );
    position:fixed;
    color:white;
    padding-top:25px;
    box-shadow:4px 0 20px rgba(0,0,0,0.08);
}

.logo{
    text-align:center;
    font-size:28px;
    font-weight:700;
    margin-bottom:35px;
}

.sidebar ul{
    list-style:none;
    padding:0;
}

.sidebar ul li{
    margin:8px 15px;
    border-radius:14px;
    transition:0.3s;
}

.sidebar ul li:hover{
    background:rgba(255,255,255,0.12);
}

.sidebar ul li a{
    display:block;
    color:white;
    text-decoration:none;
    padding:14px 18px;
    font-size:15px;
    font-weight:500;
}

/* MAIN */

.main-content{
    margin-left:260px;
    width:100%;
    padding:30px;
}

/* HERO */

.hero{
    background:linear-gradient(
        135deg,
        #c8a27a,
        #ddb892
    );
    border-radius:30px;
    padding:40px;
    margin-bottom:30px;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
}

.hero h1{
    color:white;
    font-size:42px;
    font-weight:700;
}

.hero p{
    color:white;
    margin-top:10px;
    font-size:16px;
}

/* STATS CARD */

.stats-card{
    border-radius:24px;
    padding:25px;
    position:relative;
    overflow:hidden;
    transition:0.3s;
    cursor:pointer;
    text-decoration:none;
    display:block;
    color:#4e342e;
    box-shadow:0 6px 18px rgba(0,0,0,0.05);
}

.stats-card:hover{
    transform:translateY(-5px);
}

.stats-card i{
    position:absolute;
    right:20px;
    bottom:20px;
    font-size:42px;
    opacity:0.25;
}

.stats-card h5{
    font-size:15px;
    margin-bottom:10px;
}

.stats-card h2{
    font-size:38px;
    font-weight:700;
}

/* CARD COLORS */

.bg1{
    background:#ede0d4;
}

.bg2{
    background:#e6ccb2;
}

.bg3{
    background:#ddb892;
}

.bg4{
    background:#b08968;
    color:white;
}

.bg5{
    background:#a98467;
    color:white;
}

.bg6{
    background:#d6ccc2;
}

/* CONTENT BOX */

.content-box{
    background:white;
    border-radius:24px;
    padding:25px;
    margin-top:30px;
    box-shadow:0 5px 18px rgba(0,0,0,0.05);
}

.content-box h4{
    color:#6f4e37;
    font-weight:700;
    margin-bottom:20px;
}

/* TABLE */

.table{
    border-radius:15px;
    overflow:hidden;
}

.table thead{
    background:#6f4e37;
    color:white;
}

.table td{
    vertical-align:middle;
}

/* BADGES */

.badge-stock{
    background:#198754;
}

.badge-low{
    background:#ffc107;
    color:black;
}

.badge-out{
    background:#dc3545;
}

/* NOTIFICATION */

.notification{
    padding:15px;
    border-radius:14px;
    margin-bottom:15px;
    font-weight:500;
}

.notif1{
    background:#fff3cd;
}

.notif2{
    background:#f8d7da;
}

.notif3{
    background:#d1ecf1;
}

.open-btn{
    background:#6f4e37;
    color:white;
    border:none;
    border-radius:10px;
    padding:8px 14px;
    text-decoration:none;
}

.open-btn:hover{
    background:#8b5e3c;
    color:white;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">
         Pastry Shop
    </div>

    <ul>

        <li>
            <a href="index.php">
                Dashboard
            </a>
        </li>

        <li>
            <a href="customers/index.php">
                Customers
            </a>
        </li>

        <li>
            <a href="products/index.php">
                Products
            </a>
        </li>

        <li>
            <a href="orders/index.php">
                 Categories   
            </a>
        </li>

         <li>
            <a href="orderdetails/index.php">
                Orders 
            </a>
        </li>

        <li>
            <a href="categories/index.php">
                Order Details
            </a>
        </li>

        <li>
            <a href="employees/index.php">
                Suppliers
            </a>
        </li>

        <li>
            <a href="suppliers/index.php">
                Shippers   
            </a>
        </li>

        <li>
            <a href="shippers/index.php">
                Employees    
            </a>
        </li>

    </ul>

</div>

<!-- MAIN -->

<div class="main-content">

    <!-- HERO -->

    <div class="hero">

        <h1>
            ☕ Pastry Shop Dashboard
        </h1>

        <p>
            Elegant management system for customers, products, orders, suppliers, and employees.
        </p>

    </div>

    <!-- STATS -->

    <div class="row g-4">

        <div class="col-md-4 col-lg-2">

            <a href="customers/index.php"
               class="stats-card bg1">

                <h5>
                    Customers
                </h5>

                <h2>
                    <?php echo $customers['total']; ?>
                </h2>

                <i class="bi bi-people-fill"></i>

            </a>

        </div>

        <div class="col-md-4 col-lg-2">

            <a href="products/index.php"
               class="stats-card bg2">

                <h5>
                    Products
                </h5>

                <h2>
                    <?php echo $products['total']; ?>
                </h2>

                <i class="bi bi-box-seam"></i>

            </a>

        </div>

        <div class="col-md-4 col-lg-2">

            <a href="orders/index.php"
               class="stats-card bg3">

                <h5>
                    Orders
                </h5>

                <h2>
                    <?php echo $orders['total']; ?>
                </h2>

                <i class="bi bi-cart-fill"></i>

            </a>

        </div>

        <div class="col-md-4 col-lg-2">

            <a href="suppliers/index.php"
               class="stats-card bg4">

                <h5>
                    Suppliers
                </h5>

                <h2>
                    <?php echo $suppliers['total']; ?>
                </h2>

                <i class="bi bi-truck"></i>

            </a>

        </div>

        <div class="col-md-4 col-lg-2">

            <a href="employees/index.php"
               class="stats-card bg5">

                <h5>
                    Employees
                </h5>

                <h2>
                    <?php echo $employees['total']; ?>
                </h2>

                <i class="bi bi-person-badge-fill"></i>

            </a>

        </div>

        <div class="col-md-4 col-lg-2">

            <a href="categories/index.php"
               class="stats-card bg6">

                <h5>
                    Categories
                </h5>

                <h2>
                    <?php echo $categories['total']; ?>
                </h2>

                <i class="bi bi-tags-fill"></i>

            </a>

        </div>

    </div>

    <!-- CONTENT -->

    <div class="row">

        <!-- INVENTORY -->

        <div class="col-lg-8">

            <div class="content-box">

                <h4>
                    <i class="bi bi-box"></i>
                    Product Inventory
                </h4>

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>Product</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while($p = $productList->fetch()) { ?>

                        <tr>

                            <td>
                                <?php echo $p['ProductName']; ?>
                            </td>

                            <td>
                                <?php echo $p['Unit']; ?>
                            </td>

                            <td>
                                ₱ <?php echo number_format($p['Price'],2); ?>
                            </td>

                            <td>

                                <?php

                                if($p['Price'] <= 50){

                                    echo "
                                    <span class='badge badge-out'>
                                        Out of Stock
                                    </span>
                                    ";

                                }elseif($p['Price'] <= 100){

                                    echo "
                                    <span class='badge badge-low'>
                                        Low Stock
                                    </span>
                                    ";

                                }else{

                                    echo "
                                    <span class='badge badge-stock'>
                                        In Stock
                                    </span>
                                    ";

                                }

                                ?>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="col-lg-4">

            <!-- NOTIFICATIONS -->

            <div class="content-box">

                <h4>
                    <i class="bi bi-bell"></i>
                    Notifications
                </h4>

                <div class="notification notif1">
                    New orders were added today.
                </div>

                <div class="notification notif2">
                    Some products need restocking.
                </div>

                <div class="notification notif3">
                    Supplier deliveries incoming.
                </div>

            </div>

        </div>

    </div>

    <!-- RECENT ORDERS -->

    <div class="content-box">

        <h4>
            <i class="bi bi-receipt"></i>
            Recent Orders
        </h4>

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            <?php while($o = $recentOrders->fetch()) { ?>

                <tr>

                    <td>
                        #<?php echo $o['OrderID']; ?>
                    </td>

                    <td>
                        <?php echo $o['CustomerName']; ?>
                    </td>

                    <td>
                        <?php echo $o['OrderDate']; ?>
                    </td>

                    <td>

                        <a href="orders/index.php"
                           class="open-btn">

                            Open

                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>