<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kasutajatugi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <!-- Bänneripilt -->
    <div class="text-center mb-4">
        <img src="assets/banner.jpg" class="img-fluid" alt="Kasutajatugi bänner" style="max-height: 250px;">
    </div>

    <h1 class="text-center">Kasutajatugi</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Nimi</label>
            <input type="text" name="nimi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Osakond</label>
            <input type="text" name="osakond" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kontakt</label>
            <input type="text" name="kontakt" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Probleemi kirjeldus</label>
            <textarea name="probleem" class="form-control" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Saada</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $stmt = $conn->prepare("INSERT INTO probleemid (nimi, osakond, kontakt, probleem, staatus) VALUES (?, ?, ?, ?, 'lahendamata')");
        $stmt->bind_param("ssss", $_POST['nimi'], $_POST['osakond'], $_POST['kontakt'], $_POST['probleem']);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Pöördumine saadetud!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Viga: ".$stmt->error."</div>";
        }
    }
    ?>
</body>
</html>

