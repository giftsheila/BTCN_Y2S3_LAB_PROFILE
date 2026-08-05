<?php
session_start();

if (!isset($_SESSION['reg_no'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';

$studentName = $_SESSION['first_name'] ?? $_SESSION['reg_no'];
?>

<div class="container mt-5">

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h2>Student Dashboard</h2>
                    <h5 class="text-muted">
                        Welcome, <?php echo htmlspecialchars($studentName); ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Available Exams -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Available Exams</h4>

                    <p>
                        View all available examinations and register.
                    </p>

                    <a href="available_exams.php" class="btn btn-primary">
                        View Exams
                    </a>

                </div>
            </div>
        </div>

        <!-- My Registrations -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>My Registrations</h4>

                    <p>
                        View your registered examinations.
                    </p>

                    <a href="my_registrations.php" class="btn btn-success">
                        My Registrations
                    </a>

                </div>
            </div>
        </div>

        <!-- Make Payment -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Exam Payment</h4>

                    <p>
                        Pay your examination fees using M-Pesa.
                    </p>

                    <a href="make_payment.php" class="btn btn-warning">
                        Make Payment
                    </a>

                </div>
            </div>
        </div>

        <!-- Payment History -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Payment History</h4>

                    <p>
                        View all your payment records.
                    </p>

                    <a href="payment_history.php" class="btn btn-info text-white">
                        View History
                    </a>

                </div>
            </div>
        </div>

        <!-- Generate Exam Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>Exam Card</h4>

                    <p>
                        Generate and print your examination card.
                    </p>

                    <a href="exam_card.php" class="btn btn-secondary">
                        Generate Card
                    </a>

                </div>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">

                    <h4>My Profile</h4>

                    <p>
                        View your personal information.
                    </p>

                    <a href="student_profile.php" class="btn btn-dark">
                        View Profile
                    </a>

                </div>
            </div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-12 text-center">

            <a href="logout.php" class="btn btn-danger btn-lg">
                Logout
            </a>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>