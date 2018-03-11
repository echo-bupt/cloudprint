<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo base_url().'plug-in/file-upload/css/jquery.fileupload-ui.css'?>">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo base_url().'plug-in/file-upload/css/jquery.fileupload-ui-noscript.css'?>"></noscript>
   <!-- The file upload form used as target for the file upload widget -->
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>添加文件...</span>
                    <input id="fileupload_add_hills" type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="hide btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>开始上传</span>
                </button>
                <button id="fileupload_cancle_hills" type="reset" class="hide btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>取消上传</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>删除</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The loading indicator is shown during file processing -->
                <span class="fileupload-loading"></span>
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            {% if (file.error) { %}
                <div><span class="label label-important">出错啦</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            {% if (!o.files.error) { %}
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            {% } %}
        </td>
        <td>
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>开始</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>取消</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnail_url) { %}
                    <img src="<?php echo base_url();?>{%=file.thumbnail_url%}">
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {%=file.name%}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-important">出错啦</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>删除</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>
<form name="file_info_for_save" id="file_info_for_save" action="<?php echo site_url('source/upload_save').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2);?>" method="POST"></form>
<!-- for save to db ,by hills -->
<script id="template-forsave" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <input type="hidden" name="file_name[]" value="{%=file.name%}" >
    <input type="hidden" name="file_dir[]" value="{%=file.url%}" >
    <input type="hidden" name="file_img_dir[]" value="{%=file.thumbnail_url%}" >
    <input type="hidden" name="file_type[]" value="{%=file.type%}" >
    <input type="hidden" name="file_size[]" value="{%=file.size%}" >
    <input type="hidden" name="file_score[]" value="{%=file.score%}" >
{% } %}

</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/tmpl.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/jquery.fileupload-process.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url().'/plug-in/file-upload/';?>js/jquery.fileupload-ui.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="<?php echo base_url().'/plug-in/file-upload/';?>js/cors/jquery.xdr-transport.js"></script><![endif]-->
<script>
/*
 * jQuery File Upload Plugin JS Example 8.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: "<?php echo site_url('/source/upload_ajax');?>"

    });
/****
** 本用户已有文件列表，现注释，用后台调出
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function (result) {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, null, {result: result});
    });
*/
});
</script>