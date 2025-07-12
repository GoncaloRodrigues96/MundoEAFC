<?php
$conn = new mysqli("sql213.infinityfree.com", "if0_39303418", "48zqslLVnWi2", "if0_39303418_mundoeafc");
if ($conn->connect_error) die("Erro: " . $conn->connect_error);

// Verifica se foi submetida uma pesquisa
$search = "";
if (isset($_GET["search"])) {
    $search = $conn->real_escape_string($_GET["search"]);
    $query = "SELECT * FROM blog_posts 
              WHERE titulo LIKE '%$search%' 
              OR origem LIKE '%$search%' 
              OR texto LIKE '%$search%' 
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM blog_posts ORDER BY id DESC";
}

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Blog - Mundo EAFC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <div class="headerDIV">
            <a href="index.php" class="button-link">Início</a>
            <a href="fifapoints.html" class="button-link">Calcular EAFC Points</a>
        </div>
    <h1>Blog - Mundo EAFC</h1>

    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Procurar por título, origem ou texto..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <?php if ($result->num_rows === 0): ?>
        <p>Nenhum post encontrado.</p>
    <?php endif; ?>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="post">
            <h2  style="text-align: center;"><?= htmlspecialchars($row['titulo']) ?></h2>
            <!-- <p class="meta">Data: <?= $row['data'] ?> | Origem: <?= htmlspecialchars($row['origem']) ?></p> -->
            <?php if ($row['imagem_url']): ?>
                <img src="<?= htmlspecialchars($row['imagem_url']) ?>" alt="Imagem do post">
            <?php endif; ?>
            <p><?= nl2br(htmlspecialchars($row['texto'])) ?></p>
            <p class="meta" style="text-align: right;">Data: <?= $row['data'] ?> | Origem: <a href="https://x.com/<?= htmlspecialchars($row['origem']) ?>"  target="_blank"><?= htmlspecialchars($row['origem']) ?></a></p>
        </div>
    <?php endwhile; ?>
</body>
</html>
