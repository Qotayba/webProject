<nav class="navbar navbar-expand-sm px-lg-5 navbar-dark bg-dark fixed-top ">
    <div class="container-fluid  ">
        <a class="navbar-brand " href="index.php">Gallery Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav mx-auto  justify-content-between">
                <li class="nav-item">
                    <a class="nav-link" href="shirts.php">Shirts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shoes.php">Shoes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="jeans.php">Jeans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="suits.php">Suits </a>
                </li>
            </ul>
            <ul class="navbar-nav justify-content-between">
                <li class="nav-item">
                    <?php
                    if(isset($_SESSION['login'])){
                        ?>
                    <a class="nav-link" href="myOrder.php">My Order </a> </li>
                <li class="nav-item">
                <a class="nav-link" href=" cart.php">cart </a>

                </li>
                    <li class="nav-item">
                        <form action="index.php" method="post">
                            <button type="submit" name="logout" id="logout" class="btn btn-primary">Log Out</button>
                        </form>

                    <?php }
                    else{
                        ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Log IN</button>
                        <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal  m-lg-5" id="myModal">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Sign in here</h3>
            <form style="width: 100%" action="index.php" method="post">
                <div class="inputBox"> <input id="uname" type="text" name="Username" placeholder="Username">
                    <input id="pass" type="password" name="Password" placeholder="Password">
                </div>
                <input type="submit" name="Signin" id="Signin" value="Login">
            </form> <a style="margin-bottom: 5px" id="lgn" data-bs-toggle="modal" data-bs-target="#myModal2">Forget Password<br> </a>
            <div class="text-center">
                <p style="color: #dc3545;">
                    Don't have account?
                    <a id="lgn1" data-bs-toggle="modal" data-bs-target="#myModal1">
                        Sign Up
                    </a>
                </p>

            </div>
        </div>
    </div>
</div>
<div class="modal  m-lg-5" id="myModal1">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Sign Up here</h3>
            <form style="width: 100%" action="signup.php" method="post">
                <div class="inputBox">
                    <input id="uname1" type="text" name="Username1" required placeholder="Username">
                    <input id="pass1" type="password" name="Password1" required placeholder="Password">
                    <input id="email1" type="email" name="email1" required placeholder="Email">
                </div>
                <input type="submit" name="SignUp" value="SignUp">
            </form>
        </div>
    </div>
</div>
<div class="modal  m-lg-5" id="myModal2">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Forgot Password</h3>
            <h8>Enter your Username and your Email</h8>
            <form style="width: 100%" action="forgotPasswprdCheck.php" method="post">
                <div class="inputBox">
                    <input id="uname2" type="text" name="Username2" required placeholder="Username">
                    <input id="email2" type="email" name="email2" required placeholder="Email">
                </div>
                <input type="submit" name="send" value="Send a Verification code">
            </form>
        </div>
    </div>
</div>
<div class="modal  m-lg-5" id="myModal3">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Forgot Password</h3>
            <h8>Enter the Verification code</h8>
            <form style="width: 100%" action="checkVercode.php" method="post">
                <div class="inputBox">
                    <input style="border-radius: 25px; border-color: #dc3545; text-align: center" id="code" type="number" name="code">
                </div>
                <input type="submit" name="check" value="Submit">
            </form>
        </div>
    </div>
</div>
<div class="modal  m-lg-5" id="myModal4">
    <div class="modal-dialog">
        <div style="" class=" loginBox modal-content">
            <div class="text-lg-end" style="display: flex;justify-content: right">
                <button  type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <img class="user" src="imgs/login.png" height="100px" width="100px">

            <h3>Forgot Password</h3>
            <h8>Enter the new Password</h8>
            <form style="width: 100%" action="resetPassword.php" method="post">
                <div class="inputBox">
                    <input id="pass1" type="password" name="pass1" required placeholder="Password">
                </div>
                <input type="submit" name="send" value="Reset Password">
            </form>
        </div>
    </div>
</div>