<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../styles/bootstrap.css" />
  <link rel="stylesheet" href="./styles.css" />

  <script src="../scripts/jquery-3.5.1.min.js"></script>

  <title>Petshop - Espécies</title>
</head>

<?php
$conexao = new mysqli("localhost", "root", "vertrigo", "petshop");

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $sql = $conexao->query("SELECT * FROM especie WHERE id = " . $id);
  $linha = $sql->fetch_assoc();

  $descricao = $linha["descricao"];
} else {
  $id = 0;
  $descricao = "";
}
?>

<body>
  <div class="container">
    <h1>Espécies</h1>

    <form action="processos.php" method="POST">
      <div class="input-group">
        <div class="form-group small-width">
          <label for="id">ID</label>
          <input id="id" type="text" name="id" value="<?= $id ?>" class="form-control" disabled />
        </div>

        <div class="form-group">
          <label for="descricao">Descrição</label>
          <input id="descricao" type="text" name="descricao" value="<?= $descricao ?>" class="form-control" required />
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
            <th>ID</th>
            <th class="large-width">Descrição</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $conexao = new mysqli("localhost", "root", "vertrigo", "petshop");
          $tabela = $conexao->query("SELECT * FROM especie");

          $cont = 0;

          while ($linha = $tabela->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $linha["id"]; ?></td>
              <td><?= $linha["descricao"]; ?></td>
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