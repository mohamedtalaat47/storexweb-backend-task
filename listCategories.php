<?php

if (!isset($_SESSION['login'])) {
    header('location:login.php');
}

include_once "includes/crud.php";

if (!empty($_GET['delid'])) {

    $id = $_GET['delid'];

    $crud = new crud();
    $crud->deletedata("categories", $id);
    header('location:index.php');
}

?>

<div class="card shadow border-0 mb-7">
    <div class="card-header">
        <h5 class="mb-0">categories</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $crud = new crud();
                $result = $crud->selectalldata("categories");

                while ($data = mysqli_fetch_array($result)) {
                ?>

                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['title']; ?></td>
                        <td><a href="categories/editCategory.php?editid=<?php echo $data['id']; ?>">edit</a><a class="ms-2 text-danger" href="listCategories.php?delid=<?php echo $data['id']; ?>" onclick=" return confirm('All movies from this category will be deleted as well, continue?')">delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer border-0 py-2"> </div>
</div>