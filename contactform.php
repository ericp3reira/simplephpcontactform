<?php

  $error = "";
  $successMessage = "";

  if ($_POST) { //Check if form was posted

    if (!$_POST["email"]) {
      $error .= "The e-mail field is required.<br>";
    } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) { //Check if e-mail is valid
      $error .= "The e-mail address is not valid<br>";
    }

    if (!$_POST["subject"]) {
      $error .= "The subject field is required.<br>";
    }

    if (!$_POST["message"]) {
      $error .= "The message field is required.";
    }

    if ($error != "") {
      $error = '<div class="alert alert-danger" role="alert"><p><strong>There were a few error(s) in your form:</strong></p><p>' . $error . '</p></div>';
    } else { //Check if there were no errors, send e-mail
      $emailTo = "me@myself.com";
      $subject = $_POST["subject"];
      $message = $_POST["message"];
      $headers = "from: ".$_POST["email"];
      
      if (mail($emailTo, $subject, $message, $headers)) { //Check if mail() is working
        $successMessage = '<div class="alert alert-success" role="alert"><p>We will be in contact ASAP!</p></div>';
      } else {
        $error = '<div class="alert alert-danger" role="alert"><p>Your message couldn\'t be sent. Please, try again later.</p></div>';
      }
    }
    
  }

?>

<!DOCTYPE html>

<html>
  
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>Contact Form</title>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    
    <style type="text/css">
      textarea {
        resize: none;
      }
      
    </style>

  </head>

  <body>
    
    <div class="container">
      
      <h2>Get in Touch:</h2>
      
      <div id="error">
        <? echo $error.$successMessage; ?>
      </div>
      
      <form method="post">
        
        <fieldset class="form-group">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com">
          <p class="help-block">We'll never share your e-mail</p>
        </fieldset>
        
        <fieldset class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" name="subject" placeholder="Your E-mail Subject">
        </fieldset>
        
        <fieldset class="form-group">
          <label for="message">What would you like to ask us?</label>
          <textarea class="form-control" rows="3" id="message" name="message" placeholder="How much for a simple website?"></textarea>
        </fieldset>
        
        <button type="submit" id="submit" class="btn btn-success">Send!</button>
        
      </form>
    
    </div>
    
   
    
    <!-- Latest compiled and minified JavaScript -->
    
    <script   src="https://code.jquery.com/jquery-3.0.0.min.js"   integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0="   crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
      $("form").submit(function (e) {
        
        error = "";
        
        if ($("#email").val() == "") {
          error += "The e-mail field is required.<br>";
        }
        
        if ($("#subject").val() == "") {
          error += "The subject field is required.<br>";
        }
        
        if ($("#message").val() == "") {
          error += "The message field is required.";
        }
        
        if (error != "") {
          e.preventDefault();
          $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were a few error(s) in your form:</strong></p><p>' + error + '</p></div>');
        }
        
      });
    </script>
    
  </body>
  
</html>