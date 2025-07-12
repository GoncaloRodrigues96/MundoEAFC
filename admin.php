<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("sql213.infinityfree.com", "if0_39303418", "48zqslLVnWi2", "if0_39303418_mundoeafc");
    if ($conn->connect_error) die("Erro: " . $conn->connect_error);

    $titulo = $conn->real_escape_string($_POST["titulo"]);
    $origem = $conn->real_escape_string($_POST["origem"]);
    $imagem_url = $conn->real_escape_string($_POST["imagem_url"]);
    $texto = $conn->real_escape_string($_POST["texto"]);

    // Usa a data atual do servidor
    $sql = "INSERT INTO blog_posts (titulo, data, origem, imagem_url, texto) 
            VALUES ('$titulo', CURDATE(), '$origem', '$imagem_url', '$texto')";

    if ($conn->query($sql)) {
        $msg = "Post criado com sucesso!";
    } else {
        $msg = "Erro: " . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Admin - Criar Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="headerDIV">
    <a href="index.php" class="button-link">Home</a>
    <a href="admin.php" class="button-link">Refresh</a>
    <a href="fifapoints.html" class="button-link">Calcular EAFC Points</a>
</div>
    <h1>Admin - Criar Novo Post</h1>
    <?php if ($msg): ?><p class="mensagem"><?= $msg ?></p><?php endif; ?>
    <form method="POST">
        <label>Título:<br><input type="text" name="titulo" required></label><br>
        <label>Origem:<br><input type="text" name="origem" required></label><small>Exemplo: <code>@DetectiveFUT  | @GoncaloSR96</code></small><br><br>
        <label>Imagem (URL):<br><input type="url" name="imagem_url"></label><br>
        <label>Texto:<br><textarea name="texto" rows="10" required></textarea></label><br>
        <button type="submit">Publicar</button>
    </form>
</body>
</html>
