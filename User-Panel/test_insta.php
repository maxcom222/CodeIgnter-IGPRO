<?php
/**
* Supply a user id and an access token
* Jelled explains how to obtain a user id and access token in the link provided
* @link http://jelled.com/instagram/access-token
*/
$userid = "";
$accessToken = "";
// Get our data
function fetchData($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
// Pull and parse data.
$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
$result = json_decode($result);
?>

<?php $limit = 8; // Amount of images to show ?>
<?php $i = 0; ?>

<?php foreach ($result->data as $post): ?>
	<?php if ($i < $limit ): ?>
		<a href="<?= $post->images->standard_resolution->url ?>"><img src="<?= $post->images->standard_resolution->url ?>" width="500" height="500"></a>
		<?php $i ++; ?>
	<?php endif; ?>
<?php endforeach; ?>