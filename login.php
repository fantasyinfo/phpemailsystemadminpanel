<?php include 'header.php'; ?>
<h1>
    Login
</h1>

<div class="container">
    <div class="row d-flex my-5 shadow-5 justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="container ">
                <div class="row  my-5">
                    <a href="register.php" class="alert alert-info">Don't Have An Account Register Here</a>
                </div>
            </div>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">UserName / EmailId</label>
                    <input type="text" class="form-control" id="username" name="username">
                    <div id="usernameerror" class="alert alert-danger msg">
                        UserName or Email Id Does Not Exists. Please Enter Valid UserName or Email Id.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <div id="passMsg" class="alert alert-danger msg">
                        PassWord Did Not Matched.
                    </div>
                    <div id="passFill" class="alert alert-danger msg">
                        Please Enter a Password.
                    </div>
                    <div id="passMsg" class="alert alert-danger msg">
                        PassWord Did Not Matched or Email Id Did Not Verify.
                    </div>
                </div>
                <input type="hidden" name="login" value="login">
                <button type="submit" name="submit" id="log_submit" class="btn btn-primary">Login</button>
            </form>
            <div id="submitMsg" class="alert alert-success msg">
                You Have Successfully Login;
            </div>

        </div>
    </div>
</div>
<?php include 'footer.php'; ?>