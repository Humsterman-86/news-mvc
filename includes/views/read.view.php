<?php require_once(VIEW_PATH.'header.inc.php'); ?>

	<h3><?php echo $article->title; ?></h3>
	
	<p>
		<?php echo $article->content; ?>
		<?php echo $article->date; ?><br />
			
		<a href="update.php?id=<?php echo $article->id; ?>">Update</a>
		<a href="delete.php?id=<?php echo $article->id; ?>" 
			onClick = "javascript: return confirm('Delete?');">Delete</a>
	</p>

<?php require_once(VIEW_PATH.'footer.inc.php'); ?>