<?php
/**
 * SPA archive file
 * @author Shahriar
 * @version 1.0.1
*/
?>
<div ng-controller="archiveController">
	<div class="col-md-12">
		<h2 class="navbar-left">{{title}}</h2>
		<div class="nav navbar-right filterbar">
			Filter:
			<select data-ng-model="sort">
				<option value="postdate" selected="selected">Date</option>
				<option value="username">User</option>
			</select> 
			<input type="text" data-ng-model="searchtext" placeholder="Search post"  />
		</div>
	</div>
	<div class="col-md-4 anime-post" data-ng-repeat="p in posts | orderBy: sort | filter: searchtext">
		<article class="card">
			<header class="card__thumb">
				<a href="post/{{p.postid}}"><img class="img-responsive" src="{{p.postimg}}" ></a>
				
			</header>
			
			<div class="card__body">
				<div class="card__title"><a href="post/{{p.postid}}">{{p.posttitle}}</a></div>
				<div class="card__subtitle"><a href="user/{{p.uid}}">{{p.username}}</a></div>
				<p class="card__description">{{p.postdesc | limitTo:170}}</p>
			</div>
			<div class="card__footer">
			</div>
		</article>
	</div>
</div>