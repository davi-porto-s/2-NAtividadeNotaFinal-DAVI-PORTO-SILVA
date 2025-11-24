<?php
require 'database.php';

$id = $_GET['id'] ?? 0;

$stmt = $db->prepare("UPDATE tarefas SET concluida = 1 WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
