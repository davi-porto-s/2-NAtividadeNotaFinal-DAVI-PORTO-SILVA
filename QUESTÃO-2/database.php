<?php
// database.php
$db = new PDO('sqlite:tarefas.db');

$db->exec("
    CREATE TABLE IF NOT EXISTS tarefas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        tarefa TEXT NOT NULL,
        horario TIME,
        concluida INTEGER DEFAULT 0
    )
");
?>
