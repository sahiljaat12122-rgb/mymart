<?php
session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if($_POST) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    
    // Image Upload
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    
    $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image, category, stock) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $price, $description, $image, $category, $stock]);
    
    header('Location: index.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>नया उत्पाद जोड़ें</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>➕ नया उत्पाद जोड़ें</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>उत्पाद का नाम</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>मूल्य (₹)</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>विवरण</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label>श्रेणी</label>
                <input type="text" name="category" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>स्टॉक</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>फोटो</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success">💾 जोड़ें</button>
            <a href="index.php" class="btn btn-secondary">वापस</a>
        </form>
    </div>
</body>
</html>
