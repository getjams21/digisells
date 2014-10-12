
<div class="form-group ">
<div class="input-group">
    <!-- product image file upload -->
    <span class="input-group-btn">
        <span class="btn btn-primary btn-file">
            Browse&hellip; <input name="fileUpload" type="file" id="fileUpload" data-max-size="5000000">
        </span>
    </span>
    <input type="text" id="fileName" class="form-control" required>
</div>
<br>
<!-- copyright file upload-->
{{ Form::label('', 'Copyright Claims'); }}
<div class="input-group">
    <span class="input-group-btn">
        <span class="btn btn-primary btn-file">
            Browse&hellip; <input name="copyrightFileUpload" type="file" id="copyrightFileUpload">
        </span>
    </span>
    <input type="text" class="form-control" required>
</div>
<!-- validate copyright file upload -->
<div class="alert alert-danger validateCopyrightFile" role="alert">
    <center><p><span class="glyphicon glyphicon-warning-sign"></span>&nbsp Invalid file format! <br>Only accepts <br> Compressed file (.zip or .rar). <br> Please compress your files first.</p></center>
</div>
<br>
{{ Form::label('', 'Provide the Product'); }}
<div class="input-group">
    <div class="btn-group">
      <button type="button" class="btn btn-primary active" id="productUpload" data-container="body" data-toggle="popover" placement="left" data-content="Upload the Product to our server.">Upload Product</button>
      <button type="button" class="btn btn-primary" id="downloadLink" data-container="body" data-toggle="popover" placement="left" data-content="Put the download link of your product if it is being hosted on other server.">Download Link</button>
    </div>
</div>
<div class="well product-upload">
    <div class="input-group uploadProduct">
        <span class="input-group-btn">
            <span class="btn btn-primary btn-file">
                Browse&hellip; <input name="productUpload" type="file" id="productUpload">
            </span>
        </span>
        <input type="text" class="form-control" id="productFile" readonly>
    </div>
    <div class="form-group downloadLink">
        {{ Form::label('', 'Provide Product Download Link'); }}
        <input type="text" class="form-control" id="download-Link" name="DownloadLink">
    </div>
</div>
   