<h2>Upload & Compress Image</h2>

<form id="ocr_form" action="<?php echo site_url('imagemanipulation/process'); ?>" method="POST" enctype="multipart/form-data" >

    <div class="form-group">
        <label for="">File to Compress</label>
        <input type="file" name="file" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>