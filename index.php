<?php
session_start();
include 'config/database.php';

$stmt = $pdo->query("SELECT * FROM products WHERE status='active' ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <title>मेरा ऑनलाइन स्टोर</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">🛒 मेरा स्टोर</a>
            <div class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a class="nav-link" href="cart.php">🛒 Cart</a>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <a class="nav-link" href="admin/">Admin Panel</a>
                    <?php endif; ?>
                    <a class="nav-link" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="register.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">🔥 हमारे उत्पाद</h1>
        <div class="row">
            <?php foreach($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <img src="uploads/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo substr($product['description'], 0, 100); ?>...</p>
                        <h6 class="text-danger">₹<?php echo $product['price']; ?></h6>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">देखें</a>
                        <a href="cart.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-success">🛒 Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
