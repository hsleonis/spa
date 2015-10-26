<?php
/**
 * SPA single post file
 * @author Shahriar
 * @version 1.0.1
*/
?>
<div ng-controller="singleController">
	<div class="col-md-12">
		<h2 class="top">{{title}}</h2>
		
		<article class="single">
			<div class="col-md-4">
				<a href="{{url}}" class="thumbnail">
					<img class="img-responsive" src="{{postimg}}" >
				</a>
			</div>

			<div class="col-md-8">
				<div class="author"><i class="icon-user"></i> <a href="user/{{uid}}">{{username}}</a></div>
				<ul class="nav nav-tabs" data-tabs="tabs">
				  <li role="presentation" class="active" data-toggle="tab" href="#single">Post Detail</li>
				  <li role="presentation" data-toggle="tab" href="#comment">Comment</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="single">
						<p class="post-desc" ng-bind-html="postdesc"></p>
						<fb:share-button href="{{url}}" type="button_count"></fb:share-button>
						<h4>Comments:</h4>
						<div class="list-group">
						      <a href="#" class="list-group-item" data-ng-repeat="com in coms">
						        	<h4 id="list-group-item-heading" class="list-group-item-heading">{{com.viewer}}</h4>
						        	<p class="list-group-item-text">{{com.comment}}</p>
						      </a>
					    </div>
					</div>
					<div class="tab-pane" id="comment">
						<p>{{comdesc}}</p>
						<form id="comment-form">
							<span>Name:</span><br/>
							<input placeholder="Name" type="text" class="form-control" required="required" data-ng-model="viewer" value="<?php if(isset($_SESSION['logged'])) echo $_SESSION['name']; ?>" />
							<span>Comment:</span><br/>
							<textarea class="form-control" data-ng-model="comment"></textarea>
							<input class="btn btn-primary" type="submit" value="Add comment" data-ng-click="newComment()" />
						</form>
					</div>
				</div>
			</div>
		</article>
	</div>
</div>