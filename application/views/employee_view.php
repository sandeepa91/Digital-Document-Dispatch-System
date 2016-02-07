<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $this->load->view('partial/header'); ?>
<!-- Data Tables -->
<link href="<?php echo base_url('assets'); ?>/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/datapicker/datepicker3.css" rel="stylesheet">


</head>
<body>

    <div id="wrapper">
        <?php $this->load->view('partial/super_user_navigation'); ?>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">

                <?php $this->load->view('partial/top_bar'); ?>

            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><span class="fa fa-user"></span> System User</h2>
                    <ol class="breadcrumb">
                        <li>
                            Administrator
                        </li>
                        <li class="active">
                            <strong>System User</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Manage Employee
                                <small>Manage Employee on the system</small>
                            </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Employee Number</th>
                                    <th style="width: 150px">Location Id</th>
                                    <th style="width: 150px">Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <td><?= $employee->EmployeeName ?> </td>
                                        <td><?= $employee->Designation ?> </td>
                                        <td><?= $employee->EmployeeNumber ?></td>
                                        <td><?= $employee->LocationId ?></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-sm btn-default btn-outline view"
                                                        data-journal-id="<?= $employee->EmpId ?>">View
                                                </button>
                                                <a href="<?php echo base_url() ?>index.php/Users/edit_Employee/<?= $employee->EmpId ?>" target="_blank">
                                                    <button class="btn btn-sm btn-success"
                                                            data-journal-id="<?= $employee->EmpId ?>"> Edit
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


    <?php $this->load->view('partial/common_js'); ?>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('assets'); ?>/js/inspinia.js"></script>
    <script src="<?php echo base_url('assets'); ?>/js/plugins/pace/pace.min.js"></script>

    <script src="<?php echo base_url('assets'); ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#submition_date .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            $('#camera_ready_date .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            $('#publish_date .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
</body>
</html>
