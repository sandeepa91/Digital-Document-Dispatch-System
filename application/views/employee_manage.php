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
                    <h2><span class="fa fa-user"></span> Create Employee</h2>
                    <ol class="breadcrumb">
                        <li>
                            Administrator
                        </li>
                        <li class="active">
                            <strong>Create Employee</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Create Employee Wizard -
                                    <small>Enter the details of the Employee you want to create</small>
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
                                <form name="create_jurnal" method="post" id="add_cad_user" class="form-horizontal"
                                      action="<?= base_url('/index.php/Users/add_new_employee') ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Title</label>

                                                <div class="col-sm-9">
                                                    <select name="title" class="chosen-select form-control">
                                                                 
                                                            <option value="Mr."> Mr.</option>
                                                            <option value="Mrs."> Mrs.</option>
                                                            <option value="Miss."> Miss.</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Employee Name</label>

                                                <div class="col-sm-9">
                                                    <input name="EmployeeName" required="" type="text" class="form-control"
                                                           placeholder="Employee Name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Location </label>
                                                
                                                <div class="col-sm-9">
                                                    <select name="locationid" class="chosen-select form-control">
                                                                 
                                                            <?php
                                                                foreach ($locations as $location):
                                                                    ?>
                                                            <option
                                                                value="<?= $location->LocationId ?>"><?= $location->LocationName ?></option>

                                                            <?php
                                                        endforeach;
                                                        ?>
                                                            
                                                    </select>
                                                </div>
                                            </div> 
                                                                                       
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Employee Number</label>

                                                <div class="col-sm-9">
                                                    <input name="EmployeeNumber" required="" type="text" class="form-control"
                                                           placeholder="Employee Number">
                                                </div>
                                            </div> 
                                             <div class="form-group">
                                                <label class="col-sm-3 control-label">Designation</label>

                                                <div class="col-sm-9">
                                                    <select name="designation" class="chosen-select form-control">
                                                                 
                                                            <option value="Super"> Super</option>
                                                            <option value="Manage"> Divisional Head</option>
                                                            <option value="operation"> Data Entry</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Board Grade</label>

                                                <div class="col-sm-9">
                                                    <select name="boadgrade" class="chosen-select form-control">
                                                            <option value="I"> I</option>     
                                                            <option value="II"> II</option>
                                                            <option value="III">III </option>
                                                            <option value="IV"> IV</option>
                                                            <option value="V"> V</option>
                                                            <option value="VI"> VI</option>
                                                            <option value="VII"> VII</option>
                                                            <option value="VIII"> VIII </option>
                                                            <option value="IX"> IX </option>
                                                            <option value="X"> X </option>
                                                            <option value="XI"> XI </option>
                                                            
                                                    </select>
                                                </div>
                                            </div> 
                                            
                                             
                                             
                                            <div class="form-group">
                                                <div class="col-sm-12 ">
                                                    <button class="btn btn-success pull-right" type="submit">Create <span
                                                            class="fa fa-plus"></span></button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </form>
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
