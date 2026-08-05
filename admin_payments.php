<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$query = mysqli_query($conn, "
SELECT *
FROM payments
ORDER BY payment_id DESC
");
?>

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3>Manage Student Payments</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Registration No.</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row=mysqli_fetch_assoc($query)){ ?>

                    <tr>

                        <td><?php echo $row['payment_id']; ?></td>

                        <td><?php echo $row['reg_no']; ?></td>

                        <td>KES <?php echo number_format($row['amount'],2); ?></td>

                        <td><?php echo strtoupper($row['payment_method']); ?></td>

                        <td>

                        <?php

                        if($row['payment_status']=="verified"){

                            echo "<span class='badge bg-success'>Verified</span>";

                        }elseif($row['payment_status']=="pending"){

                            echo "<span class='badge bg-warning text-dark'>Pending</span>";

                        }else{

                            echo "<span class='badge bg-danger'>Rejected</span>";

                        }

                        ?>

                        </td>

                        <td><?php echo $row['payment_date']; ?></td>

                        <td>

                        <?php if($row['payment_status']=="pending"){ ?>

                            <a href="verify_payment.php?id=<?php echo $row['payment_id']; ?>"
                               class="btn btn-success btn-sm">
                                Verify
                            </a>

                            <a href="reject_payment.php?id=<?php echo $row['payment_id']; ?>"
                               class="btn btn-danger btn-sm">
                                Reject
                            </a>

                        <?php } else { ?>

                            <span class="text-muted">Completed</span>

                        <?php } ?>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>