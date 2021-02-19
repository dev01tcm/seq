<?php $this->beginContent('//layouts/web_skeleton'); ?>
    <?php require_once("header.php"); ?>
    <div id="bodyContainer" class="container">    
        <div id="bodyContent" class="container">
        <?php echo $content; ?>
        </div>
    </div>    
    <?php require_once("footer.php"); ?>
<?php $this->endContent(); ?>

