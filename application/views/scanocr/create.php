<h2>Scan OCR</h2>

<form action="<?php echo site_url('scanocr/preview'); ?>" method="POST" enctype="multipart/form-data" >

    <div class="form-group">
        <label for="">File to Scan</label>
        <input type="file" name="file" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Preview</button>
    </div>

    <div class="form-group">
        <label for="">Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Content</label>
        <textarea name="content" class="form-control" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label for="">Summary</label>
        <textarea name="summary" class="form-control" rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>