<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo "$title"; ?></title>
		<link href="<?php echo base_url('css/materialize.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('css/admin/star.css'); ?>" rel="stylesheet">
		<script type="text/javascript"><?php echo 'var str_base_url = "'.base_url().'";'; ?></script>
		<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
		<?php
			if (isset($head_includes)) {
				foreach ($head_includes as $value) {
					echo $value;
				}
			}
		?>
	</head>
<body>