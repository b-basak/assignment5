<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todoList";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    $conn->query($sql);
}


if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];
    $sql = "UPDATE tasks SET status = $status WHERE id = $task_id";
    $conn->query($sql);
}


$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Todo-List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="container d-flex justify-content-center">
            <div>
            <h1 class="todo">Todo List</h1>
            <form method="POST" action="index.php">
                <input class="form-control" type="text" name="task" placeholder="Add new task" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add</button>
            </form>

            <ul>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <input type="checkbox" <?php if ($row['status']) echo 'checked'; ?>>
                        <h4><?php echo $row['task']; ?></h4>
                        <form method="POST" action="index.php">
                         <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="<?php echo $row['status'] ? 0 : 1; ?>">
                            <button class=" btn btn-outline-secondary" type="submit">Status</button>
                        </form>
                    </li>
                <?php } ?>
            </ul>
            </div>
           
        </div>
    </section>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>