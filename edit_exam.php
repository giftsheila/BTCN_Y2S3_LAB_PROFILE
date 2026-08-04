<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: view_exams.php");
    exit();
}

$exam_id = $_GET['id'];

// Get exam details
$exam = mysqli_query($conn, "SELECT * FROM exams WHERE exam_id='$exam_id'");
$exam = mysqli_fetch_assoc($exam);

// Get courses
$courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name ASC");
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3>Edit Exam</h3>
        </div>

        <div class="card-body">

            <form action="edit_exam_process.php" method="POST">

                <input type="hidden" name="exam_id" value="<?php echo $exam['exam_id']; ?>">

                <div class="mb-3">
                    <label>Exam Name</label>
                    <input type="text"
                           name="exam_name"
                           class="form-control"
                           value="<?php echo $exam['exam_name']; ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label>Course</label>

                    <select name="course_id" class="form-select" required>

                        <?php while($course = mysqli_fetch_assoc($courses)){ ?>

                            <option value="<?php echo $course['course_id']; ?>"
                            <?php if($course['course_id']==$exam['course_id']) echo "selected"; ?>>

                                <?php echo $course['course_name']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">
                    <label>Exam Date</label>
                    <input type="date"
                           name="exam_date"
                           class="form-control"
                           value="<?php echo $exam['exam_date']; ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label>Exam Time</label>
                    <input type="time"
                           name="exam_time"
                           class="form-control"
                           value="<?php echo $exam['exam_time']; ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label>Venue</label>
                    <input type="text"
                           name="venue"
                           class="form-control"
                           value="<?php echo $exam['venue']; ?>"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Exam
                </button>

                <a href="view_exams.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>