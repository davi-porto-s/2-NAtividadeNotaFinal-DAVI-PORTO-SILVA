<?php require 'database.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Tarefas</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            background: #1a1a1a;
            padding: 40px 20px;
            color: #e0e0e0;
        }
        .container { 
            max-width: 650px;
            margin: auto;
            background: #2b2b2b;
            padding: 25px;
            border-radius: 8px;
        }
        h1 { 
            color: #ffffff;
            margin-bottom: 25px;
            font-size: 1.8em;
        }
        h2 { 
            margin-top: 25px;
            margin-bottom: 12px;
            color: #cccccc;
            font-size: 1.2em;
        }
        form { 
            background: #333333;
            padding: 18px;
            border-radius: 6px;
            margin-bottom: 18px;
        }
        input[type="text"], input[type="time"] { 
            padding: 10px;
            margin-bottom: 8px;
            width: 96%;
            border: 1px solid #444;
            border-radius: 4px;
            font-size: 15px;
            background: #1a1a1a;
            color: #e0e0e0;
        }
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }
        input[type="text"]:focus, input[type="time"]:focus {
            outline: none;
            border-color: #666;
        }
        button { 
            padding: 11px;
            width: 100%;
            background: #4a4a4a;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover {
            background: #5a5a5a;
        }
        .tarefa { 
            padding: 14px;
            background: #333333;
            margin-bottom: 10px;
            border-radius: 5px;
            border-left: 3px solid #555;
        }
        .concluida { 
            text-decoration: line-through;
            color: #777;
            opacity: 0.65;
        }
        .tarefa strong {
            color: #ffffff;
        }
        a { 
            text-decoration: none;
            margin-right: 8px;
            margin-top: 6px;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 14px;
            display: inline-block;
        }
        a:first-of-type {
            background: #3a3a3a;
            color: #66ff66;
        }
        a:last-of-type {
            background: #3a3a3a;
            color: #ff6666;
        }
        a:hover {
            background: #4a4a4a;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Gerenciador de Tarefas (por horário)</h1>

    <h2>Adicionar Nova Tarefa</h2>

    <form action="add_tarefa.php" method="POST">
        <input type="text" name="tarefa" placeholder="Descrição da tarefa" required>
        <input type="time" name="horario" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Tarefas Pendentes</h2>
    <?php
    $stmt = $db->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY horario ASC");
    foreach ($stmt as $tarefa):
    ?>
        <div class="tarefa">
            <strong><?= htmlspecialchars($tarefa['horario']) ?></strong> - <?= htmlspecialchars($tarefa['tarefa']) ?><br>
            <a href="update_tarefa.php?id=<?= intval($tarefa['id']) ?>">Concluir</a>
            <a href="delete_tarefa.php?id=<?= intval($tarefa['id']) ?>" onclick="return confirm('Excluir?')">Excluir</a>
        </div>
    <?php endforeach; ?>

    <h2>Tarefas Concluidas</h2>
    <?php
    $stmt = $db->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY horario ASC");
    foreach ($stmt as $tarefa):
    ?>
        <div class="tarefa concluida">
            <strong><?= htmlspecialchars($tarefa['horario']) ?></strong> - <?= htmlspecialchars($tarefa['tarefa']) ?><br>
            <span style="display: inline-block; margin-top: 8px;">Concluida</span>
            <a href="delete_tarefa.php?id=<?= intval($tarefa['id']) ?>" onclick="return confirm('Excluir?')">Excluir</a>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
