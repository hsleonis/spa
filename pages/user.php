<?php
/**
 * SPA user file
 * @author Shahriar
 * @version 1.0.1
*/
session_start();
if(isset($_SESSION['logged'])){
?>
<!-- Post -->
<div data-ng-controller="profileController" data-ng-init="ujoin('<?php echo $_SESSION['uid']; ?>')">
	<p>{{userId}}</p>
	<h2>User name: {{username}}</h2>
	<h4>Join date: {{joindate}}</h4>
</div>
<!-- /Post -->
<?php }
else echo "<h2>Please log in</h2>";
