<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">

	<title>Ooops!</title>

	<style type="text/css">
		<?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
	</style>
</head>
<body>

	<div class="container text-center">

		<h1 class="headline">Ooops!</h1>

		<p class="lead">Algo não saiu como esperado. Por favor, tente mais tarde...</p>

	</div>

</body>

</html>
