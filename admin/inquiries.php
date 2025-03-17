<?php include 'header.php';
include '../db/config.php';
include '../functions/patients.php';

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    $response = updateInquiryStatus($conn, $id, $status);
    echo "<script>alert('$response'); window.location.href='inquiries.php';</script>";
    exit();
}
?>

<style>
    input[name="id"] {
        width: 35px;
        padding: 5px;
        text-align: center;
        border: 1px solid #ccc;
        background-color: #f8f8f8;
        color: #333;
        font-weight: bold;
        cursor: not-allowed;
    }

    .message {
        font-size: 13px;
        width: 400px;
    }

    td {
        font-size: 14px;
    }

    select[name="status"] {
        width: 110px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #fff;
        color: #333;
        font-weight: bold;
        cursor: pointer;
    }

    select[name="status"]:hover {
        /* background-color:#222F66 ; */
        color: black;
    }

    select[name="status"] option[selected] {
        font-weight: bold;
        background-color: green;
    }

    select[name="status"]:focus {
        outline: none;
        border-color: #DEAA4E;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>

<div class="dashboard-content">
    <div class="card-body">
        <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Date</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody class="index">
                            <tr class="align-middle">
                            <?php
                                if (!isset($_GET['page'])) {
                                    $end = 1 * 25;
                                    $start = $end - 25;
                                } else {
                                    $end = $_GET['page'] * 25;
                                    $start = $end - 25;
                                }
                                $inquiries = getAllInquiries($conn, $start, $end);
                                foreach ($inquiries as $inquiry):
                            ?>

                                <form action="" method="post" onsubmit="return confirmSubmit(this);">
                            
                            <tr>
                                <td><input type="text" name="id" value="<?= $inquiry['id'] ?>" placeholder="<?= $inquiry['id'] ?>" readonly></td>
                                <td><?= $inquiry['name'] ?></td>
                                <td><?= $inquiry['number'] ?></td>
                                <td><?= $inquiry['email'] ?></td>
                                <td>
                                    <select class="form-select" name="status" aria-label="Default select example" onchange="confirmChange(this)">
                                        <option selected><?= $inquiry['status'] ?></option>
                                        <option value="Pending">Pending</option>
                                        <option value="Done">Done</option>
                                        <option value="Not Response">Not Response</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </td>
                                <td class="message"><?= $inquiry['message'] ?></td>
                                <td><?= $inquiry['date'] ?></td>
                            </tr>
                            </form>

                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    $total_pages = ceil(getInquiriesCount($conn) / 25);
                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $prev_page = max(1, $current_page - 1);
                    $next_page = min($total_pages, $current_page + 1);
                    ?>

                    <!-- Previous Button -->
                    <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="inquiries.php?page=<?= $prev_page ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                            <a class="page-link" href="inquiries.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="inquiries.php?page=<?= $next_page ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php mysqli_close($conn);?>

<script>
    function confirmChange(selectElement) {
        let selectedStatus = selectElement.value;
        let confirmation = confirm("Are you sure you want to change the status to '" + selectedStatus + "'?");

        if (confirmation) {
            selectElement.form.submit();
        } else {
            selectElement.value = "<?= $inquiry['status'] ?>";
        }
    }
</script>