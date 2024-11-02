<?php
   include_once 'user.php';
   $u = new User("teste_02","localhost:3306","root","");
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="icon" href="assets/imgs/autoponto-icon.jpg">
    <title>Login</title>
</head>

<body>
<?php
          
?>
    <div class="content-area">
        <div class="card-login">
            <div class="input-group">
            <?php
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                
                if (!empty($dados['btnLogin'])) {
                    #var_dump($dados);

                    if ($res = $u->login($dados['user'], $dados['senha'])) {
                        #var_dump($res);
                        header("location:home.php");
                    }
                    else {
                        echo"<p style='color: red;'><img src='assets/imgs/ic_warning.png' width='32' height='31'><sup><b>Usuário ou senha inválida</b></sup></p>";
                    }
                }
            ?>

                <form action="" method="post" class="gap-10">
                    <div>
                        <img src="assets/imgs/autoponto-icon.jpg" width="162" height="32">
                    </div>
                    <h4 id="card-txt">
                        <b>Projecto de teste</b>
                    </h4>
                    <div class="mb-3">
                        <input type="text" name="user" placeholder="Insira seu usuário" class="form-control">
                    </div>
                    <input type="password" name="senha" placeholder="Insira sua senha" class="form-control"><br>
                    <input type="submit" value="Login" class="btn btn-primary" name="btnLogin">
                    <br>
                    <p><a href="signup.html">criar conta</a></p>
                </form>

            </div>
        </div>

    </div>
</body>

</html>