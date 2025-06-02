<?php
session_start();
$hashitud_parool = '$2y$10$mvJyxoy2zMC7vboVJLTB0eQfMbvYj1nC7L/mnK1XW2UZ7g9K.RcHG'; // parool: admin123

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['kasutaja'] == 'admin' && password_verify($_POST['parool'], $hashitud_parool)) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $viga = "Vale kasutajanimi või parool!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logi sisse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Admini sisselogimine</h2>
    <?php if (isset($viga)): ?>
    <div class="alert alert-danger"><?= $viga ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Kasutajanimi</label>
            <input type="text" name="kasutaja" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Parool</label>
            <input type="password" name="parool" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">Logi sisse</button>
    </form>
</body>
</html>
