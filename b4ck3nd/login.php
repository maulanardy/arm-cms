<?php
include("../bootstrap.php");


include("header.php");
?>

<style type="text/css">
    body {
    background: #000;
}

.tab-content {
    background: #000;
}
</style>

<body class="login">
    <div class="container">
        <div class="text-center">
            <img src="assets/img/logo.png" alt="Metis Logo">
        </div>
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <form method="post" class="form-signin">
                    <?php
                    if(Io::param('login')){
                        $ARM->admin->login();
                    }

                    if($ARM->admin->isLoged()){
                        header('Location: '.BASE.BACKEND);
                    }

                    echo $ARM->admin->error;
                    ?>
                    <p class="text-muted text-center">
                        Enter your username and password
                    </p>
                    <input type="text" name="name" placeholder="Username" class="form-control">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <input class="btn btn-lg btn-danger btn-block" name="login" type="submit" value="Sign in">
                </form>
            </div>
        </div>
    </div><!-- /container -->
</body>