<?php echo validation_errors(); ?>

<a class="back" href="/">< Back</a>
<?php echo form_open_multipart('items/create'); ?>
<fieldset>
    <legend>Add Item</legend> 
	<div class="form-group">
		<label class="form-label mt-2">Title</label>
		<input type="text" name="title" class="form-control" placeholder="Enter Title">
	</div>
	<div class="form-group mt-2">
		<label>Upload Image</label>
		<input type="file" multiple name="files[]" size="20" required>
		<br/><small id="emailHelp" class="form-text text-muted">supports multiple files</small>
    </div>
	<button type="submit" class="btn btn-primary mt-2">Submit</button>
</fieldset>
<?php echo form_close(); ?>