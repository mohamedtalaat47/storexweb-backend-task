<?php

if (!isset($_SESSION['login'])) {
    header('location:login.php');
}

include_once "includes/crud.php";

if (!empty($_GET['delid'])) {

    $id = $_GET['delid'];

    $crud = new crud();
    $crud->deletedata("users", $id);
    header('location:index.php');
}

?>

<div class="card shadow border-0 mb-7">
    <div class="card-header">
        <h5 class="mb-0">users</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birthday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $crud = new crud();
                $result = $crud->selectalldata("users");

                while ($data = mysqli_fetch_array($result)) {
                ?>

                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['birthday']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer border-0 py-2"> </div>
</div>