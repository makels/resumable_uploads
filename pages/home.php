<div class="page">
    <h2>Resumable files upload</h2>
    <div class="page-inner">
        <h3>1. How to use</h3>
        <p>Click <a href="index.php?route=upload">Upload</a> and select file to upload</p>
        <p>After upload you can see file with size</p>
        <h3>Java Script (app.js)</h3>
        <pre lang="php" escaped="true">$(function() { app.init(); });

var App = function() {

    this.progress = 0;

    this.filename = null;

    this.resumable = null;

    this.init = function() {
        var scope = this;
        this.resumable = new Resumable({
            target: 'upload.php',
            testChunks: true
        });

        this.resumable.assignBrowse(document.getElementById('upload_btn'));

        this.dialog = $('#upload_dialog')[0];
        this.confirm = $('#delete_confirm')[0];
        $('#upload_dialog .close').on('click', function() {
            if(scope.resumable.isUploading()) scope.resumable.stop();
            scope.dialog.close();
        });

        $('#delete_confirm .close').on('click', function() {
            scope.confirm.close();
        });

        $("#p1").on('mdl-componentupgraded', function() {
            this.MaterialProgress.setProgress(scope.progress);
        });

        this.resumable.on('fileAdded', function(file, event){
            scope.startUpload(file);
        });

        this.resumable.on('fileSuccess', function(file, message){
            scope.finishUpload();
        });

        this.resumable.on('progress', function(){
            scope.setProgress(scope.resumable.progress()*100);
        });
    }

    this.deleteShow = function(filename) {
        this.filename = filename;
        this.confirm.showModal();
    }

    this.delete = function() {
        $.ajax({
            type: 'post',
            data: {
                action: 'delete',
                file: this.filename
            },
            success: function(files_cnt) {
                $('#files_cnt').html(files_cnt);
            }
        });
        this.confirm.close();
    }

    this.startUpload = function(file) {
        this.showUpload();
        $('#file-name').html('File: <b>' + file.fileName + '</b>');
        this.resumable.upload();
    }

    this.pauseUpload = function() {
        if (this.resumable.files.length>0) {
            if (this.resumable.isUploading()) {
                this.resumable.pause();
            } else {
                this.resumable.upload();
            }
        }
        $('#btn-pause').html(!this.resumable.isUploading() ? '<i class="mdi mdi-play"></i>&nbsp;Continue' : '<i class="mdi mdi-pause"></i>&nbsp;Pause');
    }

    this.finishUpload = function() {
        this.hideUpload();
        $.ajax({
            type: 'post',
            data: {
                action: 'update',
            },
            success: function(files_cnt) {
                $('#files_cnt').html(files_cnt);
            }
        });
    }


    this.showUpload = function() {
        this.progress = 0;
        $('#p1').hide();
        $('#percent').hide();
        $('#btn-pause').show();
        this.dialog.showModal();
        $("#p1").trigger('mdl-componentupgraded');
    }

    this.hideUpload = function() {
        this.dialog.close();
    }

    this.setProgress = function(progress) {
        this.progress = Number(progress.toFixed(1));
        $('#p1').show();
        $('#percent').show();
        $('#percent').html('Progress: ' + this.progress + '%');
        $("#p1").trigger('mdl-componentupgraded');
    }

}

var app = new App();</pre>
        <h3>PHP script (upload.php)</h3>
        <pre lang="php" escaped="true">define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('SITE_PATH', realpath(dirname(__FILE__)) . DIRSEP);
define("CLASSES_DIR", SITE_PATH . "classes" .DIRSEP);
define("UPLOADS_DIR", SITE_PATH . "uploads" .DIRSEP);
define("TEMP_DIR", SITE_PATH . "tmp" .DIRSEP);

require_once SITE_PATH . "vendor/autoload.php";

use Dilab\Network\SimpleRequest;
use Dilab\Network\SimpleResponse;
use Dilab\Resumable;

$request = new SimpleRequest();
$response = new SimpleResponse();

$resumable = new Resumable($request, $response);
$resumable->tempFolder = TEMP_DIR;
$resumable->uploadFolder = UPLOADS_DIR;
$resumable->process();</pre>
    </div>
</div>
