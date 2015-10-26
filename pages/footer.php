<?php
/**
 * SPA footer file
 * @author Shahriar
 * @version 1.0.1
*/
?>
		</div>
		<!-- /Main -->
		<!-- Modal -->
		<div id="loginModal" class="modal fade" role="dialog" data-ng-controller="userController">
		  <div class="modal-dialog">
		
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">
		      	<div id="status"></div>
		        <div class="col-md-6 login">
		        	<h2>Login</h2>
		        	<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
					</fb:login-button>
					<p>or</p>
		        	<form data-ng-submit="login()">
		        		Email: <input type="text" ng-model="email" placeholder="Email" />
		        		Password: <input type="password" ng-model="password" placeholder="Password" />
		        		<button type="submit" class="btn btn-default">Login</button>
		        	</form>
		        </div>
		        <div class="col-md-6 register">
		        	<h2>Register</h2>
		        	<form  data-ng-submit="reg()">
		        		Name: <input type="text" ng-model="username" placeholder="Name" />
		        		Email: <input type="text" ng-model="email" placeholder="Email" />
		        		Password: <input type="password" ng-model="password" placeholder="Password" />
		        		<button type="submit" class="btn btn-default">Register</button>
		        	</form>
		        </div>
		      </div>
		      <div class="modal-footer"></div>
		    </div>
		
		  </div>
		</div>
		
		<div id="postModal" class="modal fade" role="dialog" data-ng-controller="postController">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">
		      		<form method="post" action="" enctype="multipart/form-data">
				        <div class="col-md-6 post">
				        	<h2>{{title}}</h2>
			        		Post Title: <input type="text" name="posttitle" placeholder="Post Title" required="required" />
			        		Thumbnail: <input type="file" name="postimg" />
				        </div>
				        <div class="col-md-6 post">
				        	Post: <textarea name="postdesc" my-maxlength="500" data-ng-model="textareaText" ></textarea>
				        	<p><span ng-bind="left()"></span> characters left</p>
					    	<input type="submit" class="btn btn-default" value="Submit" name="postsubmit" />
			        </form>
		       			</div>
		      </div>
		      <div class="modal-footer"></div>
		    </div>
		
		  </div>
		</div>
		<!-- /Modal -->
	</body>
</html>