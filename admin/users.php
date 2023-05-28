<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/sidebar.php' ?>

<?php include_once 'includes/content-header.php' ?>

<?php 
    $db = new DbConn();
    $pdo = $db->connect();
    
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT COUNT(id) as totalItems FROM users WHERE fullname LIKE :fullname";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':fullname', '%' . $search . '%');
    $stmt->execute();
    $result = $stmt->fetch();

    $totalItems = $result['totalItems'];
    $itemsPerPage = isset($_GET['entries']) ? $_GET['entries'] : 5;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    $sql = "SELECT * FROM users WHERE fullname LIKE :fullname ORDER BY id LIMIT $offset, $itemsPerPage";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':fullname', '%' . $search . '%');
    $stmt->execute();
    $result = $stmt->fetchAll();
?>



<div class="content mt-3">
    <div class="row m-0 justify-content-end gx-4 gx-md-3 gy-2">
        <div class="col-md-6">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                <div class="input-group input-group-sm">
                    <button class="btn btn-success">Search</button>
                    <input type="text" name='search' class="form-control shadow-none" placeholder="Search fullname here"
                        autocomplete="off" autofocus>
                    <input type="hidden" name="entries" value="<?php echo $itemsPerPage ?>">
                </div>
            </form>
        </div>
        <div class="col-auto">
            <button class="btn btn-sm btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#add-user-modal">Add
                User</button>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-bg-success">
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Role</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $counter = 1;
                        foreach ($result as $user) {
                    ?>

                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['fullname'] ?></td>
                        <td><?php echo $user['role'] ?></td>
                        <td class='text-nowrap text-end'>
                            <button
                                class='btn btn-sm btn-success d-inline-flex align-items-center gap-1 btn-change-pass'
                                data-id="<?php echo $user['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-shield-lock" viewBox="0 0 16 16">
                                    <path
                                        d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                    <path
                                        d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                                </svg>
                                <span>Change Password</span>
                            </button>
                            <button class='btn btn-sm btn-warning d-inline-flex align-items-center gap-1 btn-edit'
                                data-id="<?php echo $user['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button class='btn btn-sm btn-danger d-inline-flex align-items-center gap-1 btn-delete'
                                data-id="<?php echo $user['id'] ?>">
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
                </tbody>
            </table>
        </div>

        <div class="row justify-content-between mb-3 gy-3">
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2">
                    <span>Show</span>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                        <input type="hidden" name="search" value="<?php echo $search ?>">
                        <select name="entries" class="form-select form-select-sm shadow-none"
                            onchange="this.form.submit()">
                            <option <?php if($itemsPerPage == 5) echo 'selected' ?> value="5">5</option>
                            <option <?php if($itemsPerPage == 10) echo 'selected' ?> value="10">10</option>
                            <option <?php if($itemsPerPage == 15) echo 'selected' ?> value="15">15</option>
                            <option <?php if($itemsPerPage == 20) echo 'selected' ?> value="20">20</option>
                        </select>
                    </form>
                    <span>Entries</span>
                </div>
            </div>

            <div class="col-auto">
                <ul class="pagination">
                    <?php 

                    if($totalPages > 1){
                        
                        if($currentPage > 1){
                            $previousPage = $currentPage - 1;
                            echo "<li class='page-item'><a class='page-link text-center' href='?search=$search&page=$previousPage&entries=$itemsPerPage'>Previous</a></li>";
                        } else{
                            echo "<li class='page-item'><a class='page-link text-center disabled'>Previous</a></li>";
                        }

                        echo "<li class='page-item'><span class='page-link text-center'>$currentPage of $totalPages</span></li>";

                        if($currentPage < $totalPages){
                            $nextPage = $currentPage + 1;
                            echo "<li class='page-item'><a class='page-link text-center' href='?search=$search&page=$nextPage&entries=$itemsPerPage'>Next</a></li>";
                        }
                        else{
                            echo " <li class='page-item'><a class='page-link text-center disabled'>Next</a></li>";
                        }

                    }
                    
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/user-modal.php' ?>

<script src="../js/pages/users.js"></script>

<?php include_once 'includes/footer.php' ?>