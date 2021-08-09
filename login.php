<?php
    include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime ChatApp</header>
            <form action="#">
                <div class="error-text"></div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter email address" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="link">
                Not yet signed up?<a href="index.php"> Signup now</a>
            </div>
        </section>
    </div>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/login.js"></script>
</body>

</html>