@extends('layouts.app')
@section('document_administratif')
    active
@endsection
@section('document_administratif_block')
    style="display: block;"
@endsection
@section('page')
    <link rel="stylesheet" href="{{ asset("css/jquery.fileupload.css") }}">

<div class="row">
    <div class="col-sm-4">
        <div class="container">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Ajouter des fichiers ...</span>
                <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
            <br>
            <br>
            <!-- The global progress bar -->
            <div id="progress" class="progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <!-- The container for the uploaded files -->
            <div id="files" class="files"></div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Instruction</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>La taille maximum est de <strong>999 KB</strong></li>
                        <li>Seul les images et les fichiers pdf (<strong>JPG, GIF, PNG, PDF </strong>) sont autorisés</li>
                        <li>Vous pouvez faire <strong>glisser et déposer</strong> des fichiers de votre bureau sur cette page Web</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="{{  URL::asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{  URL::asset("js/jquery.ui.widget.js") }}"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->


    <script src="{{  URL::asset("js/jquery.iframe-transport.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-process.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-image.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-audio.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-video.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-validate.js") }}"></script>

    <script>
        /*jslint unparam: true, regexp: true */
        /*global window, $ */
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = window.location.hostname === 'blueimp.github.io' ?
                            '//jquery-file-upload.appspot.com/' : 'server/php/',
                    uploadButton = $('<button/>')
                            .addClass('btn btn-primary')
                            .prop('disabled', true)
                            .text('Processing...')
                            .on('click', function () {
                                var $this = $(this),
                                        data = $this.data();
                                $this
                                        .off('click')
                                        .text('Abort')
                                        .on('click', function () {
                                            $this.remove();
                                            data.abort();
                                        });
                                data.submit().always(function () {
                                    $this.remove();
                                });
                            });
            $('#fileupload').fileupload({
                url: "{{route('import_fichier')}}",
                dataType: 'json',
                autoUpload: true,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,
                maxFileSize: 999000,
                // Enable image resizing, except for Android and Opera,
                // which actually support image resizing, but fail to
                // send Blob objects via XHR requests:
                disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                previewMaxWidth: 100,
                previewMaxHeight: 100,
                previewCrop: true
            }).on('fileuploadadd', function (e, data) {
                data.context = $('<div/>').appendTo('#files');
                $.each(data.files, function (index, file) {
                    var node = $('<p/>')
                            .append($('<span/>').text(file.name));
                    if (!index) {
                        node
                                .append('<br>')
                                .append(uploadButton.clone(true).data(data));
                    }
                    node.appendTo(data.context);
                });
            }).on('fileuploadprocessalways', function (e, data) {
                var index = data.index,
                        file = data.files[index],
                        node = $(data.context.children()[index]);
                if (file.preview) {
                    node
                            .prepend('<br>')
                            .prepend(file.preview);
                }
                if (file.error) {
                    node
                            .append('<br>')
                            .append($('<span class="text-danger"/>').text(file.error));
                }
                if (index + 1 === data.files.length) {
                    data.context.find('button')
                            .text('Envoyer sur le serveur')
                            .prop('disabled', !!data.files.error);
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            }).on('fileuploaddone', function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.url) {
                        var link = $('<a>')
                                .attr('target', '_blank')
                                .prop('href', file.url);
                        $(data.context.children()[index])
                                .wrap(link);
                    } else if (file.error) {
                        var error = $('<span class="text-danger"/>').text(file.error);
                        $(data.context.children()[index])
                                .append('<br>')
                                .append(error);
                    }
                });
            }).on('fileuploadfail', function (e, data) {
                $.each(data.files, function (index) {
                    var error = $('<span class="text-danger"/>').text('File upload failed.');
                    $(data.context.children()[index])
                            .append('<br>')
                            .append(error);
                });
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>

@endsection