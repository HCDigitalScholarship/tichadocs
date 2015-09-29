<!DOCTYPE html>
<html>
<head>
<?php
queue_css_file('style');
$css = "
div.content {margin-right: 10px; max-width: 350px;}
div.thumbnail {float:right;}
h1 {margin: 0; font-size: 1.5em; line-height: 1.4em;}
p {font-size: .95em; line-height: 1.3em; margin: 5px 0;}
p.post-image {margin: 3px 0; font-size: .8em; text-align: right;}
.image-thumb {max-width: 350px;}
.image-thumb img {max-width: 100%; border: 3px solid #333;}

";
queue_css_string($css);
echo head_css();
?>
<!-- Inserts Ticha Document Metadata -->
<?php $rights = metadata($item, array('Dublin Core', 'Rights')); ?>
</head>
<body>
<div style="width: 500px; padding: 5px;">
    <!-- Item Image Files -->
    <?php if (metadata('item', 'has files')): ?>
        <?php $files = $item->Files; ?>
	<div class="image-thumb">
		<a href="<?php echo file_display_url($files[0], $format = 'original'); ?>"><?php echo file_image('fullsize', array(), $files[0]); ?></a>
		<p class="post-image">(click image to see high quality files)</p>
	</div>
    <?php endif; ?>
    <div class='content'>
    <h1><a target='_blank' href="<?php echo file_display_url($files[0], $format = 'original');  ?>"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></a></h1>

        <p><strong>Type of Document: </strong><?php echo metadata('item', array('Item Type Metadata', 'Type of Document')); ?>.
	<?php
		$primary_parties = metadata('item', array('Item Type Metadata', 'Primary Parties'));
		if (count($primary_parties) > 0): ?>
			Primary Parties: <?php echo $primary_parties ?>.
	<?php endif; ?>
	</p>
        <p><strong>Location: </strong>
	<?php echo metadata('item', array('Item Type Metadata', 'Town')); ?>. 
	<?php
		$date = metadata('item', array('Item Type Metadata', 'Date'));
		$year = metadata('item', array('Item Type Metadata', 'Year'));
		if (count($date) > 0): ?>
			Date:<?php echo ' '; echo $date; echo ' '; echo $year; ?>.
	<?php endif; ?>
	</p>
        <p><strong>Archive: </strong><?php echo metadata('item', array('Item Type Metadata', 'Archive')); ?>.</p>
        <p><strong>Archive Number: </strong><?php echo metadata('item', array('Item Type Metadata', 'Call Number')); ?>. Page(s): <?php echo metadata('item', array('Item Type Metadata', 'Pages')); ?>.</p>
	<p>
        <?php if($rights != ''): ?>
        <span><?php echo $rights; ?> | </span>
        <?php endif; ?>
        </p>

        <?php fire_plugin_hook('embed_codes_content', array('item'=>$item, 'view'=>$this)); ?>
    </div>
</div>
</body>
</html>
