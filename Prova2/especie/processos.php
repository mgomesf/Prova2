<?php
$id = $_POST["id"];
$descricao = $_POST["descricao"];

$conexao = new mysqli("localhost", "root", "vertrigo", "petshop");

if ($id == 0) {
    $sql = $conexao->prepare("INSERT INTO especie(descricao) VALUES (?)");
    $sql->bind_param("s", $descricao);
} else {
    $sql = $conexao->prepare("UPDATE especie SET descricao = ? WHERE id = ? ");
    $sql->bind_param("si", $descricao, $id);
}

$sql->execute();

mysqli_close($conexao);

header("location: index.php");
