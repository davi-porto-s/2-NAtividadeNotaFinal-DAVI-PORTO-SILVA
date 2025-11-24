<?php
require_once 'database.php';

if (!empty($_POST['id'])) {
    $stmt = $db->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}

header("Location: index.php");
exit;
?>
