<h2>Popular Media</h2>

<ul class="media_list">
<?php foreach( $media as $m ): ?>
<li><a href="?example=media.php&media=<?php echo $m->getId() ?>"><img src="<?php echo $m->getThumbnail()->url ?>"><?php if( $m->getType() == 'video' ): ?><img src="public/images/play.png" class="play"><?php endif; ?></a></li>
<?php endforeach; ?>
</ul>