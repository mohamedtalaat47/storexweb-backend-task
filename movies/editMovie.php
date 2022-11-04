<?php

include_once("../includes/crud.php");

$id = $_GET['editid'];

$crud = new crud();

$data = $crud->selectbyid('movies', $id);

if (isset($_POST['submit'])) {

    $movie_image = date('Y-m-d-h-s') . $_FILES['image']['name'];
    $movie_image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($movie_image_tmp, "../uploads/$movie_image");

    $data = array(

        "title"  => $crud->escape_string($_POST['title']),
        "description"  => $crud->escape_string($_POST['description']),
        "category_id"  => $crud->escape_string($_POST['category_id']),
        "rate"  => $crud->escape_string($_POST['rate']),
        "image"  => $crud->escape_string($movie_image)


    );

    $crud->update($data, 'movies', $id);

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
    <h1 class="text-center">Edit movie</h1>
    <form method="POST" enctype="multipart/form-data" name="form">

        <label class="form-label">title</label>
        <input class="form-control" type="text" name="title" value="<?php echo $data['title']; ?>" required><br />

        <label class="form-label">description</label>
        <input class="form-control" type="text" name="description" value="<?php echo $data['description']; ?>" required><br />

        <label class="form-label">rate</label>
        <input class="form-control" type="number" name="rate" min="0" max="10" required value="<?php echo $data['rate']; ?>"><br />

        <label class="form-label">category</label>
        <select class="form-control" type="text" name="category_id" required>
            <?php
            $crud = new crud();
            $result = $crud->selectalldata("categories");

            while ($data = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></option>
            <?php } ?>
        </select><br>
        <label class="form-label">image</label>
        <input class="form-control" type="file" name="image" value="<?php echo $data['image']; ?>" required><br/>

        <input class="btn btn-primary" type="submit" name="submit">

    </form>
</div>

<?php include '../includes/footer.php' ?>