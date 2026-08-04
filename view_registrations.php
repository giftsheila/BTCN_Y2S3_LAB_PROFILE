<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$sql = "SELECT
            exam_registration.registration_id,
            exam_registration.reg_no,
            exam_registration.registration_status,
            exams.exam_name,
            exams.exam_date,
            exams.exam_time,
            courses.course_name
        FROM exam_registration
        INNER JOIN exams
            ON exam_registration.exam_id = exams.exam_id
        INNER JOIN courses
            ON exams.course_id = courses.course_id
        ORDER BY exams.exam_date ASC";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <h2 class="mb-4">Student Exam Registrations</h2>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Registration Number</th>
                        <th>Exam</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php
                if (mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_assoc($result)){
                ?>

                    <tr>

                        <td><?php echo $row['registration_id']; ?></td>
                        <td><?php echo $row['reg_no']; ?></td>
                        <td><?php echo $row['exam_name']; ?></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['exam_date']; ?></td>
                        <td><?php echo $row['exam_time']; ?></td>
                        <td><?php echo $row['registration_status']; ?></td>

                        <td>

                            <a href="approve_registration.php?id=<?php echo $row['registration_id']; ?>"
                               class="btn btn-success btn-sm">
                                Approve
                            </a>

                            <a href="reject_registration.php?id=<?php echo $row['registration_id']; ?>"
                               class="btn btn-danger btn-sm">
                                Reject
                            </a>

                        </td>

                    </tr>

                <?php
                    }

                } else {
                ?>

                    <tr>
                        <td colspan="8" class="text-center">
                            No registrations found.
                        </td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>