<?php
include("config.php");
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Märgi tehtuks
if (isset($_GET['done'])) {
    $id = intval($_GET['done']);
    $conn->query("UPDATE probleemid SET staatus='tehtud' WHERE id=$id");
}

// Kustuta
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $conn->query("DELETE FROM probleemid WHERE id=$id");
}

$andmed = $conn->query("SELECT * FROM probleemid");
$kokku = $andmed->num_rows;
$lahendatud = $conn->query("SELECT COUNT(*) FROM probleemid WHERE staatus='tehtud'")->fetch_row()[0];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Kasutajatugi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Kõik pöördumised</h2>
    <p>Kokku: <?= $kokku ?> | Lahendatud: <?= $lahendatud ?> | Lahendamata: <?= ($kokku - $lahendatud) ?></p>
    <table class="table table-bordered">
        <tr>
            <th>Nimi</th><th>Osakond</th><th>Kontakt</th><th>Probleem</th><th>Staatus</th><th>Tegevus</th>
        </tr>
        <?php while ($rida = $andmed->fetch_assoc()): ?>
        <tr>
            <td><?= $rida['nimi'] ?></td>
            <td><?= $rida['osakond'] ?></td>
            <td><?= $rida['kontakt'] ?></td>
            <td><?= $rida['probleem'] ?></td>
            <td><?= $rida['staatus'] ?></td>
            <td>
                <a href="?done=<?= $rida['id'] ?>" class="btn btn-success btn-sm">Tehtud</a>
                <a href="?del=<?= $rida['id'] ?>" class="btn btn-danger btn-sm">Kustuta</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php" class="btn btn-secondary">Logi välja</a>
</body>
</html>
