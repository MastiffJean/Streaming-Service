<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="stuff, to, help, search, engines, not" name="keywords">
<meta content="What this page is about." name="description">
<meta content="Display Webcam Stream" name="title">
<title>Display Webcam Stream</title>
  
<style>
#container {
    margin: 0px auto;
    width: 500px;
    height: 375px;
    border: 10px #333 solid;
}
#videoElement {
    width: 500px;
    height: 375px;
    background-color: #666;
}
</style>
</head>
  
<body>
<div id="container">
    <video autoplay="true" id="videoElement">
     
    </video>
    <h1 id="shop_info">text</h1>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
</script>
<script>
	 var video = document.querySelector("#videoElement");
	 

	if (navigator.mediaDevices.getUserMedia) {       
	    navigator.mediaDevices.getUserMedia({video: true})
	  .then(function(stream) {
	    video.srcObject = stream;
	    $("#shop_info").text(stream);
	  })
	  .catch(function(err0r) {
	    console.log("Something went wrong!");
	  });
	}
</script>
	

</body>
</html>