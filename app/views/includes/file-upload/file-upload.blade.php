
<div class="form-group txtbox-m ">
<div class="input-group">
    <!-- product image file upload -->
    <span class="input-group-btn">
        <span class="btn btn-primary btn-file">
            Browse&hellip; <input name="fileUpload" type="file" id="fileUpload" data-max-size="5000000">
        </span>
    </span>
    <input type="text" id="fileName" class="form-control" required>
</div>
<!-- validate image file format -->
<div class="alert alert-danger validateImage" role="alert">
    <center><p><span class="glyphicon glyphicon-warning-sign"></span></font>&nbsp Invalid file format! <br>Only accepts (.jpg,.png and .bmp) <br> Image file.</p></center>
</div>
<!-- validate image size -->
<div class="alert alert-danger validateImageSize" role="alert">
    <center><p><span class="glyphicon glyphicon-warning-sign"></span>&nbsp File size limit exceeded! <br>Please select an Image <br> with size not higher <br> than 5MB.</p></center>
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
</div>
   