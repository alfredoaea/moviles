<!– PARA EJEMPLO DASC — >
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
    <body>
        <script src="https://use.typekit.net/ayg4pcz.js"></script>
        <script>try {
                Typekit.load({async: true});
            } catch (e) {
            }</script>
        <center>
        <div class="container">
            <h1 class="welcome text-center">Welcome to <br> Ice Code</h1>
            <div class="card card-container">
                <h2 class='login_title text-center'>Login</h2>
                <hr>

                <form class="form-signin" action="login_verificar.php" method="POST">
                    <span id="reauth-email" class="reauth-email"></span>
                    <p class="input_title">Nombre de usuario</p>
                    <input type="text" id="usuario_nombre" name="user" class="login_box" placeholder="Nombre de Usuario" required autofocus>
                    <p class="input_title">Password</p>
                    <input type="password" id="usuario_password" name="password" class="login_box" placeholder="******" required>
                    <div id="remember" class="checkbox">
                        <label>
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary" type="submit">Login</button>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
</center>
    
    </body>
</html>