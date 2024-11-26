<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['send'])){

   $msg_id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $message = $_POST['message'];
   $message = filter_var($message, FILTER_SANITIZE_STRING);

   $verify_contact = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $verify_contact->execute([$name, $email, $number, $message]);

   if($verify_contact->rowCount() > 0){
      $warning_msg[] = 'message sent already!';
   }else{
      $send_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
      $send_message->execute([$msg_id, $name, $email, $number, $message]);
      $success_msg[] = 'message send successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/styles.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- contact section starts  -->

<section class="contact">

   <div class="row">
      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>
      <form action="" method="post">
         <h3>get in touch</h3>
         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="number" required maxlength="10" max="9999999999" min="0" placeholder="enter your number" class="box">
         <textarea name="message" placeholder="enter your message" required maxlength="1000" cols="30" rows="10" class="box"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>
   </div>

</section>

<!-- contact section ends -->

<!-- faq section starts  -->

<!-- faq section starts  -->

<section class="faq" id="faq">

   <h1 class="heading">FAQ</h1>

   <div class="box-container">

      <div class="box active">
         <h3><span>if saved property remain stored in my account </span><i class="fas fa-angle-down"></i></h3>
         <p>Yes, saved properties will remain stored in your account. You can view and manage them anytime by logging into your account.</p>
      </div>

      <div class="box active">
         <h3><span>when will I get response of my enquiry ?</span><i class="fas fa-angle-down"></i></h3>
         <p>Responses to enquiries are typically provided within 24-48 hours. However, response times may vary based on agent availability and the volume of enquiries.</p>
      </div>

      <div class="box">
      <h3><span>where can I pay the rent?</span><i class="fas fa-angle-down"></i></h3>
      <p>Rent payments can be made online through contacting to owner secure payment gateway .</p>
      </div>

      <div class="box">
      <h3><span>how to contact with the buyers?</span><i class="fas fa-angle-down"></i></h3>
      <p>You can contact buyers through the enquiry system on the platform .</p>
      </div>

      <div class="box">
      <h3><span>why guest cant enquiry for property?</span><i class="fas fa-angle-down"></i></h3>
      <p>Only registered users can enquire about properties to ensure privacy and security for both buyers and sellers.</p>
      </div>

      <div class="box">
      <h3><span>how to upload property ?</span><i class="fas fa-angle-down"></i></h3>
      <p>To upload a property, log in to your account, go to the "Post Property" section, and fill in the required details.</p>
      </div>

   </div>

</section>


<!-- faq section ends -->










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>