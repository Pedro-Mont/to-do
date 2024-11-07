<?php
session_start();
require_once('conexao.php');

if (isset($_POST['create_tarefa'])) {
    $nome = trim($_POST['txtNome']);
    $descricao = trim($_POST['txtDesc']);
    $dataLimite = trim($_POST['txtDataLimite']);

    $sql = "INSERT INTO tarefa (nome, descricao, status, data_limite) VALUES('$nome', '$descricao', 0, '$dataLimite')";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa criada com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível criar a tarefa {$tarefaId}";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['delete_tarefa']);
    $sql = "DELETE FROM tarefa WHERE id = '$tarefaId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa com ID {$tarefaId} foi excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível excluir a tarefa";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['edit_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['tarefa_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDesc']);
    $dataLimite = mysqli_real_escape_string($conn, $_POST['txtDataLimite']);

    $sql = "UPDATE tarefa SET nome = '{$nome}', descricao = '{$descricao}', data_limite = '{$dataLimite}'";

    $sql .= " WHERE id = '{$tarefaId}'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa {$tarefaId} editada com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível editar a tarefa {$tarefaId}";
        $_SESSION['type'] = 'error';
    }

    header("Location: index.php");
    exit;
}

if (isset($_POST['avanc1'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['avanc1']);
    $sql = "UPDATE tarefa SET status = 1 WHERE id = '{$tarefaId}'";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit;
}

if (isset($_POST['avanc2'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['avanc2']);
    $sql = "UPDATE tarefa SET status = 2 WHERE id = '{$tarefaId}'";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit;
}

if (isset($_POST['avanc0'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['avanc0']);
    $sql = "UPDATE tarefa SET status = 0 WHERE id = '{$tarefaId}'";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit;
}