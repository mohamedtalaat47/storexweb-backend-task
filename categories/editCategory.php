<?php

include_once("../includes/crud.php");

$id = $_GET['editid'];

$crud = new crud();

$data = $crud->selectbyid('categories', $id);

if (isset($_POST['submit'])) {
    $data = array(
        "title"  => $crud->escape_string($_POST['title']),
    );

    $crud->update($data, 'categories', $id);

    if ($data) {
        echo 'updated successfully';
        header('location:../index.php');
    } else {
        echo 'try again';
    }
}

?>
<?php include '../includes/header.php' ?>

<div class="container w-50 mt-5">
    <h1 class="text-center">Edit category</h1>
    <form method="POST">

        <label class="form-label">title</label>
        <input class="form-control" type="text" name="title" value="<?php echo $data['title']; ?>"><br />

        <input class="btn btn-primary" type="submit" name="submit">

    </form>
</div>

<?php include '../includes/footer.php' ?>