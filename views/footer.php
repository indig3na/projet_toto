<?php
require 'vendor/autoload.php';

use SocialLinks\Page;


//Create a Page instance with the url information
$page = new Page([
    'url' => 'http://mypage.com',
    'title' => 'Home project toto',
    'text' => 'Extended page description',
    'image' => 'http://mypage.com/image.png',
    'twitterUser' => '@twitterUser'

]);


//echo $page->facebook->shareUrl;
?>
		<footer>
			<div class="panel panel-primary">
  				<div class="panel-body text-center">&copy; Myself
  				<a href="<?php $page->facebook->shareUrl; ?>">Facebook</a>
  				<a href="<?php $page->twitter->shareUrl; ?>">Twitter</a>
  				<a href="<?php $page->linkedin->shareUrl; ?>">LinkedIn</a>
  				</div>

  			</div>
  		</footer>
	</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>