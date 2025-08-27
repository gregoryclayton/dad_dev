
   

document.addEventListener('DOMContentLoaded', function() {
  var closeBtn = document.getElementById('closeSlideModal');
  var modal = document.getElementById('slideModal');
  var visitProfileBtn = document.getElementById('visitProfileBtn');
  var modalUserProfile = "";

  if (closeBtn && modal) {
    closeBtn.onclick = function(e) {
      modal.style.display = 'none';
    };
    // Also allow clicking the dark background to close
    modal.onclick = function(e) {
      if (e.target === modal) modal.style.display = 'none';
    };
  }

  if (visitProfileBtn) {
    visitProfileBtn.onclick = function visiting() {
      if (modalUserProfile) {
        window.location.href = 'profile.php?artist=' + encodeURIComponent(modalUserProfile);
      }
    };
  }

  // Updated showModal function with better information display
  window.showModal = function(idx) {
    var modal = document.getElementById('slideModal');
    var modalImg = document.getElementById('modalImg');
    var modalTitle = document.getElementById('modalTitle');
    var modalDate = document.getElementById('modalDate');
    var modalArtist = document.getElementById('modalArtist');
    var imgPath = images[idx];
    
    modalImg.src = imgPath;
    
    // Get enhanced information about the work and artist
    var info = getEnhancedWorkInfo(imgPath);
    
    // Set the information in the modal
    modalTitle.textContent = info.title || 'Untitled Work';
    modalDate.textContent = info.date ? 'Created: ' + info.date : '';
    modalArtist.textContent = info.artistName ? 'By: ' + info.artistName : '';
    
    // Store the user profile for the visit button
    modalUserProfile = info.userFolder || '';
    
    // Display the modal
    modal.style.display = 'flex';
  };

  // Enhanced function to get better work information
  window.getEnhancedWorkInfo = function(path) {
    var info = {
      title: '',
      date: '',
      artistName: '',
      userFolder: ''
    };
    
    // Extract user folder from path (e.g., "p-users/username/work/image.jpg")
    var parts = path.split('/');
    if (parts.length >= 3 && parts[0] === 'p-users') {
      info.userFolder = parts[1];
      
      // Try to convert user folder to artist name (firstname_lastname → Firstname Lastname)
      var nameParts = info.userFolder.split('_');
      if (nameParts.length >= 2) {
        var formattedName = nameParts.map(function(part) {
          return part.charAt(0).toUpperCase() + part.slice(1).toLowerCase();
        }).join(' ');
        info.artistName = formattedName;
      }
    }
    
    // Look for matching work in ARTISTS array for better info
    if (window.ARTISTS) {
      var foundMatch = false;
      
      // First try exact match by path
      for (var i = 0; i < ARTISTS.length; i++) {
        var artist = ARTISTS[i];
        for (var j = 1; j <= 6; j++) {
          var workLink = artist['work' + j + 'link'];
          if (workLink && path.indexOf(workLink.replace(/^\//, '')) !== -1) {
            info.title = artist['work' + j] || '';
            info.date = artist.date || '';
            info.artistName = (artist.firstname + ' ' + artist.lastname).trim();
            foundMatch = true;
            break;
          }
        }
        if (foundMatch) break;
      }
      
      // If no exact match but we have a userFolder, try to match by name
      if (!foundMatch && info.userFolder) {
        for (var i = 0; i < ARTISTS.length; i++) {
          var artist = ARTISTS[i];
          var artistFolder = (artist.firstname + '_' + artist.lastname).toLowerCase();
          artistFolder = artistFolder.replace(/[^a-z0-9_\-]/g, '_');
          
          if (artistFolder === info.userFolder.toLowerCase()) {
            info.date = artist.date || '';
            info.artistName = (artist.firstname + ' ' + artist.lastname).trim();
            break;
          }
        }
      }
    }
    
    // If we still don't have a title, extract one from the filename
    if (!info.title && parts.length > 0) {
      var filename = parts[parts.length - 1];
      // Remove extension and format nicely
      filename = filename.replace(/\.[^/.]+$/, "");
      filename = filename.replace(/_/g, " ");
      // Capitalize first letter of each word
      filename = filename.replace(/\b\w/g, function(l) { 
        return l.toUpperCase(); 
      });
      info.title = filename;
    }
    
    return info;
  };

  // Attach to slideshow image (if not already)
  var imgElem = document.getElementById('slideshow-img');
  if (imgElem) {
    imgElem.onclick = function() {
      var current = window.current || 0;
      window.showModal(current);
    };
  }
});
