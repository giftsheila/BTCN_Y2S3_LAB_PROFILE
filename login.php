<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-lg border-0">

                <div class="card-header bg-primary text-white text-center py-4">

                    <h2>Student Login</h2>

                    <p class="mb-0">
                        Sign in to access your student dashboard.
                    </p>

                </div>

                <div class="card-body p-4">

                    <form action="login_process.php" method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Registration Number
                            </label>

                            <input
                                type="text"
                                name="reg_no"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="form-check mb-3">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                onclick="togglePassword()">

                            <label class="form-check-label">

                                Show Password

                            </label>

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                Login

                            </button>

                        </div>

                    </form>

                    <div class="text-center mt-4">

                        Don't have an account?

                        <a href="register.php">

                            Register Here

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword(){

    let password=document.getElementById("password");

    if(password.type==="password"){

        password.type="text";

    }else{

        password.type="password";

    }

}

</script>

<?php include 'includes/footer.php'; ?>