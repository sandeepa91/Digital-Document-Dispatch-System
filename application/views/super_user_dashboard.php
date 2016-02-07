<?php $this->load->view('partial/header'); ?>
<!-- Data Tables -->
<link href="<?php echo base_url('assets'); ?>/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">


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
                <h2><span class="fa fa-user"></span> Dashboard</h2>
                <ol class="breadcrumb">
                    <li>
                        Administrator
                    </li>
                    <li class="active">
                        <strong>Dashboard</strong>
                    </li>
                </ol>
            </div>
        </div>

        <?php
        if (isset($success_upload) && ($success_upload == TRUE)):
            ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                Your article submitted successfully.</a>.
            </div>
            <?php
        endif;
        ?>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content tabbable">

                        <div class="panel-heading">
                            <!--<div class="panel-title m-b-md"><h4>Blank Panel with text tabs</h4></div>-->
                            <div class="panel-options">

                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">All</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Published</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-3">Pending Reviews</a></li>

                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <!--                                All Articles Tab-->
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <?php foreach ($review_documents as $review_document): ?>

                                        <div class="media well">
                                            <div class="media-body">
                                                <div class="col-lg-8">
                                                    <div class="ibox-content">
                                                        <h3 class="media-heading">
                                                             Title :  <?=   $review_document->Content ?>
                                                        </h3>
                                                        <?php
                                                        /**
                                                         * sub_authors() and keywords() helper functions are available in the helper class 'arraystring_helper'
                                                         */
                                                        ?>
                                                        <span>Remarks : <?= $review_document->Remarks ?> </span><br/>
                                                        <span>Capture Date : <?= $review_document->CaptureDate ?> </span><br/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 pull-right">
                                                    <a href="<?php echo base_url(); ?>./uploads/FreshCopy/<?= $review_document->DocId . '.docx' ?>"
                                                       target="_blank">
                                                        <button type="button" style="margin-bottom: 10px"
                                                                class="btn btn-w-m btn-default pull-right">Download
                                                        </button>
                                                    </a>
                                                    <a href="downloads/3282E2E55115.pdf" target="_blank">
                                                        <button type="button" style="margin-bottom: 10px"
                                                                class="btn btn-w-m btn-default pull-right">View in
                                                            Document
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>

                                </div>

                                <div id="tab-2" class="tab-pane">

                                    <?php foreach ($review_documents as $review_document): ?>
                                        <?php if ($review_document->status == "assigned") { ?>
                                            <div class="media well">
                                                <div class="media-body">
                                                    <div class="col-lg-8">
                                                        <div class="ibox-content">
                                                            <h3 class="media-heading">
                                                                 Title :  <?= $review_document->Content ?>
                                                            </h3>

                                                            <span>Remarks : <?= $review_document->Remarks ?> </span><br/>
                                                            <span>Capture Date : <?= $review_document->CaptureDate ?> </span><br/>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 pull-right">
                                                        <a href="<?php echo base_url(); ?>./uploads/FreshCopy/<?= $review_document->DocId . '.docx' ?>"
                                                           target="_blank">
                                                            <button type="button" style="margin-bottom: 10px"
                                                                    class="btn btn-w-m btn-default pull-right">Download
                                                            </button>
                                                        </a>
                                                        <a href="downloads/3282E2E55115.pdf" target="_blank">
                                                            <button type="button" style="margin-bottom: 10px"
                                                                    class="btn btn-w-m btn-default pull-right">View In
                                                                Document
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php }
                                    endforeach; ?>
                                </div>

                                <div id="tab-3" class="tab-pane">
                                    <?php foreach ($review_documents as $review_document): ?>
                                        <?php if ($review_document->status == "reviewed") { ?>
                                            <div class="media well">
                                                <div class="media-body">
                                                    <div class="col-lg-8">
                                                        <div class="ibox-content">
                                                            <h3 class="media-heading">
                                                                Title :  <?= $review_document->Content ?>
                                                            </h3>

                                                            <span>Remarks : <?= $review_document->Remarks ?> </span><br/>
                                                            <span>Capture Date : <?= $review_document->CaptureDate ?> </span><br/>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 pull-right">
                                                        <a href="<?php echo base_url(); ?>./uploads/FreshCopy/<?= $review_document->DocId . '.docx' ?>"
                                                           target="_blank">
                                                            <button type="button" style="margin-bottom: 10px"
                                                                    class="btn btn-w-m btn-default pull-right">Download
                                                            </button>
                                                        </a>
                                                        <!--                                                        <a href="" target="_blank">-->
                                                        <button data-article-id="<?= $review_document->DocId ?>" type="button"
                                                                style="margin-bottom: 10px"
                                                                class="btn btn-w-m btn-default pull-right view_review">
                                                            View Review
                                                        </button>
                                                        <!--                                                        </a>-->
                                                        <a href="" target="_blank">
                                                            <button type="button" style="margin-bottom: 10px"
                                                                    class="btn btn-w-m btn-default pull-right">Submit
                                                                for Camera Ready
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php }
                                    endforeach; ?>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>


<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <i class="fa fa-pencil modal-icon fa-2x"></i>
                <h4 class="modal-title">View Reviews</h4>

            </div>
            <div class="modal-body">

                <center>
                    <div class="btn-group">
                        <a href="<?= base_url('/index.php/') ?>" id="review-btn-1"
                           class="btn btn-default" target="_blank">Review 1</a>
                        <a href="<?= base_url('/index.php/') ?>" id="review-btn-2"
                           class="btn btn-default" target="_blank">Review 2</a>
                        <a href="<?= base_url('/index.php/') ?>" id="review-btn-3"
                           class="btn btn-default" target="_blank">Review 3</a>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('partial/common_js'); ?>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets'); ?>/js/inspinia.js"></script>
<script src="<?php echo base_url('assets'); ?>/js/plugins/pace/pace.min.js"></script>


<script>
    $(document).ready(function () {
        $('.view_review').click(function (e) {
            var BASE_URL = "<?= base_url('/index.php/reviews/view/') ?>/";
            var article_id = $(this).data('article-id');
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "<?php echo base_url('/index.php/API/get_reviews'); ?>/" + article_id,
                success: function (data) {
                    $('#review-btn-1').attr("href", BASE_URL + data[0]['review_id']);
                    $('#review-btn-2').attr("href", BASE_URL + data[1]['review_id']);
                    $('#review-btn-3').attr("href", BASE_URL + data[2]['review_id']);
                }
            });
            $('#myModal').modal('show');
        });
    });
</script>

</body>
</html>
