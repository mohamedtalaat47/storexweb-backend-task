<?php

if (!isset($_SESSION['login'])) {
    header('location:login.php');
}

include_once "includes/crud.php";

if (!empty($_GET['delid'])) {

    $id = $_GET['delid'];

    $crud = new crud();
    $crud->deletedata("movies", $id);
    header('location:index.php');
}

?>

<div class="card shadow border-0 mb-7">
    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Movies</h5>

        <form class="d-flex align-items-center" method="POST">

            <input class="form-control mx-3" type="text" name="name" placeholder="search by name">

            <label class="form-label mx-3">category </label>
            <select class="form-control" name="category">
            <option value="all">all</option>
                <?php
                $crud = new crud();
                $result = $crud->selectalldata("categories");
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></option>
                <?php } ?>
            </select>


            <label class="form-label" for="points">Rate</label>

            <input class="form-range mx-3" type="range" name="rate" min="0" max="10" value="0" oninput="this.nextElementSibling.value = this.value">
            <output>0</output>

            <input type="submit" name="submit" class="btn btn-outline-success ms-3" value="apply filters">
            <a href="index.php"><button class="btn btn-outline-dark ms-3">reset</button></a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Rate</th>
                    <th scope="col">category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $crud = new crud();
                $db = new dbconnect();

                if (isset($_POST['submit'])) {
                    $query = "SELECT * FROM movies WHERE";

                    if (isset($_POST['rate'])) {
                        $query .= " rate >= " . $_POST['rate'] . "";
                    }
                    if (isset($_POST['name'])) {
                        $query .= " and title LIKE '%" . $_POST['name'] . "%'";
                    }
                    if (isset($_POST['category'])) {
                        if ($_POST['category'] !== 'all') {
                            $query .= " and category_id = " . $_POST['category'] . "";
                        }
                    }
                    $result = $db->connection->query($query);
                } else {
                    $result = $crud->selectalldata("movies");
                }
                while ($data = mysqli_fetch_array($result)) {
                ?>

                    <tr>
                        <td><img class="img-fluid" src="uploads/<?php echo $data['image']; ?>" width="200px"></td>
                        <td><?php echo $data['title']; ?></td>
                        <td><?php echo $data['description']; ?></td>
                        <td><?php echo $data['rate']; ?>/10</td>
                        <td><?php echo $crud->catName($data['category_id'])['title'] ?></td>
                        <td><a href="movies/editMovie.php?editid=<?php echo $data['id']; ?>">edit</a><a class="ms-2 text-danger" href="listMovies.php?delid=<?php echo $data['id']; ?>" onclick=" return confirm('Do You really want to delete this data')">delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer border-0 py-2"> </div>
</div>