<?php
require 'database.php';

$id = $_GET['id'] ?? 0;

$stmt = $db->prepare("DELETE FROM tarefas WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
