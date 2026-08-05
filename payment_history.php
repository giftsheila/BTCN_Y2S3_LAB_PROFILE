<?php
session_start();

include 'config/db_connect.php';

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

$reg_no = $_SESSION['reg_no'];

$query = mysqli_query($conn,"
SELECT *
FROM payments
WHERE reg_no='$reg_no'
ORDER BY payment_id DESC
");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>My Payment History</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                <?php while($row=mysqli_fetch_assoc($query)){ ?>

                    <tr>

                        <td><?php echo $row['payment_id']; ?></td>

                        <td>KES <?php echo $row['amount']; ?></td>

                        <td><?php echo strtoupper($row['payment_method']); ?></td>

                        <td>

                            <?php

                            if($row['payment_status']=="verified"){

                                echo "<span class='badge bg-success'>Verified</span>";

                            }elseif($row['payment_status']=="pending"){

                                echo "<span class='badge bg-warning'>Pending</span>";

                            }else{

                                echo "<span class='badge bg-danger'>Rejected</span>";

                            }

                            ?>

                        </td>

                        <td><?php echo $row['payment_date']; ?></td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>