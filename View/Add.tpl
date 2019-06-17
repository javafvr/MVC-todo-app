<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-dark rounded shadow-sm">
    <div class="lh-100">
      
      <h1 class="mb-0 text-white lh-100">Add task</h1>
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
        <form class="form-signin" method="POST" action="/Tasks/add">
          <input name="id" type="hidden" class="form-check-input" id="taskId" value="<?=$Task[0]['id']?>">
          <div class="form-label-group mb-3">
            <label for="taskUsername">Username</label>
            <input name="username" type="text" id="taskUsername" class="form-control" placeholder="Enter your username" autofocus="">
          </div>
          <div class="form-label-group mb-3">
            <label for="taskEmail">Email</label>
            <input name="email" type="email" id="taskEmail" class="form-control" placeholder="Enter your email" required="true" autofocus="">
          </div>
          <div class="form-label-group mb-3">
            <label for="taskText">Text</label>
            <textarea name="text" type="text" id="taskText" class="form-control" placeholder="task text here" required="true" autofocus=""></textarea>
          </div>
          <button class="btn btn-primary btn-sm"  type="submit">Save</button>
          <a href="/" class="btn btn-secondary btn-sm" type="cancel">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</main>