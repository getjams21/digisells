
<div class="form-group txtbox-m ">
<div class="input-group">
    <span class="input-group-btn">
        <span class="btn btn-primary btn-file">
            Browse&hellip; <input name="fileUpload" type="file" id="fileUpload" data-max-size="5000000">
        </span>
    </span>
    <input type="text" id="fileName" class="form-control">
</div>
<div class="alert alert-danger validateImage" role="alert">
    <center><p><span class="glyphicon glyphicon-warning-sign"></span></font>&nbsp Invalid file format! <br>Only accepts (.jpg,.png and .bmp) <br> Image file.</p></center>
</div>
<div class="alert alert-danger validateImageSize" role="alert">
    <center><p><span class="glyphicon glyphicon-warning-sign"></span></font>&nbsp File size limit exceeded! <br>Please select an Image <br> with size not higher <br> than 5MB.</p></center>
</div>
<br>
{{ Form::label('', 'Copyright Claims'); }}
<div class="input-group">
    <span class="input-group-btn">
        <span class="btn btn-primary btn-file">
            Browse&hellip; <input name="copyrightFileUpload" type="file" id="copyrightFileUpload">
        </span>
    </span>
    <input type="text" class="form-control" readonly>
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
        <input type="text" class="form-control" readonly>
    </div>
    <div class="form-group downloadLink">
        {{ Form::label('', 'Provide Product Download Link'); }}
        <input type="text" class="form-control" id="download-Link" name="DownloadLink">
    </div>
</div>
   