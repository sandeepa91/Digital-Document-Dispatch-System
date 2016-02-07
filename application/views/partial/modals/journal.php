<div class="modal inmodal" id="modelJournal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-book modal-icon"></i>
                <h4 class="modal-title" id="journal-name">
                    <small id="journal-name-small"></small>
                </h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="created_on">Created on: </label>
                                <input id="created_on" type="text" class="form-control disabled"
                                       value="" disabled/>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Chief Editor: </label>
                                <input id="chief-editor" disabled type="email"
                                       class="form-control disabled"
                                       value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="URL">Paper Submission URL: </label>
                                <p id="url"></p>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>