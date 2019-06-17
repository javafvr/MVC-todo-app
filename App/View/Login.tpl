<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-dark rounded shadow-sm">
    <div class="lh-100">
      <h1 class="mb-0 text-white lh-100">Login</h1>
      <small>Dolganov Dmitrii 2019</small>
    </div>
  </div>
  <?if(!empty($Errors)):?>
  <?foreach($Errors as $value):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Ошибка!</strong> <?=$value?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?endforeach;?>
  <?endif;?>
  <div class="my-3 p-3 bg-white rounded shadow-sm ">
    <div class="row justify-content-center">
      <div class="col-12 col-md-5">
        <form class="form-signin" method="POST" action="login">
          <div class="form-label-group">
            <input name="login" type="login" id="inputLogin" class="form-control" placeholder="login" required="true" autofocus="">
            <label for="inputLogin">Login</label>
          </div>
          <div class="form-label-group">
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="true">
            <label for="inputPassword">Password</label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" name="login_submit" type="submit">Sign in</button>
          <small class="d-block text-right mt-3">
            <a href="register">Register</a>
          </small>
        </form>
      </div>
    </div>
  </div>
</main>