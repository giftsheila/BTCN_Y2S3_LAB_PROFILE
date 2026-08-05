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

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">

                    <h3>M-Pesa Exam Payment</h3>

                </div>

                <div class="card-body">

                    <form action="mpesa/stkpush.php" method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Registration Number
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?php echo $_SESSION['reg_no']; ?>"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Safaricom Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                placeholder="2547XXXXXXXX"
                                required>

                            <small class="text-muted">
                                Example: 254712345678
                            </small>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Amount (KES)
                            </label>

                            <input
                                type="number"
                                name="amount"
                                class="form-control"
                                value="1000"
                                min="1"
                                required>

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-success btn-lg">

                                Pay with M-Pesa

                            </button>

                        </div>

                    </form>

                </div>

                <div class="card-footer text-center">

                    <small class="text-muted">
                        After clicking <strong>Pay with M-Pesa</strong>,
                        an STK Push will be sent to your phone.
                        Enter your M-Pesa PIN to complete payment.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>