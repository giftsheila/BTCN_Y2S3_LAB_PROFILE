<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$reg_no = $_SESSION['reg_no'];

$sql = "SELECT
            exam_registration.registration_status,
            exams.exam_name,
            exams.exam_date,
            exams.exam_time,
            exams.venue,
            courses.course_name
        FROM exam_registration
        INNER JOIN exams
            ON exam_registration.exam_id = exams.exam_id
        INNER JOIN courses
            ON exams.course_id = courses.course_id
        WHERE exam_registration.reg_no = '$reg_no'
        ORDER BY exams.exam_date ASC";

$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <h2 class="mb-4">My Exam Registrations</h2>

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
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                <?php
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tr>

                        <td><?php echo $row['exam_name']; ?></td>

                        <td><?php echo $row['course_name']; ?></td>

                        <td><?php echo $row['exam_date']; ?></td>

                        <td><?php echo $row['exam_time']; ?></td>

                        <td><?php echo $row['venue']; ?></td>

                        <td>
                            <?php echo $row['registration_status']; ?>
                        </td>

                    </tr>

                <?php
                    }

                } else {
                ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            You have not registered for any exams yet.
                        </td>
                    </tr>

                <?php
                }
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>