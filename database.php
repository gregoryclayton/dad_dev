<?php

// Replace with your actual database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'mysql';

// Now fetch and display all users
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$result = $conn->query("SELECT id, firstname, lastname, date, genre, country, bio, pp, fact1, fact2, fact3, link1, link2, link3, work1, work1link, work2, work2link, work3, work3link, work4, work4link, work5, work5link, work6, work6link FROM users ORDER BY id DESC");

// Create json array from fetched data
$jsonArray = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jsonArray[] = [
            "id" => $row["id"],
            "firstname" => $row["firstname"],
            "lastname" => $row["lastname"],
            "date" => $row["date"],
            "genre" => $row["genre"],
            "country" => $row["country"],
            "fact1" => $row["fact1"],
            "fact2" => $row["fact2"],
            "fact3" => $row["fact3"],
            "bio" => $row["bio"],
            "pp" => $row["pp"],
            "link1" => $row["link1"],
            "link2" => $row["link2"],
            "link3" => $row["link3"],
            "work1" => $row["work1"],
            "work1link" => $row["work1link"],
            "work2" => $row["work2"],
            "work2link" => $row["work2link"],
            "work3" => $row["work3"],
            "work3link" => $row["work3link"],
            "work4" => $row["work4"],
            "work4link" => $row["work4link"],
            "work5" => $row["work5"],
            "work5link" => $row["work5link"],
            "work6" => $row["work6"],
            "work6link" => $row["work6link"]
        ];
    }
}
?>

<?php

session_start();
$signin_error = "";
$signin_success = false;

// Handle sign in POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin_email'], $_POST['signin_pword'])) {
    $signin_email = trim($_POST['signin_email']);
    $signin_pword = trim($_POST['signin_pword']);

    // Simple lookup (do NOT use plain passwords in production!)
    $conn2 = new mysqli($host, $user, $password, $database);
    if ($conn2->connect_error) {
        $signin_error = 'Connection failed.';
    } else {
        $stmt = $conn2->prepare("SELECT id, firstname, lastname FROM pusers WHERE email=? AND pword=? LIMIT 1");
        $stmt->bind_param("ss", $signin_email, $signin_pword);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($user = $result->fetch_assoc()) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_firstname'] = $user['firstname'];
            $_SESSION['user_lastname'] = $user['lastname'];
            $signin_success = true;
        } else {
            $signin_error = "Email or password is incorrect.";
        }
        $stmt->close();
        $conn2->close();
    }
}

?>

<?php
$photoDir = __DIR__ . '/slideworks';
$images = [];
if (is_dir($photoDir)) {
    $files = scandir($photoDir);
    foreach ($files as $file) {
        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
            $images[] = 'slideworks/' . $file;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>digital artist database</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>




<div style="display:flex;">
  <div class="title-container" id="mainTitleContainer" style="background-image: linear-gradient(135deg, #e27979 60%, #ed8fd1 100%); transition: background-image 0.7s;">
    <br>
    <a href="index.php" style="text-decoration:none; color: white;">digital <br>artist <br>database</a>
  </div>
  
   <div id="dotMenuContainer" style="position:relative; align-self:end; margin-bottom:50px; margin-left:-30px;">
    <div id="dot" style="color:black; background: linear-gradient(135deg, #e27979 60%, #ed8fd1 100%); transition: background 0.7s;"></div>
    <div id="dotMenu" style="display:none; position:absolute; left:50%; top:-380%; transform:translateX(-50%); background-image: linear-gradient(to bottom right, rgba(226, 121, 121, 0.936), rgba(237, 143, 209, 0.936)); border-radius:50%; box-shadow:0 4px 24px #0002; padding:1.4em 2em; min-width:120px; z-index:1000;">
      <!-- Your menu content here -->
      <a href="v4.5.php" style="color:#777; text-decoration:none; display:block; margin-bottom:0.5em;">Home</a>
      <a href="about.php" style="color:#777; text-decoration:none; display:block; margin-bottom:0.5em;">About</a>
      <a href="signup.php" style="color:#b44; text-decoration:none; display:block; margin-bottom:0.5em;">Sign Up</a>
      <a href="contribute.php" style="color:#a56; text-decoration:none; display:block; margin-bottom:0.5em;">Contribute</a>
      <a href="database.php" style="color:#555; text-decoration:none; display:block; margin-bottom:0.5em;">Database</a>
      <a href="studio.php" style="color:#777; text-decoration:none; display:block;">Studio</a>
      <!-- New buttons for changing color -->
      <button id="changeTitleBgBtn" style="margin-top:1em; background:#e27979; color:#fff; border:none; border-radius:8px; padding:0.6em 1.1em; font-family:monospace; font-size:1em; cursor:pointer; display:block; width:100%;">Change Colors</button>
      <button id="bwThemeBtn" style="margin-top:0.7em; background:#232323; color:#fff; border:none; border-radius:8px; padding:0.6em 1.1em; font-family:monospace; font-size:1em; cursor:pointer; display:block; width:100%;">Black & White Theme</button>
    </div>
  </div>
  <p style="color:black; font-size:15px; margin-left:10px; align-self:end;">[alpha]</p>
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
  <?php if (isset($_SESSION['user_id'])): ?>
    <span class="signed-in">Signed in as <?php echo htmlspecialchars($_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']); ?></span>
    <form method="post" style="margin:0;">
      <input type="hidden" name="signout" value="1" />
      <input type="submit" value="Sign Out" />
    </form>
  <?php else: ?>
    <form method="post" autocomplete="off">
      <input type="email" style="width:100px;" name="signin_email" required placeholder="email" />
      <input type="password" style="width:100px;" name="signin_pword" required placeholder="password" />
      <input type="submit" value="sign in" />
    </form>
    <?php if ($signin_error): ?>
      <span class="signin-msg"><?php echo htmlspecialchars($signin_error); ?></span>
    <?php elseif ($signin_success): ?>
      <span class="signin-msg signin-success">Signed in!</span>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php
// Handle signout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signout'])) {
    session_destroy();
    header("Location: v4.5.php");
    exit;
}
?>

<br>

 <div style="display:flex; align-content:center; justify-content:center;">
    <div class="nav-button"><a href="signup.php">[sign up]</a></div><div class="nav-button"><a href="contribute.php">[contribute]</a></div><div class="nav-button"><a href="database.php">[database]</a></div><div class="nav-button"><a href="studio.php">[studio]</a></div>
  </div>

 
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


  <script async
  src="https://js.stripe.com/v3/buy-button.js">
</script>

 
  
  <div style="max-width:70vw; margin:2em auto; font-family:Segoe UI,Arial,sans-serif;">
    <button id="payBtn" style="width:100%;  box-shadow: 0 2px 10px #0004; trnsition:1s;  background-color: rgb(235, 168, 168); color:black; border:none; padding:0.7em 0; border-radius:8px; font-size:1em; cursor:pointer;">
      donate to the digital artist database
    </button>
    <div id="paymentPortal" style="display:none; margin-top:1em;  background-color: rgb(235, 168, 168); border-radius:10px; box-shadow:0 2px 8px #eee; padding:1.2em; text-align:center;">
      <stripe-buy-button
  buy-button-id="buy_btn_1RBP8wDKJyMVPD6MNwafC65z"
  publishable-key="pk_live_bcx2iXYjvNT7kmVPZ6k9P3Qy"
 style="opacity: 0.5;">
</stripe-buy-button>
    </div>
  </div>


  

  <footer style="background:#222; color:#eee; padding:2em 0; text-align:center; font-size:0.95em;">
  <div style="margin-bottom:1em;">
    <nav>
      <a href="/index.php" style="color:#eee; margin:0 15px; text-decoration:none;">Home</a>
      <a href="/signup.php.html" style="color:#eee; margin:0 15px; text-decoration:none;">Sign Up</a>
      <a href="/contribute.php" style="color:#eee; margin:0 15px; text-decoration:none;">Contribute</a>
      <a href="/database.php" style="color:#eee; margin:0 15px; text-decoration:none;">Database</a>
      
    </nav>
  </div>
  <div style="margin-bottom:1em;">
    <a href="https://twitter.com/" target="_blank" rel="noopener" style="margin:0 8px;">
      <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/twitter.svg" alt="Twitter" height="22" style="vertical-align:middle; filter:invert(1);">
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



<script>
    document.getElementById('payBtn').onclick = function() {
      var portal = document.getElementById('paymentPortal');
      portal.style.display = (portal.style.display === 'none' || portal.style.display === '') ? 'block' : 'none';
    };
  </script>


<script>
    var images = <?php echo json_encode($images, JSON_PRETTY_PRINT); ?>;
    var current = 0;
    var timer = null;
    var imgElem = document.getElementById('slideshow-img');
    //var captionElem = document.getElementById('slideshow-caption');
    //var prevBtn = document.getElementById('prev-btn');
   // var nextBtn = document.getElementById('next-btn');
    var interval = 10000;

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
  </script>

  <script>
    var ARTISTS = <?php echo json_encode($jsonArray, JSON_PRETTY_PRINT); ?>;
    let filteredArtists = ARTISTS.slice(); // Current filtered list (default: all)
    console.log(ARTISTS); // You can use ARTISTS in your JS code
  </script>

  <script>
    function getArtist(index) {
      if (index < filteredArtists.length) return filteredArtists[index];
      let base = filteredArtists[index % filteredArtists.length];
      return base;
    }

    const container = document.getElementById('container');
    let loadedCount = 0;
    const BATCH_SIZE = 8;
    let openIndex = null;
    let isLoading = false;

    function renderArtist(index) {
      const artist = getArtist(index);
      const entry = document.createElement('div');
      entry.className = 'artist-entry';
      entry.setAttribute('data-idx', index);

      entry.innerHTML = `
        <img class="artist-pp" src="${artist.pp}" alt="Artist" />
        <span class="artist-firstname">${artist.firstname || ""}</span>
        <span class="artist-firstname">${artist.lastname || ""}</span>
        <span class="artist-date">${artist.date || ""}</span>
        <span class="artist-country">${artist.country || ""}</span>
        <span class="artist-genre">${artist.genre || ""}</span>
        
        <div class="dropdown">

        <div style="display: flex; align-items: center; background: #f5f7fa; padding: 1em 1.5em; border-radius: 12px; ">
          <img src="${artist.pp}" alt="Profile Picture" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-right: 1.5em; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
          <ul style="list-style: disc inside; margin: 0; padding: 0;">
             <li style="font-family: sans-serif;">${artist.fact1 || ""}</li>
             <li style="font-family: sans-serif;">${artist.fact2 || ""}</li>
             <li style="font-family: sans-serif;">${artist.fact3 || ""}</li>
          </ul>
          
       </div>

       <br>

          <div style="font-family: sans-serif;">${artist.bio || ""}</div>

      <br>
          
          <div class="work-container">
            <div class="works-list">
             <div class="work-card">
                <span style="width:300px;">${artist.work1}</span>
                ${artist.work1link ? `<img src="${artist.work1link}" loading="lazy" alt=""/>` : ''}
              </div>
            <div class="work-card">
                <span style="width:300px;">${artist.work2}</span>
                ${artist.work2link ? `<img src="${artist.work2link}" loading="lazy" alt=""/>` : ''}
              </div>
            <div class="work-card">
                <span style="width:300px;">${artist.work3}</span>
                ${artist.work3link ? `<img src="${artist.work3link}" loading="lazy" alt=""/>` : ''}
              </div>
            <div class="work-card">
                <span style="width:300px;">${artist.work4}</span>
                ${artist.work4link ? `<img src="${artist.work4link}" loading="lazy" alt=""/>` : ''}
              </div>
            <div class="work-card">
                <span style="width:300px;">${artist.work5}</span>
                ${artist.work5link ? `<img src="${artist.work5link}" loading="lazy" alt=""/>` : ''}
              </div>
            <div class="work-card">
                <span style="width:300px;">${artist.work6}</span>
                ${artist.work6link ? `<img src="${artist.work6link}" loading="lazy" alt=""/>` : ''}
              </div>
            </div>
          </div>

             <p style="padding:5px; cursor:pointer; color:blue; text-decoration:underline;" onclick="window.location.href='profile.php?artist=${artist.firstname}_${artist.lastname}'">
            visit profile
            </p>

          <div class="links-container">
          <a href="https://www.google.com" target="_blank" rel="noopener">Visit Google</a>
         <a class="artist-link1" href="${artist.link1}">${artist.link1 || ""}</a>
         <span class="artist-link2">${artist.link2 || ""}</span>
         <span class="artist-link3">${artist.link3 || ""}</span>
         </div>

         <br>


        </div>
      `;
      entry.addEventListener('click', function(e) {
        if (
          e.target.classList.contains('work-card') ||
          e.target.tagName === 'IMG' || 
          e.target.closest('.dropdown')
        ) return;
        entry.classList.toggle('open');
      });
      return entry;
    }

    function clearContainer() {
      container.innerHTML = '';
      loadedCount = 0;
    }

    function loadMore() {
      if (isLoading) return;
      isLoading = true;
      for (let i=loadedCount; i<loadedCount+BATCH_SIZE && i<filteredArtists.length; i++) {
        container.appendChild(renderArtist(i));
      }
      loadedCount += BATCH_SIZE;
      isLoading = false;
    }

    container.addEventListener('scroll', function() {
      if (container.scrollTop + container.clientHeight >= container.scrollHeight - 80) {
        loadMore();
      }
    });

    function fillToScreen() {
      if (container.scrollHeight < window.innerHeight+80 && loadedCount < filteredArtists.length) {
        loadMore();
        setTimeout(fillToScreen, 10);
      }
    }

    // Initial fill
    loadMore();
    setTimeout(fillToScreen, 10);

    // ----------- ALPHABETICAL SORT BUTTON FUNCTIONALITY ----------
    document.getElementById('sortAlphaBtn').onclick = function() {
      filteredArtists.sort(function(a, b) {
        var lnameA = (a.lastname || '').toLowerCase();
        var lnameB = (b.lastname || '').toLowerCase();
        if (lnameA < lnameB) return -1;
        if (lnameA > lnameB) return 1;
        var fnameA = (a.firstname || '').toLowerCase();
        var fnameB = (b.firstname || '').toLowerCase();
        if (fnameA < fnameB) return -1;
        if (fnameA > fnameB) return 1;
        return 0;
      });
      clearContainer();
      loadMore();
      setTimeout(fillToScreen, 10);
    };

    // ----------- DATE SORT BUTTON FUNCTIONALITY ----------
    document.getElementById('sortDateBtn').onclick = function() {
      filteredArtists.sort(function(a, b) {
        var dateA = Date.parse(a.date) || 0;
        var dateB = Date.parse(b.date) || 0;
        if (dateA && dateB) {
          return dateA - dateB;
        } else {
          var strA = (a.date || '').toLowerCase();
          var strB = (b.date || '').toLowerCase();
          if (strA < strB) return -1;
          if (strA > strB) return 1;
          return 0;
        }
      });
      clearContainer();
      loadMore();
      setTimeout(fillToScreen, 10);
    };

    // ----------- COUNTRY SORT BUTTON FUNCTIONALITY ----------
    document.getElementById('sortCountryBtn').onclick = function() {
      filteredArtists.sort(function(a, b) {
        var countryA = (a.country || '').toLowerCase();
        var countryB = (b.country || '').toLowerCase();
        if (countryA < countryB) return -1;
        if (countryA > countryB) return 1;
        return 0;
      });
      clearContainer();
      loadMore();
      setTimeout(fillToScreen, 10);
    };

    // ----------- gENRE SORT BUTTON FUNCTIONALITY ----------
    document.getElementById('sortGenreBtn').onclick = function() {
      filteredArtists.sort(function(a, b) {
        var genreA = (a.genre || '').toLowerCase();
        var genreB = (b.genre || '').toLowerCase();
        if (genreA < genreB) return -1;
        if (genreA > genreB) return 1;
        return 0;
      });
      clearContainer();
      loadMore();
      setTimeout(fillToScreen, 10);
    };

    // ----------- SEARCH BAR FUNCTIONALITY -----------
    const searchBar = document.getElementById('artistSearchBar');
    searchBar.addEventListener('input', function() {
      const query = searchBar.value.trim().toLowerCase();
      if (query === '') {
        filteredArtists = ARTISTS.slice();
      } else {
        filteredArtists = ARTISTS.filter(function(artist) {
          return (
            (artist.firstname && artist.firstname.toLowerCase().includes(query)) ||
            (artist.lastname && artist.lastname.toLowerCase().includes(query)) ||
            (artist.country && artist.country.toLowerCase().includes(query)) ||
            (artist.genre && artist.genre.toLowerCase().includes(query)) ||
            (artist.bio && artist.bio.toLowerCase().includes(query)) ||
            (artist.fact1 && artist.fact1.toLowerCase().includes(query)) ||
            (artist.fact2 && artist.fact2.toLowerCase().includes(query)) ||
            (artist.fact3 && artist.fact3.toLowerCase().includes(query)) ||
            (artist.date && artist.date.toLowerCase().includes(query))
          );
        });
      }
      clearContainer();
      loadMore();
      setTimeout(fillToScreen, 10);
    });

    // --------------------- Add Artist Modal ---------------------
    const addArtistBtn = document.getElementById('addArtistBtn');
    const addArtistFormOverlay = document.getElementById('addArtistFormOverlay');
    const addArtistForm = document.getElementById('addArtistForm');
    const worksListDiv = document.getElementById('worksList');
    const addWorkBtn = document.getElementById('addWorkBtn');
    const cancelArtistBtn = document.getElementById('cancelArtistBtn');

    let workFields = [];

    addArtistBtn.onclick = function() {
      addArtistFormOverlay.style.display = 'flex';
      addArtistForm.reset();
      worksListDiv.innerHTML = '';
      workFields = [];
      addWorkField();
      document.getElementById('artistName').focus();
    };

    cancelArtistBtn.onclick = function() {
      addArtistFormOverlay.style.display = 'none';
    };
    addArtistFormOverlay.onclick = function(e) {
      if (e.target === addArtistFormOverlay) addArtistFormOverlay.style.display = 'none';
    };

    function addWorkField(defaults={}) {
      const idx = workFields.length;
      const div = document.createElement('div');
      div.className = 'works-list-entry';
      div.innerHTML = `
        <input type="text" required maxlength="60" placeholder="Work Title" value="${defaults.title||''}" style="margin-bottom:0.2em;width:43%;" />
        <input type="text" maxlength="250" placeholder="Image URL (optional)" value="${defaults.img||''}" style="margin-bottom:0.2em;width:50%;" />
        <button type="button" class="removeWorkBtn" title="Remove work">×</button>
      `;
      const [titleField, imgField, removeBtn] = div.children;
      removeBtn.onclick = function() {
        worksListDiv.removeChild(div);
        workFields = workFields.filter(f => f !== fieldObj);
      };
      worksListDiv.appendChild(div);
      const fieldObj = {titleField, imgField, div};
      workFields.push(fieldObj);
    }

    addWorkBtn.onclick = function(e) {
      addWorkField();
    };

    addArtistForm.onsubmit = function(e) {
      e.preventDefault();
      const name = document.getElementById('artistName').value.trim();
      const years = document.getElementById('artistYears').value.trim();
      const bio = document.getElementById('artistBio').value.trim();
      if (!name || !bio) return;

      const works = [];
      for (const wf of workFields) {
        const title = wf.titleField.value.trim();
        const img = wf.imgField.value.trim();
        if (!title) continue;
        works.push({title, img});
      }
      if (works.length === 0) {
        alert('Please add at least one work.');
        return;
      }
      ARTISTS.unshift({name, years, bio, works});
      filteredArtists = ARTISTS.slice();
      clearContainer();
      loadMore();
      setTimeout(fillToScreen, 10);
      addArtistFormOverlay.style.display = 'none';
      setTimeout(()=>{
        container.firstChild.classList.add('open');
        container.firstChild.scrollIntoView({behavior:'smooth', block:'center'});
      }, 80);
    };
  </script>
<!--
<script>
    // background-fader.js
// Gradually transitions the background color from one random color to another on page load.

function randomColor() {
  // Generate a random color in rgb format
  const r = Math.floor(Math.random() * 256)
  const g = Math.floor(Math.random() * 256)
  const b = Math.floor(Math.random() * 256)
  return { r, g, b }
}

function colorToString({ r, g, b }) {
  return `rgb(${r},${g},${b})`
}

function lerp(a, b, t) {
  // Linear interpolation between a and b
  return a + (b - a) * t
}

function lerpColor(c1, c2, t) {
  return {
    r: Math.round(lerp(c1.r, c2.r, t)),
    g: Math.round(lerp(c1.g, c2.g, t)),
    b: Math.round(lerp(c1.b, c2.b, t))
  }
}

window.onload = function () {
  const startColor = randomColor()
  const endColor = randomColor()
  let t = 0
  const duration = 20000 // ms (2 seconds)
  const interval = 20 // ms per frame
  const steps = duration / interval

  function step() {
    t += 1 / steps
    if (t > 1) t = 1
    const currentColor = lerpColor(startColor, endColor, t)
    document.body.style.backgroundColor = colorToString(currentColor)
    if (t < 1) {
      setTimeout(step, interval)
    }
  }
  step()
}
</script>
-->

</body>

</html>