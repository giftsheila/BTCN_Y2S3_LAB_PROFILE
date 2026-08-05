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

$sql = "SELECT s.*, c.course_name, d.department_name
        FROM students s
        LEFT JOIN courses c ON s.course_id = c.course_id
        LEFT JOIN departments d ON s.department_id = d.department_id
        WHERE s.reg_no='$reg_no'";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Student record not found.");
}

$student = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>My Profile</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="35%">Registration Number</th>
                    <td><?php echo $student['reg_no']; ?></td>
                </tr>

                <tr>
                    <th>First Name</th>
                    <td><?php echo $student['first_name']; ?></td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td><?php echo $student['last_name']; ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?php echo $student['email']; ?></td>
                </tr>

                <tr>
                    <th>Phone Number</th>
                    <td><?php echo $student['phone']; ?></td>
                </tr>

                <tr>
                    <th>Gender</th>
                    <td><?php echo $student['gender']; ?></td>
                </tr>

                <tr>
                    <th>Course</th>
                    <td><?php echo $student['course_name']; ?></td>
                </tr>

                <tr>
                    <th>Department</th>
                    <td><?php echo $student['department_name']; ?></td>
                </tr>

                <tr>
                    <th>Year of Study</th>
                    <td><?php echo $student['year_of_study']; ?></td>
                </tr>

                <tr>
                    <th>Account Created</th>
                    <td><?php echo $student['created_at']; ?></td>
                </tr>

            </table>

            <div class="text-center">

                <a href="student_dashboard.php" class="btn btn-secondary">
                    Back to Dashboard
                </a>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>