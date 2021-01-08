<?php
$id = $_POST["id"];
$id_especie = $_POST["id_especie"];
$nome = $_POST["nome"];
$nome_dono = $_POST["nome_dono"];
$raca = $_POST["raca"];
$data_nascimento = $_POST["data_nascimento"];

$conexao = new mysqli("localhost", "root", "vertrigo", "petshop");

if ($id == 0) {
    $sql = $conexao->prepare("INSERT INTO animal(id_especie, nome, nome_dono, raca, data_nascimento) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("issss", $id_especie, $nome, $nome_dono, $raca, $data_nascimento);
} else {
    $sql = $conexao->prepare("UPDATE animal SET id_especie = ?, nome = ?, nome_dono = ?, raca = ?, data_nascimento = ? WHERE id = ? ");
    $sql->bind_param("issssi", $id_especie, $nome, $nome_dono, $raca, $data_nascimento, $id);
}

$sql->execute();

mysqli_close($conexao);

header("location: index.php");
