<div class="row">

  <?

  if ($_SESSION['error']) {
    echo "
<div class='alert alert-danger mb-5' role='alert'>
 <span style='font-size: 16px;' class='text-dark'><i class='fas fa-exclamation-triangle'></i> " . $_SESSION['error'] . " </span>
</div>";
    unset($_SESSION['error']);
  }


  if ($_SESSION['success']) {
    echo "
<div class='alert alert-success mb-5' role='alert'>
 <span style='font-size: 16px;' class='text-dark'><i class='fas fa-check-circle'></i> " . $_SESSION['success'] . " </span>
</div>";
    unset($_SESSION['success']);
  }

  if ($_SESSION['warning']) {
    echo "
<div class='alert alert-warning mb-5' role='alert'>
 <span style='font-size: 16px;' class='text-dark'><i class='fas fa-exclamation-triangle'></i> " . $_SESSION['warning'] . " </span>
</div>";
    unset($_SESSION['warning']);
  }


  if ($_SESSION['info']) {
    echo "
<div class='alert alert-info mb-5' role='alert'>
  <span style='font-size: 16px;' class='text-dark'><i class='fas fa-info-circle'></i> " . $_SESSION['info'] . " </span>
</div>";
    unset($_SESSION['info']);
  }

  ?>
</div>