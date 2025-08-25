<?php

include 'connection_info.php';
include 'sessionz.php';
include 'mainfetch.php';
include 'slidez.php';
include 'signinz.php';
include 'signupz.php';


?>


<!--//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////PHP ABOVE///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>digital artist database</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">

</head>


<body>


<!-- Add this right after the opening <body> tag -->
<audio id="backgroundMusic" loop>
  <source src="assets/background-music.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>




<div style="display:flex;">
  <div class="title-container" id="mainTitleContainer" style="background-image: linear-gradient(135deg, #e27979 60%, #ed8fd1 100%); transition: background-image 0.7s; ">
    <br>
    <a href="index.php" style="text-decoration:none; color: white;">digital <br>artist <br>database</a>
  </div>
  
   <div id="dotMenuContainer" style="position:relative; align-self:end; margin-bottom:50px; margin-left:-30px;">
    <div id="dot" style="color:black; background: linear-gradient(135deg, #e27979 60%, #ed8fd1 100%); transition: background 0.7s;"></div>
    <div id="dotMenu" style="display:none; position:absolute; left:80px; top:-380%; transform:translateX(-50%); background-image: linear-gradient(to bottom right, rgba(226, 121, 121, 0.936), rgba(237, 143, 209, 0.936)); border-radius:50%; box-shadow:0 4px 24px #0002; padding:1.4em 2em; min-width:10px; z-index:0;">
      <!-- Your menu content here -->
     <!-- Add this play icon to the dot menu container -->
<div id="musicPlayIcon" style="display:none; position:absolute; top:7px; right:41px; background: white; border-radius:50%; padding:2px; font-size:10px; width:16px; height:16px; text-align:center; box-shadow:0 1px 3px rgba(0,0,0,0.2);">
  <span style="color:#e27979;">▶</span>
</div>
      <!-- New buttons for changing color -->
      <div style="position: relative;">
  <button id="musicBtn" style="margin-top:1em; background:white; color:#fff; border:none; border-radius:8px; font-family:monospace; font-size:1em; cursor:pointer; display:block; width:10px;" title="Toggle background music"></button>
  <div id="musicPlayIcon" style="display:none; position:absolute; top:-12px; right:-5px; background: white; border-radius:50%; padding:2px; font-size:10px; width:16px; height:16px; text-align:center; box-shadow:0 1px 3px rgba(0,0,0,0.2);">
    <span style="color:#e27979;">▶</span>
  </div>
</div>
      <button id="changeTitleBgBtn" style="margin-top:1em; background:grey; color:#fff; border:none; border-radius:8px; font-family:monospace; font-size:1em; cursor:pointer; display:block; width:10px;"></button>
      <button id="bwThemeBtn" style="margin-top:0.7em; background:lightgrey; color:#fff; border:none; border-radius:8px; padding:0.6em 1.1em; font-family:monospace; font-size:1em; cursor:pointer; display:block; width:10px;"></button>
    </div>
  </div>
  <p style="color:black; font-size:15px; margin-left:10px; align-self:end;">[beta]</p>
</div>


<!-- Pop-out menu for quick nav, hidden by default -->
<div id="titleMenuPopout" style="display:none; position:fixed; z-index:10000; top:65px; left:40px; background: white; border-radius:14px; box-shadow:0 4px 24px #0002; padding:1.4em 2em; min-width:80px; font-family:monospace;">
  <div style="display:flex; flex-direction:column; gap:0.5em;">
    <a href="v4.5.php" style="color:#777; text-decoration:none; font-size:1.1em;">home</a>
    <a href="v4.5.php" style="color:#777; text-decoration:none; font-size:1.1em;">about</a>
    <a href="signup.php" style="color:#b44; text-decoration:none; font-size:1.1em;">sign up</a>
    <a href="contribute.php" style="color:#a56; text-decoration:none; font-size:1.1em;">contribute</a>
    <a href="database.php" style="color:#555; text-decoration:none; font-size:1.1em;">database</a>
    <a href="studio.php" style="color:#777; text-decoration:none; font-size:1.1em;">studio</a>
   
  </div>
</div>


<!-- SIGN IN BAR AT TOP -->
<div class="signin-bar" style="width:88vw; justify-content: baseline;border-bottom-right-radius:10px; border-top-right-radius:10px;">
  <?php include 'signin-bar.php'; ?>
</div>
    


<br>

 <div style="display:flex; align-content:center; justify-content:center;">
    <div class="nav-button"><a href="signup.php">[sign up]</a></div><div class="nav-button"><a href="contribute.php">[contribute]</a></div><div class="nav-button"><a href="database.php">[database]</a></div><div class="nav-button"><a href="studio.php">[studio]</a></div>
  </div>

  

   <!-- Slideshow container -->
<div id="slideshow-container" style="position:relative;">
  <img id="slideshow-img" src="" alt="Slideshow photo" style="object-fit: cover; width:100%; border-radius:7px; height:550px; transition:0.1s;">
  <!-- First, modify the slideshow overlay HTML structure: -->


</div>
  
  </div>

<?php include 'popular_works.php'; ?>
 
<br>
  <br>

<div class="container-container-container" style="display:grid; align-items:center; justify-items: center;"> 
<div class="container-container" style="border: double; border-radius:20px; padding-top:50px; width:90%; align-items:center; justify-items: center; display:grid;   background-color: #f2e9e9; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);">

<div style="display:flex; justify-content: center; align-items:center;">
  <div>
    <input type="text" id="artistSearchBar" placeholder="Search artists..." style="width:60vw; padding:0.6em 1em; font-size:1em; border-radius:7px; border:1px solid #ccc;">
  </div>
</div>

<!-- SORT BUTTONS AND SEARCH BAR ROW (MODIFIED) -->
<div style="display:flex; justify-content:center; align-items:center; margin:1em 0 1em 0;">
  <!-- SEARCH BAR MOVED TO THE LEFT -->
  
 

  <button id="sortAlphaBtn" style="padding:0.7em 1.3em; font-family: monospace; font-size:1em; color: black; background-color: rgba(255, 255, 255, 0); border:none; border-radius:8px; cursor:pointer;">
    name
  </button>
  <button id="sortDateBtn" style="padding:0.7em 1.3em; font-family: monospace; font-size:1em; background-color: rgba(255, 255, 255, 0); color:black; border:none; border-radius:8px; cursor:pointer;">
    date
  </button>
  <button id="sortCountryBtn" style="padding:0.7em 1.3em; font-family: monospace; font-size:1em; background-color: rgba(255, 255, 255, 0); color:black; border:none; border-radius:8px; cursor:pointer;">
    country
  </button>
  <button id="sortGenreBtn" style="padding:0.7em 1.3em; font-family: monospace; font-size:1em; background-color: rgba(255, 255, 255, 0); color:black; border:none; border-radius:8px; cursor:pointer;">
    genre
  </button>
</div>
 

  <div id="container"></div>

  <br><br><br><br><br>

</div>
</div> 

<br><br><br>

<div style="color:black; justify-self:center; width:70%;">
    <h1 style="color:black; justify-self:center; font-family:Arial;">Join the Digital Artist Database Community<br>
    <h1 style="color:black; width:70%; justify-self:center;"> show your work with artists from around the world</h1>
    <p style="color:black; width:70%; justify-self:center;font-family:Arial;"> a comprehensive database of artists across time and space, the digital artist database is an all-inclusive and exhuastive resource for artistic research, inspiration, and creation in every tendral.</p>
</div>

<h2 style="color:black; justify-self:center;">▼</h2>

<br><br>

<div class="container-container-container" style="display:grid; align-items:center; justify-items: center;"> 
  <div class="container-container" style="border: double; border-radius:20px; padding:50px; width:70%; align-items:center; justify-items: center; display:grid; background-color: #f2e9e9; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);">
    
    <h1 style="color:black;">Create Your Account</h1>

    <div class="containerone">
      <form id="signupForm" method="POST" action="" autocomplete="off" class="signup-form">
        <div class="form-group">
          <label for="firstname" class="formlabel">First Name:</label>
          <input type="text" id="firstname" name="firstname" required 
                 class="form-control" placeholder="Enter your first name">
        </div>

        <div class="form-group">
          <label for="lastname" class="formlabel">Last Name:</label>
          <input type="text" id="lastname" name="lastname" required 
                 class="form-control" placeholder="Enter your last name">
        </div>

        <div class="form-group">
          <label for="email" class="formlabel">Email:</label>
          <input type="email" id="email" name="email" required 
                 class="form-control" placeholder="Enter your email address">
        </div>

        <div class="form-group">
          <label for="password" class="formlabel">Password:</label>
          <input type="password" id="password" name="pword" required 
                 class="form-control" placeholder="Create a strong password"
                 pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                 title="Password must be at least 8 characters and include uppercase, lowercase, number and special character">
          <div id="password_strength" class="password-strength"></div>
          <small class="form-text text-muted" style="color:black;">
            Password must be at least 8 characters and include uppercase, lowercase, 
            number and special character
          </small>
        </div>

        <div class="form-group">
          <label for="confirm_password" class="formlabel">Confirm Password:</label>
          <input type="password" id="confirm_password" name="confirm_password" required 
                 class="form-control" placeholder="Confirm your password">
        </div>

        <div class="form-group">
          <label for="date" class="formlabel">Date of Birth:</label>
          <input type="date" id="date" name="date" required 
                 class="form-control">
        </div>

       <div class="form-group">
  <label for="country" class="formlabel">Country:</label>
  <select id="country" name="country" required class="form-control">
    <option value="">Select your country</option>
    <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana">Botswana</option>
    <option value="Brazil">Brazil</option>
    <option value="Brunei">Brunei</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cabo Verde">Cabo Verde</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
    <option value="Congo, Republic of the">Congo, Republic of the</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Croatia">Croatia</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Eswatini">Eswatini</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Greece">Greece</option>
    <option value="Grenada">Grenada</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Honduras">Honduras</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Korea, North">Korea, North</option>
    <option value="Korea, South">Korea, South</option>
    <option value="Kosovo">Kosovo</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Laos">Laos</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libya">Libya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia</option>
    <option value="Moldova">Moldova</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montenegro">Montenegro</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="North Macedonia">North Macedonia</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Palestine">Palestine</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Qatar">Qatar</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russia</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia">Saint Lucia</option>
    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Serbia">Serbia</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra Leone">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Sudan">South Sudan</option>
    <option value="Spain">Spain</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syria</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania</option>
    <option value="Thailand">Thailand</option>
    <option value="Timor-Leste">Timor-Leste</option>
    <option value="Togo">Togo</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Vatican City">Vatican City</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Vietnam</option>
    <option value="Yemen">Yemen</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
  </select>
</div>


        <div class="form-group">
          <label for="why" class="formlabel">Why are you joining?</label>
          <textarea id="why" name="why" required class="form-control" 
                    placeholder="Tell us why you want to join the digital artist database"></textarea>
        </div>
       
        <div class="form-group">
          <button type="submit" class="submit-btn">Create Account</button>
        </div>

      </form>
    </div>
  </div>
</div>


  

 
  
  <div style="max-width:70vw; margin:2em auto; font-family:Segoe UI,Arial,sans-serif;">
    <button id="payBtn" style="width:100%;  box-shadow: 0 2px 10px #0004; trnsition:1s;  background-color: rgb(235, 168, 168); color:black; border:none; padding:0.7em 0; border-radius:8px; font-size:1em; cursor:pointer;">
      donate to the digital artist database
    </button>
    <div id="paymentPortal" style="display:none; margin-top:1em;  background-color: rgb(235, 168, 168); border-radius:10px; box-shadow:0 2px 8px #eee; padding:1.2em; text-align:center;">
      coming aoon!
    </div>
  </div>


  

  <footer style="background:#222; color:#eee; padding:2em 0; text-align:center; font-size:0.95em;">
  <div style="margin-bottom:1em;">
    <nav>
      <a href="/index.php" style="color:#eee; margin:0 15px; text-decoration:none;">home</a>
      <a href="/about.php" style="color:#eee; margin:0 15px; text-decoration:none;">about</a>
      <a href="/signup.php" style="color:#eee; margin:0 15px; text-decoration:none;">sign up</a>
      <a href="/contribute.php" style="color:#eee; margin:0 15px; text-decoration:none;">contribute</a>
      <a href="/database.php" style="color:#eee; margin:0 15px; text-decoration:none;">database</a>
      
    </nav>
  </div>
  <div style="margin-bottom:1em;">
    <a href="https://discord.com/" target="_blank" rel="noopener" style="margin:0 8px;">
      <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/discord.svg" alt="Twitter" height="22" style="vertical-align:middle; filter:invert(1);">
    </a>
    <a href="https://facebook.com/" target="_blank" rel="noopener" style="margin:0 8px;">
      <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/facebook.svg" alt="Facebook" height="22" style="vertical-align:middle; filter:invert(1);">
    </a>
    <a href="https://instagram.com/" target="_blank" rel="noopener" style="margin:0 8px;">
      <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/instagram.svg" alt="Instagram" height="22" style="vertical-align:middle; filter:invert(1);">
    </a>
    <a href="https://github.com/" target="_blank" rel="noopener" style="margin:0 8px;">
      <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/github.svg" alt="GitHub" height="22" style="vertical-align:middle; filter:invert(1);">
    </a>
  </div>
  <div>
    &copy; 2025 Digital Artist Database. All Rights Reserved.
  </div>
</footer>

<!-- Slide Modal (work card reveal) -->
<div id="slideModal" style="display:none; position:fixed; top:0; left:0;right:0;bottom:0; z-index:9999; background:rgba(0,0,0,0.7); align-items:center; justify-content:center;">
  <div id="slideCard" style="background:white; border-radius:14px; padding:24px 28px; max-width:90vw; max-height:90vh; box-shadow:0 8px 32px #0005; display:flex; flex-direction:column; align-items:center; position:relative;">
    <button id="closeSlideModal" style="position:absolute; top:12px; right:18px; font-size:1.3em; background:none; border:none; color:#333; cursor:pointer;">×</button>
    <img id="modalImg" src="" alt="Image" style="max-width:80vw; max-height:60vh; border-radius:8px; margin-bottom:22px;">
    <div id="modalInfo" style="text-align:center; width:100%;">
      <h2 id="modalTitle" style="color:black; margin-bottom:8px; font-size:24px;"></h2>
      <p id="modalDate" style="color:black; margin-bottom:12px; font-size:16px;"></p>
      <p id="modalArtist" style="color:black; font-weight:bold; font-size:18px;"></p>
    </div>

    <div style="position: absolute; bottom:18px; right:32px; display: flex; align-items: center;">
  <?php if (isset($_SESSION['user_id'])): ?>
    <input type="radio" name="slideWorkSelect" id="slideWorkRadio" style="width:22px; height:22px; accent-color:#e27979;">
  <?php else: ?>
    <div style="display: flex; flex-direction: column; align-items: center;">
      <input type="radio" name="slideWorkSelect" id="slideWorkRadio" style="width:22px; height:22px; accent-color:#e27979; opacity:0.5; cursor:not-allowed;" disabled>
      <span style="font-size:8px; color:#888; margin-top:3px;">sign in to like</span>
    </div>
  <?php endif; ?>
</div>
    
    <button id="visitProfileBtn" style="margin-top:18px; background:#e8bebe; border:none; border-radius:7px; padding:0.7em 2em; font-family:monospace; font-size:1em; cursor:pointer;">visit profile</button>
  </div>
</div>

<!-- Add this modal container for expanded work cards to the HTML part of the file, just before the closing body tag -->
<div id="workModal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.85); overflow:auto;">
  <div style="position:relative; margin:5% auto; padding:20px; width:85%; max-width:900px; animation:modalFadeIn 0.3s;">
    
    <div style="position: absolute; bottom:18px; right:32px; display: flex; align-items: center;">
  <?php if (isset($_SESSION['user_id'])): ?>
    <input type="radio" name="slideWorkSelect" id="slideWorkRadio" style="width:22px; height:22px; accent-color:#e27979;">
  <?php else: ?>
    <div style="display: flex; flex-direction: column; align-items: center;">
      <input type="radio" name="slideWorkSelect" id="slideWorkRadio" style="width:22px; height:22px; accent-color:#e27979; opacity:0.5; cursor:not-allowed;" disabled>
      <span style="font-size:8px; color:#888; margin-top:3px;">sign in to like</span>
    </div>
  <?php endif; ?>
</div>
  
  <span id="closeModal" style="position:absolute; top:10px; right:20px; color:white; font-size:28px; font-weight:bold; cursor:pointer;">&times;</span>
    <div id="modalContent" style="background:#333; padding:25px; border-radius:15px; color:white;"></div>
  </div>
</div>

<!-- First, add this full-screen image container element before the closing body tag -->
<div id="fullscreenImage" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.95); z-index:10000; cursor:zoom-out;">
  <div style="position:absolute; top:15px; right:20px; color:white; font-size:30px; cursor:pointer;" id="closeFullscreen">&times;</div>
  <img id="fullscreenImg" src="" alt="Fullscreen Image" style="position:absolute; top:0; left:0; right:0; bottom:0; margin:auto; max-width:95vw; max-height:95vh; object-fit:contain; transition:all 0.3s ease;">
</div>

<!--//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////SCRIPTS BELOW///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// -->



<script src="musicPlayer.js"></script>
<script src="likeButton.js"></script>
<script src="workCardModal.js"></script>
<script src="randomColors.js"></script>
<script src="dotMenu.js"></script>
<script src="titleContainerFunctions.js"></script>
<script src="renderArtistsFunctions.js"></script>
<script src="sortButtons.js"></script>
<script src="slideshowModal.js"></script>
<script src="workModalScript.js"></script>



 <script>
    var ARTISTS = <?php echo json_encode($jsonArray, JSON_PRETTY_PRINT); ?>;
    let filteredArtists = ARTISTS.slice(); // Current filtered list (default: all)
    console.log(ARTISTS);
  </script> 






<script>
  
//slideshow variables, php so I left it here, then interval controls

    var images = <?php echo json_encode($images, JSON_PRETTY_PRINT); ?>;
    var current = 0;
    var timer = null;
    var imgElem = document.getElementById('slideshow-img');
    //var captionElem = document.getElementById('slideshow-caption');
    //var prevBtn = document.getElementById('prev-btn');
   // var nextBtn = document.getElementById('next-btn');
    var interval = 77000;

    function showImage(idx) {
      if (!images.length) {
        imgElem.src = '';
        imgElem.alt = 'No photos found';
        captionElem.textContent = 'No photos found in folder.';
        return;
      }
      current = (idx + images.length) % images.length;
      imgElem.src = images[current];
      imgElem.alt = 'Photo ' + (current + 1);
      //captionElem.textContent = 'Photo ' + (current + 1) + ' of ' + images.length;
    }

    function nextImage() { showImage(current + 1); }
    function prevImage() { showImage(current - 1); }

    //prevBtn.onclick = function() { prevImage(); resetTimer(); }
    //nextBtn.onclick = function() { nextImage(); resetTimer(); }

    function startTimer() { if (timer) clearInterval(timer); timer = setInterval(nextImage, interval); }
    function resetTimer() { startTimer(); }

    showImage(0);
    startTimer();

    // Add this JS below your existing slideshow JS
imgElem.onclick = function () {
  showModal(current);
};

function getImageInfo(path) {
  // Example: "p-users/username/work/image.jpg"
  var info = {};
  var parts = path.split('/');
  if (parts.length >= 4) {
    info.userFolder = parts[1]; // username or user folder
    info.filename = parts[3];
    info.relativePath = path;
  } else {
    info.filename = path.split('/').pop();
    info.relativePath = path;
  }
  return info;
}

function showModal(idx) {
  var modal = document.getElementById('slideModal');
  var modalImg = document.getElementById('modalImg');
  var modalInfo = document.getElementById('modalInfo');
  var imgPath = images[idx];
  modalImg.src = imgPath;
  var info = getImageInfo(imgPath);
  // You can expand this info if you have more data
  modalInfo.innerHTML = `
    <div style="font-weight:bold; font-size:1.1em;">${info.filename}</div>
    <div style="color:#777; margin-top:2px;">User Folder: ${info.userFolder ? info.userFolder : 'Unknown'}</div>
    <div style="font-size:0.95em; color:#aaa;">Path: ${info.relativePath}</div>
  `;
  modal.style.display = 'flex';
}

// Close modal on click of close button or background
document.getElementById('closeSlideModal').onclick = function() {
  document.getElementById('slideModal').style.display = 'none';
};
document.getElementById('slideModal').onclick = function(e) {
  if (e.target === this) this.style.display = 'none';
};

</script>


</body>

</html>