<?php require_once(VIEW_PATH.'header.inc.php'); ?>

	<?php foreach($articles as $article): ?>

		<h4>
			<a href="read.php?id=<?php 
				echo $article->id;?>"><?php 
				echo $article->title;?> -
			<?php echo $article->date;?>

			</a>
		</h4>

		<p>
			<?php echo $article->content;?>
		</p>

	<?php endforeach; ?>

<?php require_once(VIEW_PATH.'footer.inc.php'); ?>