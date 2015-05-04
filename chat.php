<?php
	session_start();
	if(isset( $_SESSION['name'] ))
	{
		$currentUser = $_SESSION['name'];
	}
	else
	{
		header("location: templogin.php");
	}

	include_once("classes/Message.class.php");

	$m = new Message();

	if( !empty($_POST) )
	{	
		try {
			$m = new Message();
			$m->setText($_POST['text']);
			$m->setUser($currentUser);
			$m->Save();

		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
	$all_messages = $m->showAll();

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>iMessage</title>
	<link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<?php

    if (isset($error)): ?>

        <div class="error"><?php echo $error; ?></div>

<?php endif ?>
	<div>
		
		<section>
			<?php
				while($message = $all_messages->fetch(PDO::FETCH_OBJ))
				{
					echo "<article>";
					if( $message->user === $currentUser )
					{
						echo "<article class='ik'>" . $message->message . "</article>";
					}
					else
					{
						echo "<article class='nietik'>" . $message->message . "</article>";
					}
					echo "</article>";
				}
			?>
		</section>

		<section>
			<form action="" method="post">
			<input type="text" placeholder="type hier uw bericht" name="text">
			<button type="submit" value="Send" id="btnSubmit">Send</button>
			</form>
		</section>
	</div>

    <script>

        $(document).ready(function(){
            $("#btnSubmit").on("click", function(e){
                var text = $(".imessage").val();

                $.ajax({

                    method: "POST",
                    url: "classes/save_message.php",
                    data: { 'text' : text }

                })
                    .done(function( resp ) {
                        if(resp.status === "success")
                        {

                            var li = $("<article class='me'></article>").html(resp.text).css("display","none");
                            $(".messages").append(li);
                            li.slideDown("fast");

                        }
                    });

                setInterval(function(){

                    $.get("classes/get_message.php", function(data, status){

                        console.log(data.toString());

                    });

                }, 3000);

                e.preventDefault();
            });
        });

    </script>

</body>
</html>