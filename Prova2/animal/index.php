<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../styles/bootstrap.css" />
  <link rel="stylesheet" href="./styles.css" />

  <script src="../scripts/jquery-3.5.1.min.js"></script>
  <script src="./script.js"></script>

  <title>Petshop - Animais</title>
</head>

<?php
$conexao = new mysqli("localhost", "root", "vertrigo", "petshop");

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $sql = $conexao->query("SELECT a.id, a.nome, a.nome_dono, a.id_especie, e.descricao, a.raca, a.data_nascimento FROM animal a INNER JOIN especie e ON a.id_especie = e.id WHERE a.id = " . $id);
  $linha = $sql->fetch_assoc();

  $id_especie = $linha["id_especie"];
  $especie = $linha["descricao"];
  $nome = $linha["nome"];
  $nome_dono = $linha["nome_dono"];
  $raca = $linha["raca"];
  $data_nascimento = $linha["data_nascimento"];
} else {
  $id = 0;
  $id_especie = "";
  $especie = "";
  $nome = "";
  $nome_dono = "";
  $raca = "";
  $data_nascimento = "";
}
?>

<body>
  <div class="container">
    <h1>Animais</h1>

    <form action="processos.php" method="POST">
      <input id="id" type="hidden" name="id" value="<?= $id ?>" class="form-control" required />

      <div class="input-group">
        <div class="form-group">
          <label for="nome">Nome do animal</label>
          <input id="nome" type="text" name="nome" value="<?= $nome ?>" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="nome_dono">Nome do dono</label>
          <input id="nome_dono" type="text" name="nome_dono" value="<?= $nome_dono ?>" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="id_especie">Espécie</label>
          <select id="id_especie" name="id_especie" class="form-control" value="<?= $id_especie ?>" required>
            <option value=""></option>

            <?php
            $conexao = new mysqli("localhost", "root", "vertrigo", "petshop");
            $tabela = $conexao->query("SELECT * FROM especie");

            $cont = 0;

            while ($linha = $tabela->fetch_assoc()) {
            ?>
              <option value="<?= $linha["id"] ?>" <?= $linha["id"] == $id_especie ? "selected" : "" ?>><?= $linha["descricao"]; ?></option>
            <?php

              $cont += $cont;
            }

            mysqli_close($conexao);
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="raca">Raça</label>
          <input id="raca" type="text" name="raca" value="<?= $raca ?>" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="data_nascimento">Data de nascimento</label>
          <input id="data_nascimento" type="date" name="data_nascimento" value="<?= $data_nascimento ?>" class="form-control" required />
        </div>
      </div>

      <div class="button-group">
        <div>
          <button class="success" type="submit">Salvar</button>
          <button class="warning" type="reset">Limpar</button>
        </div>

        <a href="index.php" class="info">Novo</a>
      </div>
    </form>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Dono</th>
            <th>Espécie</th>
            <th>Raça</th>
            <th>Data de nascimento</th>
            <th class="small-width"></th>
            <th class="small-width"></th>
          </tr>
        </thead>
        <tbody id="body-table">
          <?php
          $conexao = new mysqli("localhost", "root", "vertrigo", "petshop");
          $tabela = $conexao->query("SELECT a.id, a.nome, a.nome_dono, e.descricao, a.raca, a.data_nascimento FROM animal a INNER JOIN especie e ON a.id_especie = e.id");

          $cont = 0;

          while ($linha = $tabela->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $linha["nome"]; ?></td>
              <td><?= $linha["nome_dono"]; ?></td>
              <td><?= $linha["descricao"]; ?></td>
              <td><?= $linha["raca"]; ?></td>
              <td id="mask-date-<?= $linha["id"] ?>" class="date-mask"><?= $linha["data_nascimento"]; ?></td>
              <td>
                <a href="index.php?id=<?= $linha["id"]; ?>" class="info">
                  Editar
                </a>
              </td>
              <td>
                <a href="excluir.php?id=<?= $linha["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="danger">
                  Excluir
                </a>
              </td>
            </tr>

          <?php

            $cont += $cont;
          }

          mysqli_close($conexao);
          ?>
        </tbody>
      </table>
    </div>

    <a href="../index.html" class="info">Voltar</a>
  </div>
</body>

</html>