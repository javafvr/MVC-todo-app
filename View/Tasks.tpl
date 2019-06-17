<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-dark rounded shadow-sm">
    <div class="lh-100">
      <h1 class="mb-0 text-white lh-100">Tasks</h1>
      <small>Dolganov Dmitrii 2019</small>
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Task list</h6>
    <?php foreach ($Tasks as $key => $Task):?>
      <div class="media <?php echo $Task['completed']? 'text-black-50':''; ?> pt-3">
        <svg class="bd-placeholder-img mr-2 rounded" width="2" height="42" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="<?php echo $Task['completed']? '#dee2e6':'#149c1f'; ?>" width="100%" height="100%"></rect><text fill="#007bff" dy=".3em" x="50%" y="50%">32x32</text></svg>
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          <strong class="d-block text-gray-dark">@<?php echo $Task['username']?$Task['username'].' ('.$Task['email'].')':'guest'?>
          <?php if($Task['completed']):?>
          <span class="badge badge-secondary">Completed</span>
          <?endif;?>
          </strong>
          <?=$Task['text']?>
          <?php if($authUser):?>
            <?php if($authUser['role']=='admin'):?>
              <a class="float-right" href="Tasks/edit/<?=$Task['id']?>">edit</a>
            <?php endif;?>
          <?php endif;?>
        </p>
      </div>
    <?php endforeach;?>
    <small class="d-block text-right mt-3">
      <span class="badge badge-secondary">Sort by:</span>
      <?php $sortDirection = $Sort['direction']=="ASC"?"&sortDirection=DESC":"&sortDirection=ASC";?>
      <a href="<?php echo @$_GET["page"]?'/?page='.$_GET["page"].'&sort=email'.$sortDirection:'/?sort=email'.$sortDirection?>">email</a>
      <a href="<?php echo @$_GET["page"]?'/?page='.$_GET["page"].'&sort=username'.$sortDirection:'/?sort=username'.$sortDirection?>">username</a>
      <a href="<?php echo @$_GET["page"]?'/?page='.$_GET["page"].'&sort=completed'.$sortDirection:'/?sort=completed'.$sortDirection?>">status</a>
    </small>
  </div>
  <?php echo $Pagination->getBlock();?>
</main>