<?php echo validation_errors(); ?>

<a class="back" href="/">< Back</a>
<?php echo form_open('items/update'); ?>
<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
<fieldset>
    <legend>Edit Text Item</legend> 
	<div class="form-group">
    	<label class="form-label mt-2">Title</label>  
	  	<input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $item['title']; ?>" autofocus>
	</div>
	<button type="submit" class="btn btn-primary mt-2">Update</button>
</fieldset>
<?php echo form_close(); ?>