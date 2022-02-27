		<li id="search">
		  <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
			<div>
			  <input type="text" id="s" name="s" class="searchinput" value="<?php echo attribute_escape(__('Search blog archives','rgb')); ?>" onfocus="if (this.value == '<?php echo attribute_escape(__('Search blog archives','rgb')); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo attribute_escape(__('Search blog archives','rgb')); ?>';}" />
			  <input type="submit" id="searchsubmit" value="<?php echo attribute_escape(__('Search','rgb')); ?>" />
			</div>
		  </form>
		</li>