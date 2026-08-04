<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

    <div class="mb-4">
        <h2>Administrator Dashboard</h2>
        <p>Welcome,
            <strong><?php echo $_SESSION['username']; ?></strong>
        </p>
    </div>

    <div class="row">

        <!-- Manage Exams -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Manage Exams</h4>

                    <p>Create, view, edit and delete examinations.</p>

                    <a href="view_exams.php" class="btn btn-warning">
                        Open
                    </a>

                </div>
            </div>
        </div>

        <!-- Student Registrations -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Exam Registrations</h4>

                    <p>View and manage student exam registrations.</p>

                    <a href="view_registrations.php" class="btn btn-primary">
                        Open
                    </a>

                </div>
            </div>
        </div>

        <!-- Registered Students -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Students</h4>

                    <p>View all registered students.</p>

                    <a href="view_students.php" class="btn btn-success">
                        Open
                    </a>

                </div>
            </div>
        </div>

        <!-- Courses -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Courses</h4>

                    <p>View and manage courses.</p>

                    <a href="view_courses.php" class="btn btn-info">
                        Open
                    </a>

                </div>
            </div>
        </div>

        <!-- Departments -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Departments</h4>

                    <p>View all departments.</p>

                    <a href="view_departments.php" class="btn btn-secondary">
                        Open
                    </a>

                </div>
            </div>
        </div>

        <!-- Logout -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Logout</h4>

                    <p>Sign out of the administrator account.</p>

                    <a href="admin_logout.php" class="btn btn-danger">
                        Logout
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>