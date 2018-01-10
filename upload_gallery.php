<?php
include("index_layout.php");
include("database.php");
$category_id=$_GET['category_id'];
?>
<!DOCTYPE html>
<html>
    <head>
		<?php css();?>
        <meta charset="utf-8" />
        <title>Upload</title>
         <link rel="stylesheet" href="file-upload/assets/css/styles.css" />
     </head>
 <?php contant_start(); menu();  ?>   
    <body>
<div class="page-content-wrapper">
 <div class="page-content">
	<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i> Upload Here
		</div>
		<div class="tools"> </div>
	</div>
	<div class="portlet-body form">		 
		<div class="col-md-8">
			<div id="dropbox">
				<span class="message">Drop images here to upload. <br /><i>(they will only be visible to you)</i></span>
			</div>
		</div>
      <input  type="hidden" id="category_id" value="<?php echo $category_id?>" >
	</div>
	</div>
	</div>
 	</div>
	<a class="tzine" href="http://tutorialzine.com/2011/09/html5-file-upload-jquery-php/"> </a>
    <script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
	<script src="file-upload/assets/js/jquery.filedrop.js"></script>
 
<script>
$(function(){
	
	var dropbox = $('#dropbox'),
		message = $('.message', dropbox);
	var category_id=$('#category_id').val();
	 
	dropbox.filedrop({
		// The name of the $_FILES entry:
		paramname:'pic',
		maxfiles: 5,
		extraParams: {
			category_ids: category_id
		},
    	maxfilesize: 5,
		url: 'file-upload/post_file.php',
		
		uploadFinished:function(i,file,response){
			$.data(file).addClass('done');
			alert(i);
			// response is the JSON object that post_file.php returns
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Your browser does not support HTML5 file uploads!');
					break;
				case 'TooManyFiles':
					alert('Too many files! Please select 5 at most! (configurable)');
					break;
				case 'FileTooLarge':
					alert(file.name+' is too large! Please upload files up to 2mb (configurable).');
					break;
				default:
					break;
			}
		},
		
		// Called before each upload is started
		beforeEach: function(file){
			if(!file.type.match(/^image\//)){
				alert('Only images are allowed!');
				
				// Returning false will cause the
				// file to be rejected
				return false;
			}
		},
		
		uploadStarted:function(i, file, len){
			createImage(file);
		},
		
		progressUpdated: function(i, file, progress) {
			$.data(file).find('.progress').width(progress);
		}
    	 
	});
	
	var template = '<div class="preview">'+
						'<span class="imageHolder">'+
							'<img />'+
							'<span class="uploaded"></span>'+
						'</span>'+
						'<div class="progressHolder">'+
							'<div class="progress"></div>'+
						'</div>'+
					'</div>'; 
	
	
	function createImage(file){

		var preview = $(template), 
			image = $('img', preview);
			
		var reader = new FileReader();
		
		image.width = 100;
		image.height = 100;
		
		reader.onload = function(e){
			
			// e.target.result holds the DataURL which
			// can be used as a source of the image:
			
			image.attr('src',e.target.result);
		};
		
		// Reading the file as a DataURL. When finished,
		// this will trigger the onload function above:
		reader.readAsDataURL(file);
		
		message.hide();
		preview.appendTo(dropbox);
		
		// Associating a preview container
		// with the file, using jQuery's $.data():
		
		$.data(file,preview);
	}

	function showMessage(msg){
		message.html(msg);
	}

});
 
</script>
    
    </body>
</html> 
