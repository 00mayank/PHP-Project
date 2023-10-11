<?php
session_start();
include 'config.php';
$profileName='Login';
if (isset($_POST["signUp"])) {
  $full_name = mysqli_real_escape_string($database, $_POST["signUp_name"]);
  $email = mysqli_real_escape_string($database, $_POST["signUp_email"]);
  $phone=mysqli_real_escape_string($database,$_POST["signUp_phone"]);
  $password = mysqli_real_escape_string($database, md5($_POST["signUp_pass"]));
  $cpassword = mysqli_real_escape_string($database, md5($_POST["signUp_cpass"]));

  $check_email = mysqli_num_rows(mysqli_query($database, "SELECT customerEmail FROM customer WHERE customerEmail='$email'"));
 
  if ($password !== $cpassword) {
    echo "<script>alert('Password did not match.');</script>";
  } elseif ($check_email > 0) {
    echo "<script>alert('Email already exists in out database.');</script>";
  } else {
    $sql = "INSERT INTO customer( customerName, customerEmail, customerPhone, customerPass) VALUES ('$full_name','$email','$phone','$password')";
    
    $result = mysqli_query($database, $sql);
    if ($result) 
      {
      $profileName=$full_name;
      echo "<script>alert('{$profileName} successfully added to database.');</script>"; 
     
      $_POST["signUp_name"] = "";
      $_POST["signUp_email"] = "";
      $_POST["signUp_pass"] = "";
      $_POST["signUp_cpass"] = "";
      
    }
    else{
      echo "<script>alert('User registration failed.');</script>";
    } 
  } 
}

if (isset($_POST["login"])) {
  $email = mysqli_real_escape_string($database, $_POST["logIn_email"]);
  $password = mysqli_real_escape_string($database, md5($_POST["logIn_pass"]));

  $check_email = mysqli_query($database, "SELECT * FROM customer WHERE customerEmail='$email' AND customerPass='$password'");
  
  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $profileName=$row['customerName'];
    
  } else {
    echo "<script>alert('Login details is incorrect. Please try again.');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../shortCss/css/travelzz.css">
    <link rel="stylesheet" href="../shortCss/css/login.css">
    <link rel="stylesheet" href="../shortCss/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Travelzz</title>
</head>
<body>
    <cursor class="pointer" ></cursor>
    <cursor class="pointer2"></cursor>   
    <header class="firstHead ">
        <div class="innerFlex">
            <a href="#" class="logo">Trav<b>elzz</b></a> 
            <nav class="item">
                <ul>
                    <li class="hoverLine"><a class="login" ><i class="fa fa-user"></i>
                    <?php if($profileName=="Login")
                    {
                        echo $profileName; 
                    }
                      else{echo "Hi! ".$profileName;}
                      
                    ?>
                    </a></li>
                    <li class="hoverLine"><a href="#Destination" >Destination</a></li>
                    <li class="hoverLine"><a href="#Book" >Book</a></li>
                    <li class="hoverLine"><a href="#page4" >About</a></li>
                    <li class="hoverLine"><a id="Contact" >Contact</a></li>
                </ul>
            </nav>
        </div>
        
        
    </header>
    <section class="con">
      <a href="#" class="close ca"></a>
      <h2 class="heading-section head-primary">Contact Us.</h2>
      <form class="contact_form">
        <div>
          <i class="fa fa-envelope fa-4x"></i>
        </div>
        <input type="text" placeholder="Name (required)" required>
        <input type="text" placeholder="Return address (required)" required>
        <input type="text" placeholder="Topic (required)" required>
        <textarea placeholder="Subject (required)" required></textarea>
        <input type="submit" value="Send"> 
      </form>
      <div class="line"><hr/></div>
      <div class="container">
        <div class="ln-gt">
          <ul>
            <li><a href=""><i class="fa fa-github fa-2x"></i></a></li>
            <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
            <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
            <li><a href=""><i class="fa fa-instagram fa-2x"></i></a></li>
          </ul>
        </div>
      </div> 
    </section>
    <section class="user">
      <a href="#" class="close ca1"></a>
      <div class="user_options-container">
        <div class="user_options-text">
          <div class="user_options-unregistered">
            <h2 class="user_unregistered-title">Don't have an account?</h2>
            <p class="user_unregistered-text"> Sign Up right now and get started with your journey!</p>
            <button class="user_unregistered-signup" id="signup-button">Sign up</button>
          </div>
    
          <div class="user_options-registered">
            <h2 class="user_registered-title">Allready have an account?</h2>
            <p class="user_registered-text">Lets get you dive into the adventure!</p>
            <button class="user_registered-login" id="login-button">Login</button>
          </div>
        </div>
        
        <div class="user_options-forms" id="user_options-forms">
          <div class="user_forms-login">
            <h2 class="forms_title">Login</h2>
            <form action="" method="post" class="forms_form logIn">
              <fieldset class="forms_fieldset">
                <div class="forms_field">
                  <input type="email" name ="logIn_email" placeholder="Email" class="forms_field-input" required autofocus />
                </div>
                <div class="forms_field">
                  <input type="password" name="logIn_pass" placeholder="Password" class="forms_field-input" required />
                </div>
              </fieldset>
              <div class="forms_buttons">
                <button type="button" class="forms_buttons-forgot">Forgot password?</button>
                <input type="submit" value="Log In" name ="login" class="forms_buttons-action">
              </div>
            </form>
          </div>
          <div class="user_forms-signup">
            <h2 class="forms_title">Lets Get Started</h2>
            <form action="" method="post" class="forms_form">
              <fieldset class="forms_fieldset">
                <div class="forms_field">
                  <input type="text" name="signUp_name" placeholder="Full Name" class="forms_field-input" required />
                </div>
                <div class="forms_field">
                  <input type="email" name="signUp_email" placeholder="Email" class="forms_field-input" required />
                </div>
                <div class="forms_field">
                  <input type="number" name="signUp_phone" maxlength="10" placeholder="Phone Number" class="forms_field-input" required/>
                </div>
                <div class="forms_field">
                  <input type="password" name="signUp_pass" placeholder="Password" class="forms_field-input" required />
                </div>
                <div class="forms_field">
                  <input type="password" name="signUp_cpass" placeholder="confirm Password" class="forms_field-input" required />
                </div>
              </fieldset>
              <div class="forms_buttons">
                <input type="submit" name="signUp" value="Sign up" class="forms_buttons-action signUp">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <div class="first-section">
        <h1>Travel <b>With US</b></h1>
        <p>Some of life’s usual rules go out of the window when you’re travelling. You don’t have to set your alarm clock and you don’t have to worry about ironing, washing the dishes or any of that other boring grown-up stuff. </p>
        <div id="gallery">
            <div class="window-container"> 
                <div class="window medium one"></div>
                <div class="window tall two"></div>
                <div class="window medium three"></div>
                <div class="window medium four"></div>
                <div class="window tall five"></div>
                <div class="window detail">
                    <ol type="1">
                          <li>Adventure Travel</li>  
                          <li>Art And Culture</li>
                          <li>Wildlife And Nature</li>
                          <li>Family Holidays</li>
                          <li>Food And Drink</li>
                    </ol>
                </div>
                <div class="window tall six"></div>
            </div>
        </div>
    </div>         
    <div id="page2">
      <h1> 25000 </h1>  
    
          <img alt="mondo" class="mondo" src="https://i.ibb.co/grLS2HM/Hot-Air-Balloon-960x1153.png">
        
          <div class="sinistra"> <h2>Travelers booked lovely trips</h2>
            <p>Well prepared means well traveled. Your journey starts much before you take your bag and set off. We help to find the ticket and accomodation you need, offer the routes, car, rentals and even book a taxi. Just choose the destination - we will do the rest.<p>
            <div class="button">
            <input type="button" class="bottone" value="READ MORE  →" /></div>   
          </div>
  </div>
  <div id="page3">
    <h2 class="intro">Introducing new features and offers</h2> 
    
        <div class="slider-container">
          <div class="menu">
            <label for="slide-dot-1"></label>
            <label for="slide-dot-2"></label>
            <label for="slide-dot-3"></label>
          </div>
          <input id="slide-dot-1" type="radio" name="slides" checked>
            <div class="slide slide-1"><div class="top-left">
              TRAVELER BONUS <p class =tl> Big networks of patners allows us to offer you the extra bonuses and services at your destinations. Free museums and excursions, gyms, brekfasts, parties, gifts, discounts for families and much more. Check and choose.</p>
        
              <div class="button">
                <input type="button" class="bottone1" value="ALL BONUSES  →" />
              </div>
            </div>
            <img alt="paper" class="paper" src="https://i.ibb.co/HgVfMQQ/Paper-Plane-800x800.png">  
          </div>
          <input id="slide-dot-2" type="radio" name="slides">
          <div class="slide slide-2"></div>
    
          <input id="slide-dot-3" type="radio" name="slides">
          <div class="slide slide-3"></div>
        </div>
  </div>   
  <div class="third-section" id="Book">
        
    <div class="contiainer">
        <div class="Booking_form">
            <h2>Book&nbsp;&nbsp;&nbsp;&nbsp; &Travel</h2>
            <h4>Wherever you go, make yourself at home</h4>
            <?php
              
              if(isset($_POST["Check"])){
                $destination=mysqli_real_escape_string($database, $_POST["destination"]);
                $adult=mysqli_real_escape_string($database, $_POST["total_adults"]);
                $child=mysqli_real_escape_string($database, $_POST["total_children"]);
                $checkIn=mysqli_real_escape_string($database, $_POST["checkin"]);
                $checkOut=mysqli_real_escape_string($database, $_POST["checkout"]);
              
                $check_status = mysqli_query($database, "SELECT * FROM destination WHERE destName='$destination'");
                if(mysqli_num_rows($check_status) > 0){
                  $row1 = mysqli_fetch_assoc($check_status);
                  if($row1['status']<=8){
                    $custID = mysqli_query($database, "SELECT customerId FROM customer WHERE customerName='$profileName'");
                    $destId=$row1['destId'];
                    $status=$row1['status']+1;
                    $bookPrice=$row1['destCost']*$adult+($row1['destCost']/2)*$child;
                    $updateStaus="UPDATE destination SET status='$status' WHERE destName='$destination'";
                    if(mysqli_num_rows($custID) > 0){
                      $profile = mysqli_fetch_assoc($custID);
                      $profileId=$profile['customerId'];
                      $book= "INSERT INTO booking( bookId, destId, customerId, checkIn, checkOut, adults, child, bookPrice) VALUES ('NULL','$destId','$profileId','$checkIn','$checkOut','$adult','$child','$bookPrice')";
                      $booking = mysqli_query($database, $book);
                      mysqli_query($database,$updateStaus);
                      if ($booking) 
                    {
                    echo "<script>alert('booking successfully added to database.');</script>"; 
                    }
                    else{
                    echo "<script>alert('User booking failed.');</script>";
                    }
                    }
                    
                     
                  }
              
                }
              }
              
              ?>
            <form action="" method="post">
            
                <div class="elem-group">
                    <label class="BookAvailabilty_Label" for="destination">Select a Destination</label>
                    <select id="destination" name="destination" required>
                        <option value=""></option>
                        <option value="india">India</option>
                        <option value="germany">Germany</option>
                        <option value="canada">Canada</option>
                        <option value="japan">Japan</option>
                        <option value="america">America</option>
                    </select>
                  </div>  
                <div class="elem-group inlined">
                  <label class="BookAvailabilty_Label" for="adult">Adults</label>
                  <input type="number" id="adult" name="total_adults"  min="1" max="20" required>
                </div>
                <div class="elem-group inlined">
                  <label class="BookAvailabilty_Label" for="child">Children</label>
                  <input type="number" id="child" name="total_children"  min="0" max="20" required>
                </div>
                <div class="elem-group inlined">
                  <label class="BookAvailabilty_Label" for="checkin-date">Check-in Date</label>
                  <input type="date" id="checkin-date" name="checkin" placeholder="none" required>
                </div>
                <div class="elem-group inlined">
                  <label class="BookAvailabilty_Label"  for="checkout-date">Check-out Date</label>
                  <input type="date" id="checkout-date" name="checkout" required>
                </div>
                <button type="submit" name="Check" value="Check">Check Availabilty</button>
                    
              </form>
              
        </div>
    </div>
</div>                                 
    <div class="second-section" id="Destination">
        <div class="subSection">
            <h2>The Secret Of Nature</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate illo officiis numquam pariatur corrupti libero ad, 
                facere non in repudiandae error maxime iusto ut amet eaque totam exercitationem iure deserunt.</p>
            <button>learn more</button>
        </div>
        <div class="subSection2">           
            <svg id="sw-js-blob-svg" viewBox="0 0 100 100">                    
                <defs>                         
                    <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            
                        <stop id="stop1" stop-color="rgba(248, 117, 55, 1)" offset="0%"></stop>                            
                        <stop id="stop2" stop-color="rgba(251, 168, 31, 1)" offset="100%"></stop>                        
                    </linearGradient>                    
                </defs>                
                <path fill="url(#sw-gradient)" d="M20.1,-36.6C22.3,-29.9,17.6,-17.9,20.5,-9.8C23.4,-1.8,33.9,2.3,37.3,8.1C40.7,13.9,37.1,21.4,30.3,22.6C23.6,23.7,13.7,18.5,6.1,20.5C-1.4,22.5,-6.7,31.8,-10.2,32C-13.6,32.2,-15.1,23.3,-20.3,17.5C-25.4,11.7,-34.3,8.9,-37.9,3.6C-41.6,-1.8,-40.2,-9.7,-35.1,-14C-30,-18.3,-21.3,-19,-14.8,-23.7C-8.4,-28.4,-4.2,-37.3,2.4,-41C9,-44.7,18,-43.3,20.1,-36.6Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: all 0.3s ease 0s;" stroke="url(#sw-gradient)">
                </path>
            </svg>
        </div>
    </div>
    
<div class="last">

      <div id="page4">
        <h2 class="base">Our base consist of:</h2>
        
        <table>
      <tr>
        <th>1 billion</th>
        <th>120</th> 
        <th>250</th>
        <th>4K</th>
      </tr>
      <tr>
        <td>Hotels, guesthouses<br>and apartments</td>
        <td>Countries</td>
        <td>Airlines and<br>lowcosters</td>
        <td>Travel agencies<br>and companies</td>
      </tr>
      </table>
     </div>
       <div id="sin2">
          <p class="business">
    Be it business, education, family holiday, a city break with friends or tour, we are here to support your travel. Confortable journey and cozy accomodation - everything to make you feel at home whatever is the corner of the world.
          </p>
         
         <div class="button">
           <input type="button" class="bottone3" value="I WANT TO SEE →" />
         </div>  
        
        <img alt="valigia" class="valigia" src="https://i.ibb.co/v1wJw8B/suitcase-PNG10774.png">
        
        </div> 
    </div>




        <!--Footer-->
<div class="foot">
<footer class="footer">
    <!-- <div class="container"> -->
        <div class="footer-content">
            <div class="footer-text">
                <a href="#" class="logo footer-icon">Trav<b>elzz</b></a>
                <p class="footer-desc">
                    Plan and book your perfect trip with
                    expert advice, travel tips destination
                    information from us
                </p>
                <p class="copyright">© All rights reserved by Mayank Singh</p>
            </div>
            <div class="nav-footer">
                <div class="nav-footer-col">
                    <h4 class="nav-footer-title">Destinations</h4>
                    <ul class="nav-footer-links">
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">India</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Germany</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Asia</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Europe</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">America</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-footer-col">
                    <h4 class="nav-footer-title">Shop</h4>
                    <ul class="nav-footer-links">
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Destination Guides</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Pictorial & Gifts</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Special Offers</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Delivery Times</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">FAQs</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-footer-col">
                    <h4 class="nav-footer-title">Interests</h4>
                    <ul class="nav-footer-links">
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Adventure Travel</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Art And Culture</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Wildlife And Nature</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Family Holidays</a>
                        </li>
                        <li class="nav-footer-item">
                            <a href="#" class="nav-footer-link">Food And Drink</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="social-media">
            </div>
        </div>
    <!-- </div> -->
</footer>
</div>
<!--Footer-->
    <script src="../shortCss/js/travelzz.js"></script>
</body>
</html>