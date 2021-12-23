<input type="hidden" name="cur_page" value="<?php echo $cur_page; ?>">
<input type="hidden" name="per_page" value="<?php echo $per_page; ?>">


<div class="grid">
	<div class="grid-sizer"></div>
	<div class="gutter-sizer"></div>

	<?php foreach($items as $item) : ?>	
	<div class="grid-item item" itemid="<?php echo $item['id']; ?>" order="<?php echo $item['sort_order']; ?>">
	
		<?php if($this->session->userdata('logged_in') && $this->session->userdata('is_admin')) : ?>            
		<div class="action">
			<a href="<?php echo site_url('/items/edit/'.$item['id']); ?>">edit</a> | 
			<a class="del" href="<?php echo site_url('/items/delete/'.$item['id']); ?>">delete</a>
		</div>
		<?php endif; ?>

		<img src="<?php echo site_url(); ?>assets/images/items/<?php echo $item['item_image']; ?>">
		<div class="title"><?php echo word_limiter($item['title'], 80); ?></div>			
	
	</div>
	<?php endforeach; ?>

</div>

<div class="pagination-links">
	<?php echo $links; ?>
</div>
