<?

if ($HALOSESSION) {
  if ($gloBrandInfoImportant) {
    echo "
      <div class='alert alert-warning mb-5' role='alert'>
      <h4 class='text-dark'><i class='fas fa-exclamation-triangle'></i>  <b>" . $gloBrandInfoImportant . "</b> </h4>
      </div>";
  }
}

if ($gloBrandInfoInfo) {
  echo "
  <div class='alert alert-info mb-5' role='alert'>
   <h4 class='text-dark'><i class='fas fa-info-circle'></i>  <b>" . $gloBrandInfoInfo . "</b> </h4>
  </div>";
}

if ($gloNote) {
  echo "
<div class='alert alert-info mb-5' role='alert'>
 <h4 class='text-dark'><i class='fas fa-info-circle'></i>  " . $gloNote . " </h4>
</div>";
}

if ($_SESSION['error']) {
  echo "
<div class='alert alert-danger mb-5' role='alert'>
 <h4 class='text-dark'><i class='fas fa-exclamation-triangle'></i> " . $_SESSION['error'] . " </h4>
</div>";
  unset($_SESSION['error']);
}


if ($_SESSION['success']) {
  echo "
<div class='alert alert-success mb-5' role='alert'>
 <h4 class='text-dark mb-0'><i class='fas fa-check-circle'></i> " . $_SESSION['success'] . " </h4>
</div>";
  unset($_SESSION['success']);
}

if ($_SESSION['warning']) {
  echo "
<div class='alert alert-warning mb-5' role='alert'>
 <h4 class='text-dark'><i class='fas fa-exclamation-triangle'></i> " . $_SESSION['warning'] . " </h4>
</div>";
  unset($_SESSION['warning']);
}


if ($_SESSION['info']) {
  echo "
<div class='alert alert-info mb-5' role='alert'>
  <h4 class='text-dark'><i class='fas fa-info-circle'></i> " . $_SESSION['info'] . " </h4>
</div>";
  unset($_SESSION['info']);
}


if ($_SESSION['INFOWELCOME']) {
  echo "
<div class='alert alert-info mb-5' role='alert'>
  <h4 class='text-dark'><i class='fas fa-info-circle'></i> Varmt välkommen! </h4> <p class='text-dark'> " . $_SESSION['INFOWELCOME'] . " </p>
</div>";
  unset($_SESSION['INFOWELCOME']);
}

if ($_SESSION['INFONOCLIENTDATA']) {
  echo "
<div class='alert alert-info mb-5' role='alert'>
  <h4 class='text-dark'><i class='fas fa-info-circle'></i> Ingen kunddata hittades </h4> <p class='text-dark'> " . $_SESSION['INFONOCLIENTDATA'] . " </p>
</div>";
  unset($_SESSION['INFONOCLIENTDATA']);
}

if ($_SESSION['INFOCLIENTDATANEEDED']) {
  echo "
<div class='alert alert-info mb-5' role='alert'>
  <h4 class='text-dark'><i class='fas fa-info-circle'></i> Kunddata behövs</h4> <p class='text-dark'> " . $_SESSION['INFOCLIENTDATANEEDED'] . " </p>
</div>";
  unset($_SESSION['INFOCLIENTDATANEEDED']);
}
