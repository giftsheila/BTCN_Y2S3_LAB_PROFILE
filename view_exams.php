<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$sql = "SELECT exams.*, courses.course_name
        FROM exams
        INNER JOIN courses ON exams.course_id = courses.course_id
        ORDER BY exam_date ASC";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Exams</h2>

        <a href="create_exam.php" class="btn btn-success">
            + Create New Exam
        </a>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Exam Name</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td><?php echo $row['exam_id']; ?></td>

                        <td><?php echo $row['exam_name']; ?></td>

                        <td><?php echo $row['course_name']; ?></td>

                        <td><?php echo $row['exam_date']; ?></td>

                        <td><?php echo $row['exam_time']; ?></td>

                        <td><?php echo $row['venue']; ?></td>

                        <td>

                            <a href="edit_exam.php?id=<?php echo $row['exam_id']; ?>"
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>

                            <a href="delete_exam.php?id=<?php echo $row['exam_id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this exam?');">
                               Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>