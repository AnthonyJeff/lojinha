<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="https://domains.aplus.net/assets/images/online-store.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=$GLOBALS['index']; ?>/views/assets/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$GLOBALS['index']; ?>/views/assets/bootstrap/dist/css/sign.css" />

    <title>Entrar - Lojinha (Administração)</title>
  </head>
  <body class="text-center">
    <form class="form-signin" action="<?=$GLOBALS['index']; ?>/controllers/access.php?method=in" method="post">
      <img class="mb-4" src="../images/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Entre para continuar</h1>
      <label for="inputEmail" class="sr-only">Endereço de Email</label>
      <input type="email" name="user_email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" name="user_password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Lembrar-me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?=date('Y'); ?> - Lojinha</p>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?=$GLOBALS['index']; ?>/views/assets/bootstrap/dist/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>