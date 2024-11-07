<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM tarefa";
$tarefas = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                LISTA DE TAREFAS! <i class="bi bi-card-checklist"></i>
                                <a href="tarefa-create.php" class="btn btn-outline-primary float-end">Adicionar tarefa</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php include('mensagem.php'); ?>
                            <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tarefa</th>
                                        <th>Descrição</th>
                                        <th>Status</th>
                                        <th>Data limite</th>
                                        <th>Avanço <i class="bi bi-check-square-fill"></i></th>
                                        <th>Editar </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <tr>
                                        <td><?php echo $tarefa['id']; ?></td>
                                        <td><?php echo $tarefa['nome']; ?></td>
                                        <td><?php echo $tarefa['descricao']; ?></td>
                                        <td>
                                                <?php
                                                    if ($tarefa['status'] == 0) {
                                                        echo "Pendente";
                                                    } elseif ($tarefa['status'] == 1) {
                                                        echo "Em execução";
                                                    } else {
                                                        echo "Concluido";
                                                    }
                                            ?>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($tarefa['data_limite'])); ?></td>
                                        <td>
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('A tarefa voltará a estar pendente?')" name="avanc0" type="submite" value="<?=$tarefa['id']?>" class="btn btn-outline-secondary btn-sm">Pendente</button>
                                            </form>
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('A tarefa está em execução?')" name="avanc1" type="submit" value="<?=$tarefa['id']?>" class="btn btn-outline-warning btn-sm">Em execução</button>
                                            </form>
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('A tarefa foi concluída?')" name="avanc2" type="submit" value="<?=$tarefa['id']?>" class="btn btn-outline-success btn-sm">Concluido</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="tarefa-edit.php?id=<?=$tarefa['id']?>" class="btn btn-outline-info btn-sm"><i class="bi bi-pen-fill"></i></a>
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Tem certeza que deseja excluir a tarefa?')" name="delete_tarefa" type="submit" value="<?=$tarefa['id']?>" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                            </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>