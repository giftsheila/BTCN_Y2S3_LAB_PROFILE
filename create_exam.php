<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Fetch courses
$courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name ASC");
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Create New Exam</h3>
        </div>

        <div class="card-body">

            <form action="create_exam_process.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Exam Name</label>
                    <input type="text" name="exam_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course</label>

                    <select name="course_id" class="form-select" required>

                        <option value="">Select Course</option>

                        <?php while($course = mysqli_fetch_assoc($courses)){ ?>

                            <option value="<?php echo $course['course_id']; ?>">
                                <?php echo $course['course_name']; ?>
                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label">Exam Date</label>
                    <input type="date" name="exam_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Exam Time</label>
                    <input type="time" name="exam_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Venue</label>
                    <input type="text" name="venue" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Create Exam
                </button>

            </form>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>