<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

@require('config.php');
@require('class/user.php');

$user = new User();
$result = $user->authentication();

@require('class/meter.php');

$meter = new _Meter();

if (isset($_POST['auto_id'], $_POST['token'])) {
    $result = $meter->updateMeter($_POST);
    if (!$result['auto_id']) {
        print_r($result);
        exit;
    }
    header('location: /meter/admin.php');
}

$meter_category = $meter->getMeterCategory();
$meter_staff = $meter->getMeterStaff();
$meter_qc = $meter->getMeterQC();
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../theme/default/demo1/dist/"/>
    <meta charset="utf-8"/>
    <title>(ADMIN) ระบบบันทึกข้อมูล ติดตั้งมิเตอร์</title>
    <meta name="description" content="Column search datatables examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->


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

    <link href="assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-table/bootstrap-table-sticky-header.css" rel="stylesheet" type="text/css"/>

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
    <style>
        div.filter-control input.form-control {
            padding: 0.2rem;
            font-size: inherit;
        }

        div.filter-control select.form-control {
            padding: 0.2rem;
            font-size: inherit;
        }

        table th.highlight {
            background-color: #fff700;
        }

        .kt-portlet {
            background-color: #ddd;
        }

        .width_60 {
            width: 60px !important;
            min-width: 60px !important;
            padding: 0 !important;
        }

        .sticky-header-container {
            margin: 0 30px;
        }
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-page--loading">

<!-- begin:: Page -->

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">


        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper"
             style="padding-top: 0;">


            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <a href="/meter/admin.php" class="btn btn-success mr-1">
                                        <i class="fas fa-filter"></i>
                                        กรองข้อมูลจากคำค้น
                                    </a>
                                    <a href="/meter/export_excel.php" class="btn btn-success mr-1" data-toggle="modal"
                                       data-target="#modal_export_excel">
                                        <i class="far fa-file-excel"></i>
                                        Export EXCEL
                                    </a>
                                    <a href="/meter/login.php" class="btn btn-danger mr-1">
                                        <i class="la la-sign-out"></i>
                                        ออกจากระบบ
                                    </a>
                                    <?php
                                    if ($user->can(['admin', 'service'])) { ?>
                                        <a href="/meter/detail.php" target="_BLANK" class="btn btn-brand mr-1">
                                            <i class="la la-plus"></i>
                                            เพิ่มข้อมูล
                                        </a>
                                        <?php
                                    } ?>
                                    <?php
                                    if ($user->can(['admin', 'meter'])) { ?>
                                        <a href="/meter/job_types.php" class="btn btn-brand mr-1">
                                            <i class="la la-pencil"></i>
                                            แก้ไขราคาจ้างเหมาติดตั้งมิเตอร์
                                        </a>

                                        <!-- Button trigger modal-->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_report"><i class="la la-print"></i> พิมพ์แบบฟอร์ม</button>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <h3 style="position: absolute; font-size: 1.2rem; font-weight: 500; color: #48465b;">
                                อัพเดท/ระบบบันทึกข้อมูล
                                ติดตั้งมิเตอร์/เพิ่ม/ย้าย/เปลี่ยนประเภท</h3>
                            <!--begin: Datatable -->
                            <table class="display table table-bordered table-striped" id="table_meter"
                                   data-show-export="true"
                                   data-ajax="ajaxRequest"
                                   data-side-pagination="server"
                                   data-show-columns="true"
                                   data-show-multi-sort="true"
                                   data-sort-priority='[{"sortName": "auto_id","sortOrder":"desc"},{"sortName":"date_add","sortOrder":"desc"}]'
                                   data-pagination="true"
                                   data-filter="true"
                                   data-remember-order="true"
                                   data-filter-control="true"
                                   data-show-search-clear-button="true"
                                   data-state-save="true"
                                   data-state-save-id-table="table_meter"
                                   data-cookie="true"
                                   data-cookie-expire="1m"
                                   data-cookie-id-table="table_meter">
                                <thead>
                                <tr>
                                    <th data-formatter="actionButton" data-switchable="false" class="width_60"></th>
                                    <th data-field="auto_id" data-filter-control="input" data-sortable="true">
                                        เลขคำร้อง
                                    </th>
                                    <th data-field="number1" data-filter-control="input" data-sortable="true">
                                        หมายเลขผู้ใช้ไฟ
                                    </th>
                                    <th data-field="date_add" data-sortable="true" data-filter-control="datepicker"
                                        data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "dateFormat": "yyyy-mm-dd"}'>
                                        วันที่ยื่นคำร้อง
                                    </th>
                                    <th data-field="fname" data-filter-control="input" data-sortable="true">ชื่อ
                                        นามสกุล
                                    </th>
                                    <th data-field="telephone" data-filter-control="input" data-sortable="true">
                                        เบอร์โทรศัพท์
                                    </th>
                                    <th data-field="meter_category_id" data-sortable="true" data-filter-control="select"
                                        data-filter-data="var:meter_category_list"
                                        data-formatter="meter_category_detail">ประเภทคำร้อง
                                    </th>
                                    <th data-field="meter_size_detail" data-filter-control="input" data-sortable="true">
                                        ขนาดมิเตอร์
                                    </th>
                                    <th data-field="recipient_id" data-sortable="true" data-filter-control="select"
                                        data-filter-data="var:employees" data-formatter="recipient_name">ชื่อผู้รับ
                                    </th>
                                    <th data-field="date_appoint" data-sortable="true" data-filter-control="datepicker"
                                        data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "dateFormat": "yyyy-mm-dd"}'>
                                        วันนัดตรวจ
                                    </th>
                                    <th data-field="officer_id" data-sortable="true" data-filter-control="select"
                                        data-filter-data="var:employees" data-formatter="officer_name">ชื่อผู้ตรวจ
                                    </th>
                                    <th data-field="meter_qc_id" data-sortable="true" data-filter-control="select"
                                        data-filter-data="var:meter_qc_list" data-formatter="meter_qc_detail">ผลการตรวจ
                                    </th>
                                    <th data-field="cause" data-sortable="true" data-filter-control="input">
                                        สาเหตุที่ต้องแก้ไข
                                    </th>
                                    <th data-field="date_payment" data-sortable="true" data-filter-control="datepicker"
                                        data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "dateFormat": "yyyy-mm-dd"}'>
                                        วันที่ชำระเงินค่ามิเตอร์
                                    </th>
                                    <th data-field="cause1" data-filter-control="input" data-sortable="true">ขยายเขต
                                    </th>
                                    <th data-field="date_install" data-sortable="true" data-filter-control="datepicker"
                                        data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "dateFormat": "yyyy-mm-dd"}'>
                                        วันส่งงานติดตั้ง
                                    </th>
                                    <th data-field="date_deathline" data-sortable="true"
                                        data-filter-control="datepicker"
                                        data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "dateFormat": "yyyy-mm-dd"}'>
                                        ติดตั้งไม่เกินวันที่
                                    </th>
                                    <th data-field="number2" data-filter-control="input" data-sortable="true">
                                        หมายเลขเครื่องวัด
                                    </th>
                                    <th data-field="date_finish" data-sortable="true" data-filter-control="datepicker"
                                        data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "dateFormat": "yyyy-mm-dd"}'>
                                        วันที่ติดตั้ง แล้วเสร็จ
                                    </th>
                                </tr>
                                </thead>
                            </table>
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
<div class="modal fade" id="modal_export_excel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export EXCEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="/meter/export_excel.php" method="POST">
                <div class="modal-body">
                    <label><b>ช่วงเวลาที่แสดงผลข้อมูล:</b></label>
                    <div class='input-group' id='kt_daterangepicker_1'>
                        <input type="text" name="date_range" class="form-control" placeholder="เลือกช่วงวันที่เอกสาร"
                               value="<?php
                               echo date("Y-01-01") . " | " . date("Y-m-d"); ?>"/>
                        <div class="input-group-append"><span class="input-group-text"><i
                                        class="la la-calendar-check-o"></i></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                    <button type="submit" class="btn btn-primary"><i class="far fa-file-excel"></i> Export ข้อมูล
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="/meter/report.php" method="POST" target="_blank">
                <div class="modal-body">
                    <label><b>ช่วงเวลาที่แสดงผลข้อมูล:</b></label>
                    <div class='input-group' id='kt_daterangepicker_2'>
                        <input type="text" name="date_range" class="form-control" placeholder="เลือกช่วงวันที่เอกสาร"
                               value="<?php
                               echo date("Y-01-01") . " to " . date("Y-m-d"); ?>"/>
                        <div class="input-group-append"><span class="input-group-text"><i
                                        class="la la-calendar-check-o"></i></span></div>
                    </div>
                    <label style="margin-top: 20px;"><b>ประเภทรายงาน:</b></label>
                    <div class='input-group'>
                        <select class="form-control" name="form_name">
                            <option value="replacement_report">สรุปจ้างติดตั้งรายเดือน</option>
                            <option value="replacement_report">พิมพ์ใบสั่งจ้างสับเปลี่ยน</option>
                            <option value="replacement_report">สรุปจ้างสับเปลี่ยนรายเดือน</option>
                            <option value="replacement_report">พิมพ์กระบวนงาน P3</option>
                        </select>
                    </div>
                    <label style="margin-top: 20px;"><b>ผู้รับจ้าง:</b></label>
                    <div class='input-group'>
                        <select class="form-control" name="meter_staff_id">
                            <?php foreach ($meter_staff['items'] as $m) { ?>
                                <option value="<?= $m['meter_staff_id'] ?>"><?= $m['meter_staff_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                    <button type="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> แสดงรายงาน
                    </button>
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
<script src="assets/plugins/bootstrap-table/bootstrap-table-sticky-header.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-table/bootstrap-table-multiple-sort.js"></script>
<script src="assets/plugins/bootstrap-table/bootstrap-table-filter-control.min.js"></script>
<script src="assets/plugins/bootstrap-table/bootstrap-table-cookie.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->

<script>

    function actionButton(value, row) {
        return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" target="_BLANK" href="/meter/detail.php?auto_id=' + row.auto_id + '&token=' + row.token + '"><i class="la la-pencil"></i></a>';
        //<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="deleteMeter(this)" auto_id="' + row.auto_id + '" token="' + row.token + '"><i class="fas fa-trash"></i></button>
    }

    function recipient_name(value, row) {
        return row.recipient_name;
    }

    function officer_name(value, row) {
        return row.officer_name;
    }

    function meter_qc_detail(value, row) {
        return row.meter_qc_detail;
    }

    function meter_category_detail(value, row) {
        return row.meter_category_detail;
    }


    function loadModalAJAX(e) {
        var url = $(e).attr('url');

        $.ajax({
            url: url,
            type: 'post',
            success: function (response) {
                // Add response in Modal body
                $('#kt_modal_4_2').html(response);

                // Display Modal
                $('#kt_modal_4_2').modal('show');
            }
        });
    }

    function ajaxRequest(params) {
        $.ajax({
            type: "POST",
            url: "/meter/json_admin.php",
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

    function deleteMeter(e) {
        var r = confirm("ยืนยันที่จะลบข้อมูลหรือไม่?");
        if (r == true) {
            var posting = $.post('/meter/json_deleteMeter.php', {
                auto_id: $(e).attr('auto_id'),
                token: $(e).attr('token')
            });
            posting.done(function (data) {
                if (typeof data != 'undefined' && data != null) {
                    if (typeof data.success != 'undefined' && data.success != null && data.success == 1) {
                        $('#table_meter').bootstrapTable('refresh');
                    } else {
                        if (typeof data.error != 'undefined') {
                            $('.alert-danger').html(data.error);
                        }
                        $('.alert-danger').show();
                    }
                }
            });
        }
    }

    <?php
    $meter_category_list = array();
    foreach ($meter_category['items'] as $m) {
        $meter_category_list[$m['meter_category_id']] = $m['meter_category_detail'];
    }
    $employees = array();
    foreach ($meter_staff['items'] as $m) {
        $employees[$m['meter_staff_id']] = $m['meter_staff_name'];
    }
    $meter_qc_list = array();
    foreach ($meter_qc['items'] as $m) {
        $meter_qc_list[$m['meter_qc_id']] = $m['meter_qc_detail'];
    }
    ?>
    var meter_category_list = <?php echo json_encode($meter_category_list); ?>;
    var employees = <?php echo json_encode($employees); ?>;
    var meter_qc_list = <?php echo json_encode($meter_qc_list); ?>;

    $.fn.datepicker.defaults.format = "yyyy-mm-dd";

    $(function () {

        $('#table_meter').bootstrapTable({
            stickyHeader: true,
            onPostHeader: function () {
                $("input.search-input").each(function (i) {
                    if ($(this).val()) {
                        $(this).closest("th").addClass("highlight");
                    } else {
                        $(this).closest("th").removeClass("highlight");
                    }
                });
                $.fn.datepicker.defaults.format = "yyyy-mm-dd";
            }
        });


        //var start = moment().subtract(29, 'days');
        var start = moment().startOf('year');
        //var end = moment();
        var end = moment();

        $('#kt_daterangepicker_1').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, function (start, end, label) {
            $('#kt_daterangepicker_1 .form-control').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });

        $('#kt_daterangepicker_2').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, function (start, end, label) {
            $('#kt_daterangepicker_2 .form-control').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });

    });
</script>
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>