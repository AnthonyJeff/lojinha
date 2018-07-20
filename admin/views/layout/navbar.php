<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img height="30" height="auto" src="https://domains.aplus.net/assets/images/online-store.png" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=$GLOBALS['index']; ?>/painel-de-controle/">Painél de Controle <span class="sr-only">(current)</span></a>
      </li>
      <!--
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Gerenciar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?=$GLOBALS['index']; ?>/produtos/gerenciar"><i class="fa fa-basket"></i> Produtos</a>
          <a class="dropdown-item" href="<?=$GLOBALS['index']; ?>/categorias/gerenciar">Categorias</a>
          <a class="dropdown-item" href="<?=$GLOBALS['index']; ?>/vendas/gerenciar">Vendas</a>
        </div>
      </li>


       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="https://static1.squarespace.com/static/557d1981e4b097936a86b629/t/558cf487e4b05d368538793a/1435301000191/" height="30" width="30" style="border-radius: 50%;"> <?=$_SESSION['user']['user_name']." ".$_SESSION['user']['user_lastname'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?=$GLOBALS['index']; ?>/controllers/access.php?method=out">Sair</a>
        </div>
      </li>

      </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="bsuca" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</nav>