<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'config/db_connect.php';
include 'includes/header.php';
include 'includes/navbar.php';

$adminName = $_SESSION['full_name'] ?? $_SESSION['username'] ?? 'Administrator';

/* ===============================
   Dashboard Statistics
================================= */

$totalStudents = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM students"))['total'];

$totalDepartments = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM departments"))['total'];

$totalCourses = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM courses"))['total'];

$totalExams = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM exam"))['total'];

$totalRegistrations = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM exam_registration"))['total'];

$totalPayments = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM payments"))['total'];
?>

<div class="container mt-4">

    <!-- Welcome -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h2>Administrator Dashboard</h2>
            <p class="text-muted">
                Welcome,
                <strong><?php echo htmlspecialchars($adminName); ?></strong>
            </p>
        </div>
    </div>
    <!-- Global Search -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <h5 class="mb-3">Global Search</h5>

        <form action="global_search.php" method="GET">

            <div class="input-group">

                <input
                    type="text"
                    class="form-control"
                    name="search"
                    placeholder="Search by Registration Number, Student Name or Email..."
                    required
                >

                <button type="submit" class="btn btn-primary">
                    🔍 Search
                </button>

            </div>

        </form>

        </div>
     </div>

    <!-- Statistics -->
    <div class="row">

        <div class="col-md-2 mb-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body text-center">
                    <h5>Students</h5>
                    <h2><?php echo $totalStudents; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body text-center">
                    <h5>Departments</h5>
                    <h2><?php echo $totalDepartments; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card bg-warning shadow">
                <div class="card-body text-center">
                    <h5>Courses</h5>
                    <h2><?php echo $totalCourses; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body text-center">
                    <h5>Exams</h5>
                    <h2><?php echo $totalExams; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card bg-secondary text-white shadow">
                <div class="card-body text-center">
                    <h5>Registrations</h5>
                    <h2><?php echo $totalRegistrations; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card bg-dark text-white shadow">
                <div class="card-body text-center">
                    <h5>Payments</h5>
                    <h2><?php echo $totalPayments; ?></h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Management Cards -->
    <div class="row mt-3">

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Students</h4>
                    <p>View all registered students.</p>
                    <a href="view_students.php" class="btn btn-primary">
                        View Students
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Departments</h4>
                    <p>Manage departments.</p>
                    <a href="manage_departments.php" class="btn btn-success">
                        Manage Departments
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Courses</h4>
                    <p>Manage courses.</p>
                    <a href="manage_courses.php" class="btn btn-warning">
                        Manage Courses
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Examinations</h4>
                    <p>Create and manage examinations.</p>
                    <a href="manage_exams.php" class="btn btn-info text-white">
                        Manage Exams
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Registrations</h4>
                    <p>View student registrations.</p>
                    <a href="view_registrations.php" class="btn btn-secondary">
                        View Registrations
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Payments</h4>
                    <p>Verify and manage payments.</p>
                    <a href="admin_payments.php" class="btn btn-dark">
                        Manage Payments
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Reports</h4>
                    <p>Generate and print reports.</p>
                    <a href="admin_reports.php" class="btn btn-primary">
                        View Reports
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100 border-danger">
                <div class="card-body text-center">
                    <h4>Logout</h4>
                    <p>Sign out of the administrator account.</p>
                    <a href="logout.php" class="btn btn-danger">
                        Logout
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>