<?php
require 'database.php';

$tarefa = $_POST['tarefa'] ?? '';
$horario = $_POST['horario'] ?? null;

if (!empty($tarefa)) {
    $stmt = $db->prepare("INSERT INTO tarefas (tarefa, horario) VALUES (?, ?)");
    $stmt->execute([$tarefa, $horario]);
}

header("Location: index.php");
exit;
?>
