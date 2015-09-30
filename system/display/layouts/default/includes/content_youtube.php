
<?php if($content->youtube["embed_link"] != "" ){

?>

<div id="content_youtube">

<h3><?php echo CONTENT_VIDEOS ?></h3>                  
    <div class="embed-responsive embed-responsive-4by3">
    <?php echo $content->youtube["embed_link"]; ?>
    </div>
</div>



<?php }; ?>


                   
                        
