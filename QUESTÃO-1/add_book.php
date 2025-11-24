<?php
require_once 'database.php';

$titulo = trim($_POST['titulo'] ?? '');
$autor  = trim($_POST['autor'] ?? '');
$ano    = intval($_POST['ano'] ?? 0);

if ($titulo === '' || $autor === '' || $ano == 0) {

    die('Dados inválidos. Volte e preencha todos os campos corretamente.');
}

$stmt = $db->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
$stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
$stmt->bindValue(':autor', $autor, PDO::PARAM_STR);
$stmt->bindValue(':ano', $ano, PDO::PARAM_INT);
$stmt->execute();

header('Location: index.php');
exit;
