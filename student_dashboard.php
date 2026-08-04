<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container py-5">
    <div class="container py-5">

    <div class="card shadow mb-4">
        <div class="card-body text-center">
            <h2>Welcome, <?php echo $_SESSION['first_name']; ?>!</h2>
            <p class="lead">
                Welcome to the Online Exam Registration System.
            </p>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Register for Exams</h4>
                    <p>View available exams and register.</p>

                    <a href="available_exams.php" class="btn btn-primary">
                        Register
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>My Registrations</h4>
                    <p>View all your registered exams.</p>

                    <a href="my_registrations.php" class="btn btn-success">
                        View
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h4>Logout</h4>
                    <p>Sign out of your account.</p>

                    <a href="logout.php" class="btn btn-danger">
                        Logout
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
</div>

<?php include 'includes/footer.php'; ?>