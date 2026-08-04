<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-lg border-0">

                <div class="card-header bg-dark text-white text-center py-4">
                    <h2>Administrator Login</h2>
                    <p class="mb-0">
                        Login to manage the Online Exam Registration System
                    </p>
                </div>

                <div class="card-body p-4">

                    <form action="admin_login_process.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Username</label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Enter username"
                                required>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">Password</label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter password"
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
                                class="btn btn-dark">

                                Login

                            </button>

                        </div>

                    </form>

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