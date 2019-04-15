<h2>Scan OCR</h2>

<form id="ocr_form" action="<?php echo site_url('scanocr/process'); ?>" method="POST" enctype="multipart/form-data" >

    <div class="form-group">
        <label for="">File to Scan</label>
        <input type="file" name="file" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Content</label>
        <textarea name="content" class="form-control" rows="5"><?php echo $ocr_content; ?></textarea>
    </div>

    <div class="form-group">
        <label for="">Summary</label>
        <textarea name="summary" class="form-control" rows="5"></textarea>
    </div>

    <div class="form-group">
        <input id="action" type="hidden" name="action" value="preview" />
        <button id="preview" type="button" class="btn btn-secondary">Preview</button>
        <button id="save" type="button" class="btn btn-primary">Submit</button>
    </div>

</form>