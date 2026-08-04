<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$sql = "SELECT exams.*, courses.course_name
        FROM exams
        INNER JOIN courses
        ON exams.course_id = courses.course_id
        ORDER BY exam_date ASC";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <h2 class="mb-4">Available Exams</h2>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>Exam</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)){ ?>

                    <tr>

                        <td><?php echo $row['exam_name']; ?></td>

                        <td><?php echo $row['course_name']; ?></td>

                        <td><?php echo $row['exam_date']; ?></td>

                        <td><?php echo $row['exam_time']; ?></td>

                        <td><?php echo $row['venue']; ?></td>

                        <td>

                            <a href="register_exam.php?id=<?php echo $row['exam_id']; ?>"
                               class="btn btn-success btn-sm">
                                Register
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