<? //include theme settings
include $gloTemplateSettings;
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<? echo $gloFaviconsDir; ?>/<? echo $gloBrandFavicon; ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/59fbcbc698.js" crossorigin="anonymous"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Tilt+Warp&display=swap');</style>
    <!-- Styles for this template -->
    <link href="<? echo $gloTemplate; ?>/css/signin_general.css" rel="stylesheet">
    <? // Include custom brand CSS file if it exists
    $customCssFile = file_exists($owncss) ? $owncss : "$gloTemplate/css/$LoginCSS";
    echo "<link href='$customCssFile' rel='stylesheet'>";
    ?>
    <link href="<? echo $gloTemplate; ?>/css/override.css" rel="stylesheet">
    <link href="<? echo $gloTemplate; ?>/css/modal.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/59fbcbc698.js" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <title><? echo $gloBrandSiteName; ?></title>

</head>
<!-- Override css -->
<style>
    :root {
        --brand-color-bkg: <?php echo $gloBrandColorBKG; ?>;
        --brand-color-text: <?php echo $gloBrandColorText; ?>;
        --brand-title-color: <?php echo $gloBrandTitleColor; ?>;
        --brand-color-link: <?php echo $gloBrandColorLink; ?>;
        --brand-color-link-hover: <?php echo $gloBrandColorLinkHover; ?>;
        --brand-color-button: <?php echo $gloBrandColorButton; ?>;
        --brand-color-button-text: <?php echo $gloBrandColorButtonText; ?>;
        --brand-color-focus: <?php echo $gloBrandColorFocus; ?>;
    }
    body {
        background-image: url(<?php echo $gloTemplateBKG; ?>);
    }
</style>

<body class="loginbkg text-center">

    <? include $gloTemplateTopLinks; ?>
    <img id="preload" src="<?php echo $gloTemplateBKG; ?>" alt="Preload">
    <div class="loader-container"> 
        <img id="loader" src="<?php echo $gloTemplateLoader; ?>" alt="Loading...">
    </div>
    <main class="page-signin<? echo $gloTemplatePageClass; ?> w-100 m-auto">
        <div id="content" class="card content-transition">
            <div class="card-body <? echo $gloTemplaceCardClass; ?>">
            <!-- START -->
                <? include $gloTemplateContent; ?>
            <!-- END -->
            </div>
        </div>
    </main>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
        // JavaScript to add fade-in class after content is loaded
        window.onload = function() {
            // Hide the loader and show the content
            document.getElementById('loader').style.display = 'none';
            document.getElementById('content').classList.add('fade-in');
        };
    </script>
</body>
</html>