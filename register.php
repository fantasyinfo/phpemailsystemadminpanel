<?php include 'header.php'; ?>
<h1>
    Register
</h1>

<div class="container">
    <div class="row d-flex my-5 shadow-5 justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="container ">
                <div class="row  my-5">

                    <a href=" login.php" class="alert alert-info">Already Have An Account Login Here</a>
                </div>
            </div>
            <form id="regForm">
                <div class="mb-3">
                    <label for="username" class="form-label">UserName</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                    <div id="usernameerror" class="alert alert-danger msg">
                        UserName Already Exists. Please Enter New UserName.
                    </div>

                </div>
                <div class="mb-3">
                    <label for="email_id" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email_id" name="email_id" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <div id="emailError" class="alert alert-danger msg">
                        Please Enter a Valid Email Id OR This Email is Already Exits.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <input type="hidden" name="register" value="register">
                <button type="submit" name="submit" id="reg_submit" class="btn btn-primary">Register</button>
            </form>
            <form id="otpForm">
                <div class="mb-3">
                    <label for=otp" class="form-label">OTP</label>
                    <input type="text" class="form-control" id="otp" name="otp">
                </div>
                <button type="submit" name="submit" id="otp_submit" class="btn btn-primary">Enter OTP</button>
            </form>
            <div id="submitMsg" class="alert alert-success msg">
                We have sent you an verification link on your given email, click the link to verify then login.
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>