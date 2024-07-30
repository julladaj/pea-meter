<?php

@require('config.php');
@require('class/meter.php');
@require('class/MeterClient.php');

$uploaded_image_path = '';
$url_name = '';

$meter_install_image_path = '';
$meter_install_url = '';

if (isset($_GET['hash']) && $_GET['hash']) {
    $_GET['id'] = hex2bin($_GET['hash']);
}

if (isset($_GET['id']) && $_GET['id']) {
    $_POST['search'] = $_GET['id'];
}

if (isset($_POST['search'], $_POST['date_finish']) && $_POST['search'] && $_POST['date_finish']) {
    $meterClient = new MeterClient();
    $meterClient->updateMeterClient($_POST['search'], $_POST['date_finish']);
}

$result = array();
if (isset($_POST['search']) && $_POST['search']) {
    $meter = new _Meter();
    $result = $meter->getMeterClient($_POST['search']);

    if (!isset($result['auto_id']) || !$result['auto_id']) {
        die('ไม่พบข้อมูล');
    }

    $uploaded_image_path = DIR_UPLOAD . $result['auto_id'] . ".jpg";
    if (file_exists($uploaded_image_path)) {
        $url_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/" . $result['auto_id'] . ".jpg";
    } else {
        $uploaded_image_path = '';
    }

    $meter_install_image_path = DIR_UPLOAD . $result['auto_id'] . "_meter.jpg";
    if (file_exists($meter_install_image_path)) {
        $meter_install_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/" . $result['auto_id'] . "_meter.jpg";
    } else {
        $meter_install_image_path = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../theme/default/demo1/dist/"/>
    <meta charset="utf-8"/>
    <title>ตรวจสอบสถานะคำร้อง</title>
    <meta name="description" content="Column search datatables examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->


    <!--end::Page Vendors Styles -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css"/>

    <link href="assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
    <style>
        .kt-portlet {
            background-color: #ddd;
        }

        .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="done"] .kt-wizard-v1__nav-body .kt-wizard-v1__nav-icon, .kt-wizard-v1 .kt-wizard-v1__nav .kt-wizard-v1__nav-items .kt-wizard-v1__nav-item[data-ktwizard-state="done"] .kt-wizard-v1__nav-body .kt-wizard-v1__nav-label {
            color: #fd397a;
        }

        .container {
            height: 400px;
            position: relative;
        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-page--loading">

<!-- begin:: Page -->


<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">


        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" style="padding-top: 0;">


            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">

                            <?php
                            if (isset($_POST['search']) && $_POST['search']) { ?>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="ค้นหาจากเลขคำร้อง หรือเบอร์โทร หรือหมายเลขผู้ใช้ไฟ หรือชื่อ-สกุล" value="<?php
                                        echo (isset($_POST['search']) && $_POST['search']) ? $_POST['search'] : ""; ?>"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit"><i class="la la-search" style="color:white;"></i> ค้นหา</button>
                                        </div>
                                    </div>
                                </form>


                                <hr/>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">เลขคำร้อง:</label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <span style="font-size:14pt;font-weight:700;"><?php
                                            echo $result['auto_id']; ?></span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">1. ข้อมูล ผู้ใช้ไฟฟ้า</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ชื่อ-นามสกุล:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="fname" value="<?php
                                        echo (isset($result['fname'])) ? $result['fname'] : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ยื่นคำร้อง:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="date_add" value="<?php
                                        echo (isset($result['date_add'])) ? date_thai_format($result['date_add']) : ''; ?>" readonly/>
                                    </div>
                                    <!--<label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลขผู้ใช้ไฟฟ้า:</label>
											<div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
												<input type="text" class="form-control" name="number1" value="<?php
                                    echo (isset($result['number1'])) ? $result['number1'] : ''; ?>" />
											</div>-->
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ประเภทคำร้อง:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="meter_category_id" value="<?php
                                        echo (isset($result['meter_category_detail'])) ? $result['meter_category_detail'] : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ขนาดมิเตอร์:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="meter_size_detail" value="<?php
                                        echo (isset($result['meter_size_detail'])) ? $result['meter_size_detail'] : ''; ?>" readonly/>
                                    </div>
                                </div>


                                <hr/>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">2. ข้อมูล สถานะจากการไฟฟ้า</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ชื่อผู้รับ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="recipient_name" value="<?php
                                        echo (isset($result['recipient_name'])) ? $result['recipient_name'] : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันนัดตรวจ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="date_appoint" value="<?php
                                        echo (isset($result['date_appoint'])) ? date_thai_format($result['date_appoint']) : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ชื่อผู้ตรวจ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="officer_name" value="<?php
                                        echo (isset($result['officer_name'])) ? $result['officer_name'] : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผลการตรวจ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="meter_qc_detail" value="<?php
                                        echo (isset($result['meter_qc_detail'])) ? $result['meter_qc_detail'] : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ชำระเงินค่ามิเตอร์:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="date_payment" value="<?php
                                        echo (isset($result['date_payment'])) ? date_thai_format($result['date_payment']) : ''; ?>" readonly/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันส่งงานติดตั้ง:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="date_install" value="<?php
                                        echo (isset($result['date_install'])) ? date_thai_format($result['date_install']) : ''; ?>" readonly/>
                                    </div>
                                </div>

                                <?php
                                if (ENABLE_SLIPT_UPLOAD && isset($result['payment_value'], $result['meter_qc_detail']) && $result['payment_value'] > 0 && $result['meter_qc_detail'] == 'รอชำระค่าธรรมเนียม') { ?>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label" style="color: red;">บัญชี:</label>
                                        <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                            <input type="text" class="form-control" style="font-weight: 900;" name="payment_value" value="<?php
                                            echo BANK_NAME; ?>" readonly/>
                                        </div>
                                        <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label" style="color: red;">ชื่อบัญชี:</label>
                                        <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                            <input type="text" class="form-control" style="font-weight: 900;" value="<?php
                                            echo ACCOUNT_NAME; ?>" readonly/>
                                        </div>
                                        <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label" style="color: red;">หมายเลขบัญชี:</label>
                                        <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                            <input type="text" class="form-control" style="font-weight: 900;" value="<?php
                                            echo ACCOUNT_NO; ?>" readonly/>
                                        </div>
                                        <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label" style="color: red;">จำนวนเงินที่ต้องชำระ:</label>
                                        <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                            <input type="text" class="form-control" style="font-weight: 900;" name="payment_value" value="<?php
                                            echo $result['payment_value']; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">แนบหลักฐานการชำระเงิน:<br>(กรุณาแนบหลักฐานการชำระเงิน เพื่อแจ้งให้เจ้าหน้าที่ดำเนินการต่อไป)</label>
                                        <div class="col-xl-1 col-lg-3">
                                            <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                                <div class="kt-avatar__holder" id="slipt_display" style="background-position: center; background-size: cover; background-image: url(<?php
                                                echo ($uploaded_image_path) ? $url_name . '?t=' . time() : 'assets/media/users/default.jpg'; ?>)"></div>
                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="ยกเลิกหลักฐานการชำระเงิน">
														<i class="fa fa-times"></i>
													</span>
                                            </div>

                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <form action="upload_file.php" method="post" enctype="multipart/form-data">
                                                <label class="btn btn-primary mb-1" for="upload_slipt">1. เลือกไฟล์รูปที่ต้องการแนบ</label>
                                                <input type="file" name="file" class="btn btn-primary mb-1 d-none" id="upload_slipt" accept="image/jpg, image/jpeg, image/png"/><br>
                                                <input type="button" class="btn btn-success" value="2. แนบเอกสารชำระเงินให้แก่เจ้าหน้าที่" id="button_upload"/>
                                            </form>
                                            <progress value="0" max="100" class="form-control"></progress>
                                            <span class="form-text text-muted">รองรับไฟล์นามสกุล: png, jpg.</span>
                                            <span class="form-text text-success" id="upload_status"></span>
                                            <span class="form-text" id="upload_url"><?php
                                                echo ($uploaded_image_path) ? '<a href="' . $url_name . '?t=' . time() . '" target="_BLANK">' . $url_name . '</a>' : ''; ?></span>
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                                <div class="form-group row">
                                    <?php
                                    $filename = $result['auto_id'] . '_fee';
                                    $feeImageUrl = '';
                                    $uploaded_fee_image_path = DIR_UPLOAD . $filename . ".jpg";
                                    if (file_exists($uploaded_fee_image_path)) {
                                        $feeImageUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/" . $filename . ".jpg";
                                    } else {
                                        $uploaded_fee_image_path = '';
                                    }
                                    if ($uploaded_fee_image_path) {
                                        ?>
                                        <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-form-label">รูปค่าธรรมเนียม:</label>
                                        <div class="col-xl-3 col-lg-4 col-md-10">
                                            <div class="kt-avatar kt-avatar--outline">
                                                <div class="kt-avatar__holder" style="background-position: center; background-size: cover; background-image: url(<?php
                                                echo ($uploaded_fee_image_path) ? $feeImageUrl : 'assets/media/users/default.jpg'; ?>)"></div>
                                                <span class="form-text" id="upload_insurance_url">
                                                <?php
                                                if ($uploaded_fee_image_path) {
                                                    ?>
                                                    <a href="<?= $feeImageUrl ?>?t=<?= time() ?>" target="_BLANK">ดูภาพต้นฉบับ</a> | <a href="<?= $feeImageUrl ?>?t=<?= time() ?>" download="">ดาวน์โหลด</a>
                                                    <?php
                                                }
                                                ?>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>


                                    <?php
                                    $filename = $result['auto_id'] . '_insurance';
                                    $insuranceImageUrl = '';
                                    $uploaded_insurance_image_path = DIR_UPLOAD . $filename . ".jpg";
                                    if (file_exists($uploaded_insurance_image_path)) {
                                        $insuranceImageUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/" . $filename . ".jpg";
                                    } else {
                                        $uploaded_insurance_image_path = '';
                                    }
                                    if ($uploaded_insurance_image_path) {
                                        ?>
                                        <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-form-label">รูปค่าประกัน:</label>
                                        <div class="col-xl-3 col-lg-4 col-md-10">
                                            <div class="kt-avatar kt-avatar--outline">
                                                <div class="kt-avatar__holder" style="background-position: center; background-size: cover; background-image: url(<?php
                                                echo ($uploaded_insurance_image_path) ? $insuranceImageUrl : 'assets/media/users/default.jpg'; ?>)"></div>
                                                <span class="form-text" id="upload_insurance_url">
                                                <?php
                                                if ($uploaded_insurance_image_path) {
                                                    ?>
                                                    <a href="<?= $insuranceImageUrl ?>?t=<?= time() ?>" target="_BLANK">ดูภาพต้นฉบับ</a> | <a href="<?= $insuranceImageUrl ?>?t=<?= time() ?>" download="">ดาวน์โหลด</a>
                                                    <?php
                                                }
                                                ?>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="form-group row">
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">สาเหตุ:</label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <input type="text" class="form-control " name="cause" value="<?php
                                        echo (isset($result['cause'])) ? $result['cause'] : ''; ?>" data-toggle="kt-tooltip" data-placement="top" data-html="true" title="<b>สาเหตุ</b> ที่เจ้าพนักงานระบุให้แก่ผู้ใช้ไฟ"/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ขยายเขต:</label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="cause1" value="<?php
                                        echo (isset($result['cause1'])) ? $result['cause1'] : ''; ?>"/>
                                    </div>
                                </div>

                                <?php
                                if (isset($result['meter_qc_detail']) && ($result['meter_qc_detail'] === 'ขอให้แก้ไข' || $result['meter_qc_detail'] === 'ไม่ผ่าน' || $result['meter_qc_detail'] === 'รอนัด')) { ?>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-form-label" style="color: red;">แก้ไขแล้วเสร็จ แจ้งเจ้าหน้าที่เพื่อดำเนินการ :</label>
                                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
                                            <button class="form-control <?php
                                            echo (isset($result['request_button']) && $result['request_button'] == 1) ? 'btn-warning' : ''; ?>" style="font-weight: 900;" id="button_recheck_request" <?php
                                            echo (isset($result['request_button']) && $result['request_button'] == 1) ? '' : 'disabled'; ?>><i class="flaticon-alert"></i> ขอนัดตรวจใหม่
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                                <?php if ($result['meter_qc_detail'] !== 'รอชำระค่าธรรมเนียม') { ?>
                                <hr/>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">3. แผนกมิเตอร์</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ติดตั้งไม่เกินวันที่:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control" name="date_deathline" value="<?php
                                        echo (isset($result['date_deathline'])) ? $result['date_deathline'] : ''; ?>"/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลขเครื่องวัด:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <?php
                                        $number2 = $result['number2'] ?? ''; ?>
                                        <input type="text" class="form-control" name="number2" value="<?= $number2 ?>"/>
                                    </div>
                                    <label for="example-search-input" class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ติดตั้ง แล้วเสร็จ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <form method="post" action="">
                                            <div class="input-group">
                                                <input type="hidden" name="search" value="<?= $_POST['search'] ?? '' ?>"/>
                                                <input type="date" class="form-control" name="date_finish" value="<?= $result['date_finish'] ?? '' ?>"/>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i class="la la-save" style="color:white;"></i> บันทึก</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php
                                if (isset($number2) && $number2) { ?>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">แนบรูปการติดตั้งมิเตอร์:</label>
                                        <div class="col-xl-1 col-lg-3">
                                            <div class="kt-avatar kt-avatar--outline">
                                                <div class="kt-avatar__holder" id="meter_installation_preview" style="background-position: center; background-size: cover; background-image: url(<?php
                                                echo ($meter_install_image_path) ? $meter_install_url : 'assets/media/users/default.jpg'; ?>)"></div>
                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="ยกเลิกหลักฐานการชำระเงิน">
														<i class="fa fa-times"></i>
													</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-6">
                                            <form action="upload_meter_installation.php.php" method="post" enctype="multipart/form-data">
                                                <input type="file" name="file" id="meter_installation_input" accept="image/jpg, image/jpeg, image/png"/><br>
                                                <input type="button" value="แนบรูปการติดตั้งมิเตอร์" id="meter_installation_button"/>
                                            </form>
                                            <progress value="0" max="100" class="form-control" id="meter_installation_progress"></progress>
                                            <span class="form-text text-muted">รองรับไฟล์นามสกุล: png, jpg.</span>
                                            <span class="form-text text-success" id="meter_installation_status"></span>
                                            <span class="form-text" id="meter_installation_url"><?= ($meter_install_image_path) ? '<a href="' . $meter_install_url . '?t=' . time(
                                                    ) . '" target="_BLANK">ดูภาพต้นฉบับ</a>' : '' ?> | <?= ($meter_install_image_path) ? '<a href="' . $meter_install_url . '?t=' . time() . '" download>ดาวน์โหลด</a>' : '' ?></span>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                <?php
                            } else { ?>
                                <div class="container">
                                    <div class="center">
                                        <img src="assets/media/logos/PEA_LOGO.svg" alt="PEA" title="PEA" style="height: 150px;"/>
                                        <h3 style="font-size: 1.5rem;padding-top: 30px;"><?php
                                            echo PEANAME; ?><br/></h3>
                                        <h1 style="font-size: 2.5rem;">ค้นหาข้อมูล และติดตามสถานะคำร้อง</h1>
                                        <form method="POST" action="">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="ค้นหาจากเลขคำร้อง หรือเบอร์โทร หรือหมายเลขผู้ใช้ไฟ หรือชื่อ-สกุล" value=""/>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit"><i class="la la-search" style="color:white;"></i> ค้นหา</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['search']) && $_POST['search']) { ?>
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        <div class="kt-portlet">
                            <div class="kt-portlet__body kt-portlet__body--fit">
                                <div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
                                    <div class="kt-grid__item">

                                        <!--begin: Form Wizard Nav -->
                                        <div class="kt-wizard-v1__nav">

                                            <!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                                            <div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
                                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" <?php
                                                echo (isset($result['date_add']) && $result['date_add']) ? 'data-ktwizard-state="done"' : ''; ?>>
                                                    <div class="kt-wizard-v1__nav-body">
                                                        <div class="kt-wizard-v1__nav-icon">
                                                            <i class="flaticon-notes"></i>
                                                        </div>
                                                        <div class="kt-wizard-v1__nav-label">
                                                            1. เริ่มต้นรับคำร้อง<br><small><?php
                                                                echo (isset($result['date_add']) && $result['date_add']) ? $result['date_add'] : '( รอดำเนินการ )'; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" <?php
                                                echo (isset($result['date_appoint']) && $result['date_appoint']) ? 'data-ktwizard-state="done"' : ''; ?>>
                                                    <div class="kt-wizard-v1__nav-body">
                                                        <div class="kt-wizard-v1__nav-icon">
                                                            <i class="flaticon-list"></i>
                                                        </div>
                                                        <div class="kt-wizard-v1__nav-label">
                                                            2. ผลการตรวจ<br><small><?php
                                                                echo (isset($result['meter_qc_detail']) && $result['meter_qc_detail']) ? $result['meter_qc_detail'] : '( รอดำเนินการ )'; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" <?php
                                                echo (isset($result['date_payment']) && $result['date_payment']) ? 'data-ktwizard-state="done"' : ''; ?>>
                                                    <div class="kt-wizard-v1__nav-body">
                                                        <div class="kt-wizard-v1__nav-icon">
                                                            <i class="flaticon2-list"></i>
                                                        </div>
                                                        <div class="kt-wizard-v1__nav-label">
                                                            3. ชำระค่ามิเตอร์<br><small><?php
                                                                echo (isset($result['date_payment']) && $result['date_payment']) ? $result['date_payment'] : '( รอดำเนินการ )'; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" <?php
                                                echo (isset($result['date_deathline']) && $result['date_deathline']) ? 'data-ktwizard-state="done"' : ''; ?>>
                                                    <div class="kt-wizard-v1__nav-body">
                                                        <div class="kt-wizard-v1__nav-icon">
                                                            <i class="flaticon-truck"></i>
                                                        </div>
                                                        <div class="kt-wizard-v1__nav-label">
                                                            4. กำหนดวันติดตั้ง<br><small><?php
                                                                echo (isset($result['date_deathline']) && $result['date_deathline']) ? $result['date_deathline'] : '( รอดำเนินการ )'; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" <?php
                                                echo (isset($result['date_finish']) && $result['date_finish']) ? 'data-ktwizard-state="done"' : ''; ?>>
                                                    <div class="kt-wizard-v1__nav-body">
                                                        <div class="kt-wizard-v1__nav-icon">
                                                            <i class="flaticon-globe"></i>
                                                        </div>
                                                        <div class="kt-wizard-v1__nav-label">
                                                            5. ติดตั้งแล้วเสร็จ<br><small><?php
                                                                echo (isset($result['date_finish']) && $result['date_finish']) ? $result['date_finish'] : '( รอดำเนินการ )'; ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--end: Form Wizard Nav -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        <?php
                        echo date("Y"); ?>&nbsp;&copy;&nbsp;<a href="tel:0840416820" target="_blank" class="kt-link">DSD</a>
                    </div>
                    <div class="kt-footer__menu">
                        <a href="#" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                        <a href="#" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                        <a href="#" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
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

<div class="modal fade" id="modal_evaluation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">อัพโหลดสำเร็จ</h5>
            </div>
            <form id="form_evaluation">
                <input type="hidden" name="auto_id" value="<?= $result['auto_id'] ?>" />
                <div class="modal-body" style="font-size: 12pt;">
                    <label style="margin-top: 10px; font-size: 14pt;"><b>✅ อัพโหลดสำเร็จ หลักฐานได้เข้าสู่ระบบแล้วเรียบร้อย</b></label><br>
                    <label style="margin-top: 10px; font-size: 12pt;"><b>กรุณาประเมินความพึงพอใจต่อการขอใช้ไฟครั้งนี้</b></label><br>

                    <div style="padding-left: 2rem;">
                        <div>
                            <input type="radio" id="evaluation_5" name="score" value="5" checked>
                            <label for="evaluation_5">5 พอใจมาก</label>
                        </div>

                        <div>
                            <input type="radio" id="evaluation_4" name="score" value="4">
                            <label for="evaluation_4">4 พอใจ</label>
                        </div>

                        <div>
                            <input type="radio" id="evaluation_3" name="score" value="3">
                            <label for="evaluation_3">3 ปานกลาง</label>
                        </div>

                        <div>
                            <input type="radio" id="evaluation_2" name="score" value="2">
                            <label for="evaluation_2">2 ไม่พอใจ</label>
                        </div>

                        <div>
                            <input type="radio" id="evaluation_1" name="score" value="1">
                            <label for="evaluation_1">1 ไม่พอใจมาก</label>
                        </div>
                    </div>

                    <div>
                        <label for="evaluation_comment"><b>ข้อเสนอแนะเพิ่มเติม</b></label>
                        <textarea id="evaluation_comment" class="form-control" name="evaluation_comment"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
<script src="assets/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="assets/plugins/bootstrap-table/bootstrap-table-filter-control.min.js"></script>
<!--<script src="assets/plugins/bootstrap-table/bootstrap-table-cookie.js" type="text/javascript"></script>-->
<script src="assets/js/pages/crud/file-upload/ktavatar.js" type="text/javascript"></script>
<!--<script src="assets/plugins/bootstrap-table/bootstrap-table-th-TH.js" type="text/javascript"></script>-->
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->

<script>
    function meter_qc_detail(value, row) {
        return row.meter_qc_detail;
    }

    function meter_category_detail(value, row) {
        return row.meter_category_detail;
    }

    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table_meter_client");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    function ajaxRequest(params) {
        $.ajax({
            type: "POST",
            url: "/meter/json_index.php",
            data: params.data,
            dataType: "json",
            success: function (rows) {
                params.success({
                    "rows": rows.items,
                    "total": rows.total
                })
            },
            error: function (er) {
                params.error(er);
            }
        });
    }


    $.fn.bootstrapTable.locales['th-TH'] = {
        formatLoadingMessage() {
            return 'กำลังโหลดข้อมูล, กรุณารอสักครู่'
        },
        formatSearch() {
            return 'ค้นหาจากเลขคำร้อง หรือเบอร์โทร หรือหมายเลขผู้ใช้ไฟ หรือชื่อ-สกุล'
        },
    }

    $.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales['th-TH']);

    $(function () {

        $('#table_meter_client').bootstrapTable({
            locale: 'th-TH'
        });


        $("#meter_installation_button").click(function () {
            event.preventDefault();

            var formData = new FormData();
            formData.append('file', $('#meter_installation_input')[0].files[0]);
            formData.append('id', '<?php echo (isset($result['auto_id']) && $result['auto_id']) ? $result['auto_id'] : 0; ?>');

            $.ajax({
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        // For handling the progress of the upload
                        myXhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                $('#meter_installation_progress').attr({
                                    value: e.loaded,
                                    max: e.total,
                                });
                            }
                        }, false);
                    }
                    return myXhr;
                },
                type: 'POST',
                url: "/meter/upload_meter_installation.php",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (data) {
                    if (data) {
                        // $('#slipt_display').css('background-image', 'url(' + data.url + ')');
                        alert("อัพโหลดสำเร็จ หลักฐานได้เข้าสู่ระบบแล้วเรียบร้อย");
                    } else {
                        alert("ไม่สามารถดำเนินการได้ โปรดติดต่อเจ้าหน้าที่เพื่อดำเนินการ");
                    }
                }
            });
        });

        $("#button_upload").click(function () {
            event.preventDefault();

            const formData = new FormData();
            formData.append('file', $('#upload_slipt')[0].files[0]);
            formData.append('id', '<?php echo (isset($result['auto_id']) && $result['auto_id']) ? $result['auto_id'] : 0; ?>');

            $.ajax({
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        // For handling the progress of the upload
                        myXhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                $('progress').attr({
                                    value: e.loaded,
                                    max: e.total,
                                });
                            }
                        }, false);
                    }
                    return myXhr;
                },
                type: 'POST',
                url: "/meter/upload_file.php",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (data) {
                    if (data.success) {
                        $('#slipt_display').css('background-image', 'url(' + data.url + ')');
                        $("#modal_evaluation").modal("show");
                    } else {
                        alert("ไม่สามารถดำเนินการได้ โปรดติดต่อเจ้าหน้าที่เพื่อดำเนินการ");
                    }
                }
            });
        });

        $('#modal_evaluation').on('hidden.bs.modal', function (e) {
            const form_evaluation = document.getElementById('form_evaluation');
            const formData = new FormData(form_evaluation);

            $.ajax({
                type: 'POST',
                url: "/meter/evaluation.php",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (data) {
                    if (data.success) {
                        $("#modal_evaluation").modal("hide");
                        alert("ขอบคุณสำหรับการประเมินความพึงพอใจ");
                        window.location.href = "/meter/";
                    }
                }
            });
        })

        <?php if (isset($result['auto_id']) && $result['auto_id']) { ?>
        $("#button_recheck_request").on('click', function () {
            $(this).prop('disabled', true);
            $(this).removeClass('btn-warning');

            $.ajax({
                url: '/meter/json_recheck_request.php',
                type: 'POST',
                data: {id: <?php echo $result['auto_id']; ?>},
                success: function (data) {
                    //console.log(data);
                }
            });
        });
        <?php } ?>

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const meter_installation_input = document.getElementById('meter_installation_input');
        const meter_installation_preview = document.getElementById('meter_installation_preview');

        if (meter_installation_input) {
            meter_installation_input.addEventListener("change", (event) => {
                const [file] = meter_installation_input.files;
                if (file) {
                    meter_installation_preview.style.backgroundImage = "url('" + URL.createObjectURL(file) + "')";
                }
            });
        }
    });
</script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>