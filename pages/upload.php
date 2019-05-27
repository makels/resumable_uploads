<?php global $app; ?>
<script src="assets/js/resumable.js"></script>
<script src="assets/js/app.js"></script>
<div class="page">
    <h2>Uploads</h2>
    <div class="page-inner">
        <h3>You uploaded files:</h3>
        <div id="files_cnt"><?php $app->renderFiles(); ?></div>
        <div class="upload-cnt">
            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored upload-btn" id="upload_btn">
                <i class="mdi mdi-upload"></i>
            </button>
            <h3>Select file to upload (max file size 3 Gb)</h3>
        </div>
    </div>

    <dialog id="delete_confirm" class="mdl-dialog">
        <div class="mdl-dialog__content">
            <p>Are you sure to delete file ?</p>
        </div>
        <div class="mdl-dialog__actions mdl-dialog__actions mdl-di">
            <button type="button" id="btn-start" class="mdl-button" onclick="app.delete();"><i class="mdi mdi-delete"></i>&nbsp;Delete</button>
            <button type="button" class="mdl-button close"><i class="mdi mdi-close"></i>&nbsp;Cancel</button>
        </div>
    </dialog>

    <dialog class="mdl-dialog" id="upload_dialog">
        <div class="mdl-dialog__content">
            <p id="file-name">Upload file:</p>
            <div id="p1" class="mdl-progress mdl-js-progress"></div>
            <div id="percent">Progress: 0%</div>
        </div>
        <div class="mdl-dialog__actions mdl-dialog__actions mdl-di">
            <button type="button" id="btn-pause" class="mdl-button pause" onclick="app.pauseUpload();"><i class="mdi mdi-pause"></i>&nbsp;Pause</button>
            <button type="button" class="mdl-button close"><i class="mdi mdi-close"></i>&nbsp;Cancel</button>
        </div>
    </dialog>
</div>
