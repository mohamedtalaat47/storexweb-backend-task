<?php

include_once("../includes/crud.php");

$crud = new crud();

if (isset($_POST['submit'])) {
    $data = array(
        "title"  => $crud->escape_string($_POST['title']),
    );

    $crud->insert($data, 'categories');

    if ($data) {
        echo 'insert successfully';
        header('location:../index.php');
    } else {
        echo 'try again';
    }
}

?>
<?php include '../includes/header.php' ?>

<div class="container w-50 mt-5">
    <h1 class="text-center">Add category</h1>
    <form method="POST">

        <label class="form-label">title</label>
        <input class="form-control" type="text" name="title"><br>

        <input class="btn btn-primary" type="submit" name="submit">

    </form>


    <?php include '../includes/footer.php' ?>