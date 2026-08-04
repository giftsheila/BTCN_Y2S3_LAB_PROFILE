<?php
include 'config/db_connect.php';
// Fetch Departments
$departments = mysqli_query($conn, "SELECT * FROM departments ORDER BY department_name");

// Fetch Courses
$courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name");
?>

<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow-lg border-0">

                <div class="card-header bg-primary text-white text-center py-4">

                    <h2 class="mb-0">Student Registration</h2>

                    <p class="mb-0">
                        Complete the form below to create your student account.
                    </p>

                </div>

                <div class="card-body p-4">

                    <form action="register_process.php" method="POST">

                        <h4 class="text-primary mb-3">
                            Personal Information
                        </h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Registration Number
                                </label>

                                <input
                                    type="text"
                                    name="reg_no"
                                    class="form-control"
                                    placeholder="e.g. BTIT/1234/2024"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Gender
                                </label>

                                <select
                                    name="gender"
                                    class="form-select"
                                    required>

                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    required>

                            </div>

                        </div>

                        <hr>

                        <h4 class="text-primary mb-3">
                            Academic Information
                        </h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Department
                                </label>

                                <select
                                    name="department_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Department
                                    </option>

                                    <?php while($department = mysqli_fetch_assoc($departments)) { ?>

                                        <option value="<?php echo $department['department_id']; ?>">

                                            <?php echo $department['department_name']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Course
                                </label>

                                <select
                                    name="course_id"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Course
                                    </option>

                                    <?php while($course = mysqli_fetch_assoc($courses)) { ?>

                                        <option value="<?php echo $course['course_id']; ?>">

                                            <?php echo $course['course_name']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Year of Study
                                </label>

                                <select
                                    name="year_of_study"
                                    class="form-select"
                                    required>

                                    <option value="">Select Year</option>
                                    <option value="1">Year 1</option>
                                    <option value="2">Year 2</option>
                                    <option value="3">Year 3</option>
                                    <option value="4">Year 4</option>

                                </select>

                            </div>

                        </div>

                        <hr>

                        <h4 class="text-primary mb-3">
                            Account Security
                        </h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">

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

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Confirm Password
                                </label>

                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    class="form-control"
                                    required>

                            </div>

                        </div>

                        <div class="form-check mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                onclick="togglePassword()"
                                id="showPassword">

                            <label
                                class="form-check-label"
                                for="showPassword">

                                Show Password

                            </label>

                        </div>

                        <div class="text-center">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg px-5">

                                Register

                            </button>

                        </div>

                    </form>

                    <div class="text-center mt-4">

                        Already have an account?

                        <a href="login.php">

                            Login Here

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

    let confirm=document.getElementById("confirm_password");

    if(password.type==="password"){

        password.type="text";
        confirm.type="text";

    }else{

        password.type="password";
        confirm.type="password";

    }

}

</script>

<?php
include 'includes/footer.php';
?>