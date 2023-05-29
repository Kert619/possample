<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/sidebar.php' ?>

<?php include_once 'includes/content-header.php' ?>

<?php
$db = new  DbConn();
$pdo = $db->connect();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = 'SELECT COUNT(id) as totalItems FROM categories WHERE category_name like :category_name';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':category_name', '%' . $search . '%');
$stmt->execute();
$result = $stmt->fetch();


$totalItems = $result['totalItems'];
$itemsPerPage = isset($_GET['entries']) ? $_GET['entries'] : 5;
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = "SELECT * FROM categories WHERE category_name LIKE :category_name ORDER BY id LIMIT $offset, $itemsPerPage";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':category_name', '%' . $search . '%');
$stmt->execute();
$result = $stmt->fetchAll();

?>

<div class="content mt-3">
    <div class="row m-0 justify-content-end gx-4 gx-md-3 gy-2">
        <div class="col-md-6">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                <div class="input-group input-group-sm">
                    <button class="btn btn-success">Search</button>
                    <input type="text" name='search' class="form-control shadow-none"
                        placeholder="Search any category here" autocomplete="off" autofocus>
                    <input type="hidden" name="entries" value="<?php echo $itemsPerPage ?>">
                </div>
            </form>
        </div>
        <div class="col-auto">
            <button class="btn btn-sm btn-primary">Add Category</button>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-bg-success">
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    foreach ($result as $category) {
                    ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $category['category_name'] ?></td>
                        <td class='text-nowrap text-end'>
                            <button class='btn btn-sm btn-warning d-inline-flex align-items-center gap-1'
                                data-id="<?php echo $category['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button class='btn btn-sm btn-danger d-inline-flex align-items-center gap-1'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-archive" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg>
                                <span>Delete</span>
                            </button>
                        </td>
                    </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                    <?php
                    if (count($result) == 0) {
                        echo "<tr>";
                        echo "<td colspan='3' class='text-center'>No results found</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <div class="row justify-content-between mb-3 gy-3">
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2">
                    <span>Show</span>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                        <input type="hidden" name="search" value="<?php echo $search ?>">
                        <select class="form-select form-select-sm shadow-none" name="entries"
                            onchange="this.form.submit()">
                            <option <?php if ($itemsPerPage == 5) echo 'selected'; ?> value="5">5</option>
                            <option <?php if ($itemsPerPage == 10) echo 'selected'; ?> value="10">10</option>
                            <option <?php if ($itemsPerPage == 15) echo 'selected'; ?> value="15">15</option>
                            <option <?php if ($itemsPerPage == 20) echo 'selected'; ?> value="20">20</option>
                        </select>
                    </form>
                    <span>Entries</span>
                </div>
            </div>
            <div class="col-auto">
                <ul class="pagination">
                    <?php
                    if ($totalPages > 1) {

                        if ($currentPage > 1) {
                            $previousPage = $currentPage - 1;
                            echo "<li class='page-item'><a class='page-link text-center' href='?search=$search&page=$previousPage&entries=$itemsPerPage'>Previous</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link text-center disabled'>Previous</a></li>";
                        }

                        echo "<li class='page-item'><span class='page-link text-center'>$currentPage of $totalPages</span></li>";

                        if ($currentPage < $totalPages) {
                            $nextPage = $currentPage + 1;
                            echo "<li class='page-item'><a class='page-link text-center' href='?search=$search&page=$nextPage&entries=$itemsPerPage'>Next</a></li>";
                        } else {
                            echo " <li class='page-item'><a class='page-link text-center disabled'>Next</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>