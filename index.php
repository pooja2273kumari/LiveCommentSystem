<!DOCTYPE html>
<html>
 <head>
  <title>Comment System using PHP and Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body style="background: rgb(28,128,136);
background: linear-gradient(90deg, rgba(28,128,136,0.8930759803921569) 61%, rgba(120,173,186,0.8258490896358543) 100%);">
  <br />
  <h1 align="center"><a href="#" style="color: white;">Comment System using PHP and Ajax</a></h1>
  <br />
  <div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" /> <!--under this will store particuler comment-->
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
 </body>
</html>


<script>
	$(document).ready(function(){

		$('#comment_form').on('submit', function(event){
			event.preventDefault();
			var form_data = $(this).serialize();
			$.ajax({				        //Start Writting ajax request
				url:"add_comment.php",      //send request to this page
				method:"POST",              //send data to server
				data:form_data,
				dataType:"JSON",
				success:function(data)     //when request accepted successfully and receive data from server
				{
					if(data.error!='')
					{
						$('#comment_form')[0].reset(); 
						$('#comment_message').html(data.error);
					}
				}
			})
		});

		load_comment();

//Load all comments on page..
		function load_comment()
		{
			$.ajax({
				url:"fetch_comment.php",
				method:"POST",
				success:function(data)
				{
					$('#display_comment').html(data);
				}
			})
		}


//reply button click

		$(document).on('click', '.reply', function(){
			var comment_id = $(this).attr("id"); //fetch value  from reply button and store it into the commented variable
			$('#comment_id').val(comment_id);
			$('#comment_name').focus();
		});
	});


</script>