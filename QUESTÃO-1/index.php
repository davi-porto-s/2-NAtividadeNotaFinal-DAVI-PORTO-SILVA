<?php
require_once 'database.php';
$livros = $db->query("SELECT * FROM livros ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Banco de Dados Livraria</title>

<style>
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #3498DB; margin:20px; min-height: 100vh; }
.page-title { text-align:center; font-size:38px; color:white; margin-bottom:30px; font-weight:600; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
.wrapper { display:flex; gap:20px; max-width:1000px; margin:auto; }
.box { background:white; padding:22px; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.12); }
.box h2 { color: #000067; }
.add-box { width:35%; }
.list-box { width:65%; }
form input, form button { padding:11px; margin-bottom:10px; width:100%; box-sizing:border-box; border-radius:6px; border: 2px solid #e0e0e0; font-size: 14px; }
button { background: #56C251; color:white; border:none; border-radius:6px; cursor:pointer; font-weight: 600; }
button.delete { background: linear-gradient(135deg, #FF4549 0%, #c72125 100%); }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { padding:12px; text-align:center; }
th { background: #56C251; color:white; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
</style>

<script>
function confirmarExclusao() {
    return confirm('Tem certeza que deseja excluir este livro?');
}
</script>

</head>
<body>

<h1 class="page-title">Livraria</h1>

<div class="wrapper">

    <div class="box add-box">
        <h2>Adicionar Livro</h2>
        <form method="POST" action="add_book.php">
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="text" name="autor" placeholder="Autor" required>
            <input type="number" name="ano" placeholder="Ano de publicação" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>

    <div class="box list-box">
        <h2>Lista de Livros</h2>

        <?php if (empty($livros)): ?>
            <p style="text-align:center;color:#666;">Nenhum livro cadastrado.</p>
        <?php else: ?>

        <table>
            <thead>
                <tr><th>ID</th><th>Título</th><th>Autor</th><th>Ano</th><th>Ação</th></tr>
            </thead>
            <tbody>
            <?php foreach ($livros as $livro): ?>
                <tr>
                    <td><?= htmlspecialchars($livro['id']) ?></td>
                    <td><?= htmlspecialchars($livro['titulo']) ?></td>
                    <td><?= htmlspecialchars($livro['autor']) ?></td>
                    <td><?= htmlspecialchars($livro['ano']) ?></td>
                    <td>
                        <form method="POST" action="delete_book.php" onsubmit="return confirmarExclusao()" style="margin:0;">
                            <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                            <button type="submit" class="delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php endif; ?>
    </div>

</div>

</body>
</html>
