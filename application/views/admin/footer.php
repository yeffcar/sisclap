	<script src="<?php echo base_url('js/materialize.min.js'); ?>"></script>
	<script src="<?php echo base_url('js/star.js?v=1'); ?>"></script>
	<?php 
	    if (isset($footer_includes)) {
	        foreach ($footer_includes as $key => $value) {
	        echo "$value";
	    	}
	    }
	?>
	</body>
</html>