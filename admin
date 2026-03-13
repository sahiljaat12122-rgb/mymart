<?php
session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="hi">
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">👑 Admin Panel</a>
            <a href="../index.php" class="btn btn-primary">Home</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="add_product.php" class="list-group-item list-group-item-action">➕ नया उत्पाद जोड़ें</a>
                    <a href="manage_products.php" class="list-group-item list-group-item-action active">📋 सभी उत्पाद</a>
                </div>
            </div>
            <div class="col-md-9">
                <h2>सभी उत्पाद</h2>
                <a href="add_product.php" class="btn btn-success mb-3">➕ नया उत्पाद जोड़ें</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td><img src="../uploads/<?php echo $product['image']; ?>" width="50"></td>
                            <td><?php echo $product['name']; ?></td>
                            <td>₹<?php echo $product['price']; ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <span class="badge <?php echo $product['status']=='active' ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $product['status']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('हटाने को सुनिश्चित हैं?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
