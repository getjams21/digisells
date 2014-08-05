
<div class="form-group txtbox-m ">
<div class="input-group">
    <span class="input-group-btn">
        <span class="btn btn-primary btn-file">
            Browse&hellip; <input name="fileUpload" type="file" id="fileUpload">
        </span>
    </span>
    <input type="text" id="fileName" class="form-control">
</div>
<div class="alert alert-danger validateImage" role="alert">
    <p><span class="glyphicon glyphicon-warning-sign"></span></font>&nbsp Minimum Price must <br>NOT be '0' or EMPTY!</p>
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
</div>
   