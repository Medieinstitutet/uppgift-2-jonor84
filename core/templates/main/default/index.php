<? //include theme settings
include $gloTemplateSettings;
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<? echo $gloBrandSiteName; ?>">
    <meta name="author" content="JN">
    <link rel="shortcut icon" href="<? echo $gloFaviconsDir; ?>/<? echo $gloBrandFavicon; ?>" type="image/x-icon">
    <title>
        <? echo $gloBrowserTitle; ?> -
        <? echo $gloBrandSiteName; ?>
    </title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Tilt+Warp&display=swap');
    </style>

    <!-- Override colors -->
    <style>
        body {
            background-color:
                <? echo $gloBrandColorBKG; ?> !important;
            color:
                <? echo $gloBrandColorText; ?> !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color:
                <? echo $gloBrandColorTitle; ?> !important;
        }

        .alert-light {
            background-color: #fbfafc !important;
            border-color: #faf9fc !important;
        }

        .brand-text {
            color:
                <? echo $gloBrandColorText; ?> !important;
        }

        .brand-title {
            color:
                <? echo $gloBrandColorTitle; ?> !important;
        }

        .pheader {
            color:
                <? echo $gloBrandColorTitle; ?> !important;
            font-weight: bold;
        }

        a {
            color:
                <? echo $gloBrandColorLink; ?> !important;
        }

        a:hover {
            color:
                <? echo $gloBrandColorLinkHover; ?> !important;
        }

        .header-right-icons:hover .nav-link.icon:hover {
            color:
                <? echo $gloBrandColorLinkHover; ?> !important;

        }

        .brand-button {
            background-color:
                <? echo $gloBrandColorButton; ?> !important;
            color:
                <? echo $gloBrandColorButtonText; ?> !important;
        }

        .brand-button:hover {
            color: #ffffff !important;
        }

        .btn-primary {
            background-color:
                <? echo $gloBrandColorButton; ?> !important;
            color:
                <? echo $gloBrandColorButtonText; ?> !important;
        }

        .btn-primary:hover {
            color: #ffffff !important;

        }


        input:focus {
            border: 1px solid <? echo $gloBrandColorFocus; ?> !important;
            box-shadow:
                <? echo $gloBrandColorFocus; ?> 0px 2px 4px 0px !important;
            -webkit-box-shadow:
                <? echo $gloBrandColorFocus; ?> 0px 2px 8px 0px !important;
            -moz-box-shadow:
                <? echo $gloBrandColorFocus; ?> 0px 2px 8px 0px !important;
        }

        .page-item.active .page-link {
            color:
                <? echo $gloBrandColorButtonText; ?> !important;
            background-color:
                <? echo $gloBrandColorButton; ?> !important;
            border-color:
                <? echo $gloBrandColorButton; ?> !important;
        }

        .input-group-text {
            color:
                <? echo $gloBrandColorButtonText; ?> !important;

            background-color:
                <? echo $gloBrandColorButton; ?> !important;

        }

        .custom-switch-input:checked~.custom-switch-indicator {
            background:
                <? echo $gloBrandColorButton; ?> !important;
        }

        #back-to-top:hover {
            background: #fff !important;
        }

        #back-to-top {
            color: #fff !important;
            background:
                <? echo $gloBrandColorButton; ?> !important;
            border: 2px solid <? echo $gloBrandColorButton; ?> !important;
        }

        @media (min-width: 992px) {
            .app-header {
                padding-inline-start: 10px !important;
            }
        }

        .nav-fill .nav-item .nav-link,
        .nav-justified .nav-item .nav-link {
            width: auto !important;
            padding: 10px;
        }

        .nav-link {
            padding: 10px !important;
            margin: 0 10px !important;
            /* Adjust the value according to your spacing preference */
        }


        .nav-link .active {
            background-color:
                <? echo $gloBrandColorButton; ?> !important;
            color:
                <? echo $gloBrandColorLinkHover; ?> !important;
        }

        .row>* {
            /* padding-right: 0 !important; */
        }

        /* For screens larger than 1600px */
        @media (min-width: 1600px) {
            .container.with-sidebar {
                padding-left: 50px;
                padding-right: 50px;
                width: calc(100% - 100px);
            }
        }

        /* For screens between 1200px and 1599px */
        @media (min-width: 1200px) and (max-width: 1599px) {
            .container.with-sidebar {
                /* Add padding or margin to the left side */
                padding-left: 140px;
                padding-right: 140px;
                /* Adjust the value according to the width of your side menu */
                /* Adjust width to fit the remaining space */
                width: calc(100% - 280px);
                /* Adjust the value according to the width of your side menu */
            }
        }


        /* For screens between 992px and 1199px (typical tablets) */
        @media (min-width: 992px) and (max-width: 1199px) {
            .container.with-sidebar {
                padding-left: 150px;
                padding-right: 150px;
                width: calc(100% - 300px);
            }
        }

        /* For screens between 768px and 992px (typical tablets) */
        @media (min-width: 768px) and (max-width: 991px) {

            /* Adjustments for tablets */
            .container.with-sidebar {
                padding-left: 15px;
                /* Adjust as needed */
                padding-right: 15px;
                /* Adjust as needed */
                width: calc(100% - 30px);
                /* Calculate width minus padding */
            }
        }

        /* For screens smaller than 768px (typical mobile devices) */
        @media (max-width: 767px) {

            /* Adjustments for mobile */
            .container.with-sidebar {
                padding-left: 5px;
                /* Adjust as needed */
                padding-right: 5px;
                /* Adjust as needed */
                width: calc(100% - 10px);
                /* Calculate width minus padding */
            }
        }
    </style>
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/59fbcbc698.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="<? echo $gloTemplateMain; ?>/assets/css/custom.css" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<? echo $gloTemplateMain; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- includejquery ui / datepicker-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- STYLE CSS -->
    <link href="<? echo $gloTemplateMain; ?>/assets/css/style.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="<? echo $gloTemplateMain; ?>/assets/css/plugins.css" rel="stylesheet">
    <!--- FONT-ICONS CSS-->
    <link href="<? echo $gloTemplateMain; ?>/assets/css/icons.css" rel="stylesheet">
    <!-- include simple switch -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">

    <!-- include tiny wysiwyg -->
    <script src="https://myhalo.se/core/system/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- The script above *must* be listed first because it must be loaded first.  -->
    <!-- If it is not listed (and loaded) first, TinyMCE will not work.  -->
    <script src="https://cdn.tiny.cloud/1/z4fyfyouwy29c0982w4b6cexj1v2uka5mbdj1sf9maoimwp7/tinymce/6/plugins.min.js" referrerpolicy="origin"></script>
    <!-- This script provides access to TinyMCE’s premium plugins. -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

</head>
<? if ($SideMenuActive) { ?>

    <body class="app sidebar-mini ltr light-mode">
    <? } else { ?>

        <body class="app ltr light-mode horizontal-hover header-light horizontal">
        <? } ?>
        <!-- GLOBAL-LOADER -->
        <div id="global-loader">
            <img src="<? echo $gloTemplateLoader; ?>" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOBAL-LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="page-main">

                <!-- app-Header -->
                <div class="app-header header sticky">
                    <div class="container-fluid main-container">

                        <div class="d-flex">
                            <? if ($SideMenuActive) { ?>
                                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
                            <? } ?>
                            <div class="<? if ($SideMenuActive) {
                                            echo "d-md-none";
                                        } ?>"><a href="<? echo $SERVICESTARTLINK; ?>">
                                    <?php echo $gloBrandLogoMainShow; ?>
                                </a></div>
                            <!-- sidebar-toggle-->
                            </a>
                            <!-- LOGO -->
                            <div class="main-header-center ms-3 d-none d-lg-block dropdown">
                                <?
                                if ($SHOWTOPSERVICENAME) { ?>
                                    <span class="h4 font-weight-bold p-2 text-uppercase text-purple" style="font-family: 'Tilt Warp'!important;">
                                        <? echo $SERVICENAME; ?>
                                    </span>&nbsp;
                                <? } ?>

                                <? if ($SHOWADMINMODE) { ?>
                                    <div style="font-weight: bold; font-size:16px;" class="badge bg-danger p-2">
                                        <a href='#' data-id="<? echo $gloADMINSESSION; ?>" data-bs-toggle='modal' data-toggle='modal' data-bs-target='#switchAModal' data-target='#switchAModal' class="text-white"><i class="fas fa-user-astronaut"></i> ADMIN LÄGE</a>
                                    </div>
                                <? } ?>
                            </div>

                            <div class="d-flex order-lg-2 ms-auto header-right-icons"> <!-- SEARCH -->
                                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon fe fe-more-vertical"></span> </button>
                                <div class="navbar navbar-collapse responsive-navbar p-0">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                        <div class="d-flex order-lg-2 justify-content-center">

                                            <!-- User menu and fullwindowmenu -->
                                            <? include $gloTemplateUsermenu; ?>
                                            <? include $gloTemplateFullwindowmenu; ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /app-Header -->

                <!-- SIDE-MENU -->
                <? if ($SideMenuActive) { ?>
                    <!--APP-SIDEBAR-->
                    <div class="sticky">
                        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                        <div class="app-sidebar">
                            <div class="side-header">
                                <a class="header-brand1" href="<? echo $SERVICESTARTLINK; ?>">
                                    <? // GET LOGO OR TEXTNAME
                                    echo $gloBrandLogoMainShow;
                                    ?>
                                </a>
                                <!-- LOGO -->
                            </div>

                            <div class="main-sidemenu">
                                <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                                    </svg></div>
                                <ul class="side-menu">
                                    <? include $gloTemplateSidemenu; ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!--/APP-SIDEBAR-->
                <? } ?>

                <!--app-content open-->

                <main role="main" class="container mt-5 <?php echo ($SideMenuActive) ? 'with-sidebar' : ''; ?>">
                    <? include_once $gloTemplateNotifications; ?>
                    <? // INCLUDES THE CORRECT PAGE AND MODULE/APP if exist
                        include $gloTemplateContent;
                    ?>
                </main>

                <!--app-content close-->

            </div>

            <!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            &copy;
                            <? echo date('Y'); ?>
                            <? echo $gloBrandCompanyName; ?>
                            <? echo $VERSION; ?>N. | <a href="/about">Om Webbplatsen</a> | <a href="/terms">Villkor</a>.

                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER END -->

            <!-- BACK-TO-TOP -->
            <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

            <!-- JQUERY JS -->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/jquery.min.js"></script>
            <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->


            <!-- BOOTSTRAP JS -->
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

            <!-- SPARKLINE JS-->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/jquery.sparkline.min.js"></script>

            <!-- Sticky js -->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/sticky.js"></script>

            <!-- DATEPICKER-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/sv.min.js" integrity="sha512-DGfo0+uPZLhfqjfMnPPveWvVTSQ7M0RP6bmlkgGgF/ATKSBPKIBzjyCtActIRL3vJ0LJRirvqQHFA0icXpCIew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="../core/shared/assets/js/tempusdominus-bootstrap-4.js"></script>
            <script src="../core/system/js/datepicker.js"></script>

            <!-- SIDEBAR JS -->
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/sidebar/sidebar.js"></script>

            <!-- INTERNAL Data tables js-->
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/datatable/dataTables.responsive.min.js"></script>


            <!-- SIDE-MENU JS -->
            <script src="<? echo $gloTemplateMain; ?>/assets/plugins/sidemenu/sidemenu.js"></script>

            <!-- PROGRESS -->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/circle-progress.min.js"></script>

            <!-- Color Theme js -->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/themeColors.js"></script>

            <!-- CUSTOM JS -->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/custom.js"></script>

            <!-- Select2 Cdn -->
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <!-- Internal Select-2.js -->
            <script src="<? echo $gloTemplateMain; ?>/assets/js/select2.js"></script>

            <!-- simple switch -->
            <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>


            <!-- Include tiny wysiwyg settings -->
            <script src="../core/shared/js/tiny.js"></script>
            <script>
                const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', 'tiny_upload.php');

                    xhr.upload.onprogress = (e) => {
                        progress(e.loaded / e.total * 100);
                    };

                    xhr.onload = () => {
                        if (xhr.status === 403) {
                            reject({
                                message: 'HTTP Error: ' + xhr.status,
                                remove: true
                            });
                            return;
                        }

                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }

                        const json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        resolve(json.location);
                    };

                    xhr.onerror = () => {
                        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    };

                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);
                });
            </script>

            <!-- Include datatables settings -->
            <? include('datatable-settings.php'); ?>

            <script>
                function passFunction() {
                    var x = document.getElementById("passInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                    var x = document.getElementById("passInput2");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
                <?php include_once "shared/scripts.php" ?>
            </script>


        </body>

</html>