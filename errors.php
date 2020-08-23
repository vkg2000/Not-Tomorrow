<?php if(count($errors)>0) : ?>

	<div>
		
		<?php foreach ($errors as $error) : ?>
			<p><i><strong><?php echo $error ?> </strong></i></p>
		<?php endforeach ?>

	</div>
<?php endif ?>
