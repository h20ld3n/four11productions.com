<div class="grid_12 content">
	<?php 
	global $numofimg;
		$width = "";
		$imgcnt = 0;			
		for($i=1;$i<=$numofimg;$i++){
			$img_url = $gpp['gpp_base_slideshow_image_'.$i];
			if($img_url != ""){
				$image = gpp_base_resize( $attach_id = null, $img_url, '', 500, $crop = false ) ;
				$size = $image['width'];
				$width = $width + $size;
			}			
			$imgcnt++;
		}	
	 ?>
		<div class="slider-navigation">
			<a class="leftnav"></a>
    		<a class="rightnav"></a>  
		</div>
		<div id="mainholder">
		<div id="holder" style="width:<?php echo ($width); ?>px">						
						<?php
					for($i=1;$i<=$numofimg;$i++){
						$img_url = $gpp['gpp_base_slideshow_image_'.$i];
						$img_title = $gpp['gpp_base_slideshow_image_'.$i.'_title'];
						$img_caption = $gpp['gpp_base_slideshow_image_'.$i.'_caption'];
						if($img_url != ""){
							$image = gpp_base_resize( $attach_id = null, $img_url, '', 500, $crop = false ) ;						
						?>
					<div class="singleitem">
						<img src="<?php echo $image['url'] ?>" width="<?php echo $image['width']?>" height="<?php echo $image['height']?>">	
						<?php if(!empty($img_caption) && !empty($img_title) ){ ?>
							<div class="imglink show"></div>
							<div class="postlink"><div class="imgexcerpt"><h6><?php echo $img_title; ?></h6><?php echo $img_caption; ?></div></div>
						<?php } ?>
					</div>					
				<?php } } ?>				
		</div>
	</div>	
	<div id="mainindex">
		<div id="imagediv">
			<span class="start"></span>
				<?php 
					for($i=1;$i<=$numofimg;$i++){
						$img_url = $gpp['gpp_base_slideshow_image_'.$i];
						if($img_url != ""){
							$image = gpp_base_resize( $attach_id = null, $img_url, '', 50, $crop = false ) ;?>
					<img src="<?php echo $image['url']?>" width="<?php echo $image['width']?>" height="<?php echo $image['height']?>">	
				<?php } } ?>	
			<span class="end"></span>
		</div>
		<div id="index"></div>		
	</div>
</div>	