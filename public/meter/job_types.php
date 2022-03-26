<?php

@require('config.php');
@require('class/user.php');
@require('class/meter.php');

$user = new User();
$result = $user->authentication();

if (!$user->can(['admin', 'meter'])) {
    $user->logoutAndRedirect();
}

$meter = new _Meter();

if (isset($_POST['price']) && $_POST['price']) {
    $meter->postJobInstallationPrices($_POST['price']);
    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$job_type_installation = $meter->getJobInstallationPrices(['enum' => 1]);
$job_type_reparation = $meter->getJobInstallationPrices(['enum' => 2]);
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../theme/default/demo1/dist/"/>
    <meta charset="utf-8"/>
    <title>(ADMIN) ราคางานจ้างเหมาติดตั้งมิเตอร์</title>
    <meta name="description" content="ราคางานจ้างเหมาติดตั้งมิเตอร์ประจำปี">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
    <style>
        .kt-portlet {
            background-color: #e2e5ec;
        }
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-page--loading">

<!-- begin:: Page -->


<div class="row">
    <div class="col-md-12">
        <?php
        if (isset($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $error) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> ' . $error . ' </div>';
            }
        }
        $_SESSION['error'] = array();
        ?>
    </div>
</div>

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper"
             style="padding-top: 0;">

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">
                            <form class="kt-form kt-form--label-right" action method="POST">
                                <div class="form-group row">
                                    <label class="col-md-5 col-sm-12 col-form-label"></label>
                                    <div class="col-md-5 col-sm-12">
                                        <a href="/meter/admin.php" class="btn btn-danger"><i
                                                    class="la la-angle-left"></i>
                                            กลับสู่หน้าหลัก</a>
                                        <button type="submit" class="btn btn-primary"><i class="la la-save"></i>
                                            บันทึกข้อมูล
                                        </button>
                                    </div>
                                </div>
                                <hr/>


                                <div class="form-group row">
                                    <label class="col-md-5 col-sm-12 col-form-label"></label>
                                    <div class="col-md-7 col-sm-12">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">1. งานติดตั้ง</span>
                                    </div>
                                </div>

                                <?php
                                foreach ($job_type_installation['items'] as $item) { ?>
                                    <div class="form-group row">
                                        <label for="example-search-input"
                                               class="col-md-5 col-sm-12 col-form-label"><?php
                                            echo $item['description']; ?>:</label>
                                        <div class="col-md-5 col-sm-12 input-group">
                                            <input type="number" class="form-control" aria-describedby="basic-addon2"
                                                   name="price['<?php
                                                   echo $item['id']; ?>']" value="<?php
                                            echo $item['price'] ?? 0; ?>"/>
                                            <div class="input-group-append"><span class="input-group-text">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                                <hr/>
                                <div class="form-group row">
                                    <label class="col-md-5 col-sm-12 col-form-label"></label>
                                    <div class="col-md-7 col-sm-12">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">2. งานสับเปลี่ยน ย้าย ถอนคืน</span>
                                    </div>
                                </div>

                                <?php
                                foreach ($job_type_reparation['items'] as $item) { ?>
                                    <div class="form-group row">
                                        <label for="example-search-input"
                                               class="col-md-5 col-sm-12 col-form-label"><?php
                                            echo $item['description']; ?>:</label>
                                        <div class="col-md-5 col-sm-12 input-group">
                                            <input type="number" class="form-control" aria-describedby="basic-addon2"
                                                   name="price['<?php
                                                   echo $item['id']; ?>']" value="<?php
                                            echo $item['price'] ?? 0; ?>"/>
                                            <div class="input-group-append"><span class="input-group-text">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                                <hr/>
                                <div class="form-group row">
                                    <label for="example-search-input"
                                           class="col-md-5 col-sm-12 col-form-label"></label>
                                    <div class="col-md-5 col-sm-12">
                                        <a href="/meter/admin.php" class="btn btn-danger"><i
                                                    class="la la-angle-left"></i>
                                            กลับสู่หน้าหลัก</a>
                                        <button type="submit" class="btn btn-primary"><i class="la la-save"></i>
                                            บันทึกข้อมูล
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>

                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        <?php
                        echo date("Y"); ?>&nbsp;&copy;&nbsp;<a href="tel:0840416820" target="_blank"
                                                               class="kt-link">DSD</a>
                    </div>
                    <div class="kt-footer__menu">
                        <a href="/" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                        <a href="/" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                        <a href="/" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                    </div>
                </div>
            </div>

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->


<script>

    $(document).ready(function () {
        $('#chechbox_same_address').change(function () {
            if (this.checked) {
                //var returnVal = confirm("Are you sure?");
                //$(this).prop("checked", returnVal);

                $('input[name^="location_address_"]').attr('readonly', true);
                $('input[name^="location_address_"]').each(function (index) {

                    var e_name = $(this).attr('name');
                    //console.log( e_name );

                    var e2_name = e_name.replace("location_address_", "address_");
                    console.log(e2_name);

                    $(this).val($('input[name="' + e2_name + '"]').val());
                });
            } else {
                $('input[name^="location_address_"]').removeAttr('readonly');
            }
        });

        $(document).on('click', '.today-button', function () {
            const update_target = $(this).attr('update_target');
            const date_finish = $('input[name="' + update_target + '"]');
            date_finish.val('<?php echo date('Y-m-d'); ?>');
        });
    });

    function loadModalAJAX(e) {
        var url = $(e).attr('url');

        $.ajax({
            url: url,
            type: 'post',
            success: function (response) {
                console.log(response);
                // Add response in Modal body
                $('#kt_modal_4_2').html(response);

                // Display Modal
                $('#kt_modal_4_2').modal('show');
            }
        });
    }

</script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>