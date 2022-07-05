<?php

@require('config.php');
@require('class/user.php');

$user = new User();

$isMeter = $user->can('meter');
$isAccounting = $user->can('accounting');
$isService = $user->can('service');
//$result = $user->authentication();

@require('class/meter.php');

$meter = new _Meter();

$auto_id = $_GET['auto_id'] ?? 0;
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $token = openssl_random_pseudo_bytes(8);
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);
}


if (isset($_POST['auto_id'], $_POST['token'])) {
    $result = $meter->updateMeter($_POST);
    if (!$result['auto_id']) {
        print_r($result);
        exit;
    }
    header('location: /meter/detail.php?auto_id=' . $result['auto_id'] . '&token=' . $result['token']);
}


$meter_category = $meter->getMeterCategory();
$meter_staff = $meter->getMeterStaff();
$meter_size = $meter->getMeterSize();
$meter_qc = $meter->getMeterQC();
$job_types = $meter->getJobTypes();

$data = array();
$uploaded_image_path = '';
$url_name = '';
if ($auto_id && $token) {
    $filter = array('auto_id' => $auto_id, 'token' => $token);
    $result = $meter->getJSONMeter(array('filter' => json_encode($filter)));
    if ($result['total']) {
        $data = $result['items'][0];
    }

    $uploaded_image_path = DIR_UPLOAD . $auto_id . ".jpg";
    if (file_exists($uploaded_image_path)) {
        $url_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/" . $auto_id . ".jpg";
    } else {
        $uploaded_image_path = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../theme/default/demo1/dist/"/>
    <meta charset="utf-8"/>
    <title>ระบบบันทึกข้อมูล ติดตั้งมิเตอร์</title>
    <meta name="description" content="Column search datatables examples">
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

        .form-control[readonly] {
            background-color: #f7f8fa;
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
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                <h3 class="kt-portlet__head-title">อัพเดท/ระบบบันทึกข้อมูล
                                    ติดตั้งมิเตอร์/เพิ่ม/ย้าย/เปลี่ยนประเภท</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">

                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

                            <form class="kt-form kt-form--label-right" action method="POST">
                                <input type="hidden" class="form-control" name="auto_id"
                                       value="<?php
                                       echo $auto_id; ?>"/>
                                <input type="hidden" class="form-control" name="token" value="<?php
                                echo $token; ?>"/>
                                <div class="form-group form-group-last">
                                    <div class="alert alert-secondary" role="alert">
                                        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                        <div class="alert-text">
                                            กรุณาบันทึกข้อมูลอย่างต่อเนื่อง เพื่อป้องกันข้อมูลสูญหายระหว่างการกรอก<br/>ในช่วงไวรัสแพร่ระบาด
                                            ขอให้ผู้ใช้ไฟฟ้าทุกท่านกรอกข้อมูลต่างๆ ผ่านระบบออนไลน์เป็นหลัก
                                            เพื่อลดการเดินทาง และสัมผัสกับผู้อื่น
                                            อีกทั้งยังเพิ่มความรวดเร็วในการดำเนินการแก่เจ้าหน้าที่
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if ($auto_id && $token) { ?>
                                    <?php
                                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                               class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ลิ้งแก้ไขข้อมูล:</label>
                                        <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                            <a href="<?php
                                            echo $actual_link; ?>"><?php
                                                echo $actual_link; ?></a>
                                            <span class="form-text text-muted">โปรดบันทึก URL ข้างต้น เพื่อใช้ในการเข้าแก้ไขข้อมูลเดิมนี้ ในภายหลัง</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                               class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">เลขคำร้อง:</label>
                                        <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                            <span style="font-size:14pt;font-weight:700;"><?php
                                                echo $auto_id; ?></span>
                                        </div>
                                    </div>
                                    <hr/>
                                    <?php
                                } ?>


                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">1. แผนกบริการลูกค้า</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ชื่อ-นามสกุล:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="fname"' : 'readonly' ?>
                                               value="<?= $data['fname'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">เบอร์โทร:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="telephone"' : 'readonly' ?>
                                               value="<?= $data['telephone'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ยื่นคำร้อง:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date"
                                               class="form-control" <?= ($isService) ? 'name="date_add"' : 'readonly' ?>
                                               value="<?= $data['date_add'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลขผู้ใช้ไฟฟ้า:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="number1"' : 'readonly' ?>
                                               value="<?= $data['number1'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ประเภทคำร้อง:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <select class="form-control" <?= ($isService) ? 'name="meter_category_id"' : 'readonly' ?> >
                                            <?php
                                            foreach ($meter_category['items'] as $m) { ?>
                                                <option value="<?= $m['meter_category_id'] ?? '' ?>" <?= (isset($m['meter_category_id'], $data['meter_category_id']) && $m['meter_category_id'] == $data['meter_category_id']) ? 'selected' : '' ?>>
                                                    <?= $m['meter_category_detail'] ?>
                                                </option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ขนาดมิเตอร์:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <select class="form-control" <?= ($isService) ? 'name="meter_size_id"' : 'readonly' ?> >
                                            <?php
                                            foreach ($meter_size['items'] as $m) { ?>
                                                <option value="<?= $m['meter_size_id'] ?? '' ?>" <?= (isset($m['meter_size_id'], $data['meter_size_id']) && $m['meter_size_id'] == $data['meter_size_id']) ? 'selected' : '' ?>>
                                                    <?= $m['meter_size_detail'] ?? '' ?>
                                                </option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>


                                <hr/>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">2. ข้อมูล สถานะจากการไฟฟ้า</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ชื่อผู้รับ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <select class="form-control" <?= ($isService) ? 'name="recipient_id"' : 'readonly' ?> >
                                            <option></option>
                                            <?php
                                            foreach ($meter_staff['items'] as $m) { ?>
                                                <option value="<?= $m['meter_staff_id'] ?? '' ?>" <?= (isset($m['meter_staff_id'], $data['recipient_id']) && $m['meter_staff_id'] == $data['recipient_id']) ? 'selected' : '' ?> >
                                                    <?= $m['meter_staff_name'] ?? '' ?>
                                                </option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันนัดตรวจ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date"
                                               class="form-control" <?= ($isService) ? 'name="date_appoint"' : 'readonly' ?>
                                               value="<?= $data['date_appoint'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ชื่อผู้ตรวจ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <select class="form-control" <?= ($isService) ? 'name="officer_id"' : 'readonly' ?> >
                                            <option></option>
                                            <?php
                                            foreach ($meter_staff['items'] as $m) { ?>
                                                <option value="<?= $m['meter_staff_id'] ?? '' ?>" <?= (isset($m['meter_staff_id'], $data['officer_id']) && $m['meter_staff_id'] == $data['officer_id']) ? 'selected' : '' ?>>
                                                    <?= $m['meter_staff_name'] ?? '' ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <label for="fort_cable"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลขฟอร์ต
                                        สาย:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="fort_cable"' : 'readonly' ?>
                                               maxlength="10"
                                               value="<?= $data['fort_cable'] ?? '' ?>"/>
                                    </div>
                                    <label for="fort_no"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลข:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="fort_no"' : 'readonly' ?>
                                               maxlength="10"
                                               value="<?= $data['fort_no'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผลการตรวจ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <select class="form-control" <?= ($isService) ? 'name="meter_qc_id"' : 'readonly' ?> >
                                            <?php
                                            foreach ($meter_qc['items'] as $m) { ?>
                                                <option value="<?= $m['meter_qc_id'] ?? '' ?>" <?= (isset($m['meter_qc_id'], $data['meter_qc_id']) && $m['meter_qc_id'] == $data['meter_qc_id']) ? 'selected' : '' ?>>
                                                    <?= $m['meter_qc_detail'] ?? '' ?>
                                                </option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ชำระเงินค่ามิเตอร์:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date"
                                               class="form-control" <?= ($isService) ? 'name="date_payment"' : 'readonly' ?>
                                               value="<?= $data['date_payment'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผบค/ผบต
                                        ส่งงาน:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date"
                                                   class="form-control" <?= ($isService) ? 'name="date_install"' : '' ?>
                                                   value="<?= $data['date_install'] ?? '' ?>" readonly/>
                                            <?php
                                            if ($isService) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="date_install">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="date_install">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"
                                            style="font-weight: 900; color: red;">จำนวนเงินที่ชำระ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="number"
                                               class="form-control" <?= ($isService) ? 'name="payment_value"' : 'readonly' ?>
                                               value="<?= $data['payment_value'] ?? '' ?>"
                                               step="0.01"/>
                                    </div>
                                    <?php
                                    if ($uploaded_image_path) { ?>
                                        <span class="col-xl-4 col-lg-6 col-md-12 col-sm-12 form-text text-success">หลักฐานการชำระเงินจากลูกค้า:<br>
                                            <a href="<?= $url_name ?>" target="_BLANK"><?= $url_name ?></a></span>
                                        <?php
                                    } ?>
                                </div>

                                <div class="form-group row">
                                    <label for="job_type_id"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ลักษณะงาน:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <select class="form-control" <?= ($isService) ? 'name="job_type_id"' : 'readonly' ?> >
                                            <option></option>
                                            <?php
                                            foreach ($job_types['items'] as $m) { ?>
                                                <option value="<?= $m['id'] ?? '' ?>" <?= (isset($m['id'], $data['job_type_id']) && $m['id'] === $data['job_type_id']) ? 'selected' : '' ?>>
                                                    <?= $m['description'] ?? '' ?>
                                                </option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">สาเหตุ:</label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="cause"' : 'readonly' ?>
                                               value="<?= $data['cause'] ?? '' ?>"/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ขยายเขต:</label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isService) ? 'name="cause1"' : 'readonly' ?>
                                               value="<?= $data['cause1'] ?? '' ?>"/>
                                    </div>
                                </div>


                                <hr/>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">3. แผนกมิเตอร์</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_workorder"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ใบสั่งจ้างประจำวันที่:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date" class="form-control"
                                               value="<?= $data['date_workorder'] ?? '' ?>" <?= ($isMeter) ? 'name="date_workorder"' : 'readonly' ?>/>
                                    </div>
                                    <label for="due_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ครบกำหนดส่งงาน:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date" class="form-control"
                                               value="<?= $data['due_date'] ?? '' ?>" <?= ($isMeter) ? 'name="due_date"' : 'readonly' ?>/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meter_comment"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเหตุ:</label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <input type="text"
                                               class="form-control" <?= ($isMeter) ? 'name="meter_comment"' : 'readonly' ?>
                                               value="<?= $data['meter_comment'] ?? '' ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meter_accept_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผมต/ผบต
                                        วันรับงาน:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['meter_accept_date'] ?? '' ?>" <?= ($isMeter) ? 'name="meter_accept_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isMeter) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="meter_accept_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="meter_accept_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ติดตั้งไม่เกินวันที่:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date" class="form-control"
                                               value="<?= $data['date_deathline'] ?? '' ?>" <?= ($isMeter) ? 'name="date_deathline"' : 'readonly' ?>/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลขเครื่องวัด:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="text" class="form-control"
                                               value="<?= $data['number2'] ?? '' ?>" <?= ($isMeter) ? 'name="number2"' : 'readonly' ?>/>
                                    </div>
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">วันที่ติดตั้ง แล้วเสร็จ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <input type="date" class="form-control"
                                               value="<?= $data['date_finish'] ?? '' ?>" <?= ($isMeter) ? 'name="date_finish"' : 'readonly' ?>/>
                                    </div>
                                    <label for="meter_send_check_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผมต/ผบต
                                        ส่งตรวจสอบหน่วย:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['meter_send_check_date'] ?? '' ?>" <?= ($isMeter) ? 'name="meter_send_check_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isMeter) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="meter_send_check_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="meter_send_check_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <label for="meter_reject_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผมต/ผบต
                                        รับคืนงานตรวจสอบ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['meter_reject_date'] ?? '' ?>" <?= ($isMeter) ? 'name="meter_reject_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isMeter) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="meter_reject_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="meter_reject_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <label for="meter_store_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผมต/ผบต
                                        ส่งงานจัดเก็บ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['meter_store_date'] ?? '' ?>" <?= ($isMeter) ? 'name="meter_store_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isMeter) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="meter_store_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="meter_store_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>


                                <hr/>
                                <div class="form-group row">
                                    <label for="example-text-input"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">4. แผนกบัญชี และแผนกบริหารงานทั่วไป</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="account_receive_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผบป/ผบง
                                        รับงานตรวจสอบหน่วย:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['account_receive_date'] ?? '' ?>" <?= ($isAccounting) ? 'name="account_receive_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isAccounting) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="account_receive_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="account_receive_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <label for="account_reject_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผบป/ผบง
                                        ส่งคืนงานตรวจสอบ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['account_reject_date'] ?? '' ?>" <?= ($isAccounting) ? 'name="account_reject_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isAccounting) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="account_reject_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="account_reject_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <label for="account_accept_date"
                                           class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label">ผบห/ผบง
                                        รับงานจัดเก็บ:</label>
                                    <div class="col-xl-3 col-lg-4 col-md-10 col-sm-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                   value="<?= $data['account_accept_date'] ?? '' ?>" <?= ($isAccounting) ? 'name="account_accept_date"' : '' ?>
                                                   readonly/>
                                            <?php
                                            if ($isAccounting) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning clear-today-button" type="button"
                                                            update_target="account_accept_date">ยกเลิก
                                                    </button>
                                                    <button class="btn btn-primary today-button" type="button"
                                                            update_target="account_accept_date">วันนี้
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>


                                <hr/>
                                <div class="form-group row">
                                    <label
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
                                    <div class="col-xl-11 col-lg-10 col-md-10 col-sm-8">
                                        <button type="submit" class="btn btn-primary"><i class="la la-save"></i>
                                            บันทึกข้อมูล
                                        </button>
                                        <?php
                                        if ($auto_id && $token) { ?>
                                            <a href="javascript:window.location.href=window.location.href"
                                               class="btn btn-success"><i class="la la-refresh"></i> คืนค่าตั้งต้น</a>
                                            <a href="/meter/" class="btn btn-warning" target="_BLANK"><i class="la la-plus"></i> เพิ่มข้อมูลใหม่</a>

                                            <a class="btn btn-primary" target="_BLANK" href="/pdf/?id=<?php
                                            echo $auto_id; ?>&token=<?php
                                            echo $token; ?>"><i class="la la-print"></i> พิมพ์แบบฟอร์ม</a>

                                            <?php
                                        } ?>
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

        $(document).on('click', '.clear-today-button', function () {
            const update_target = $(this).attr('update_target');
            const date_finish = $('input[name="' + update_target + '"]');
            date_finish.val('');
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