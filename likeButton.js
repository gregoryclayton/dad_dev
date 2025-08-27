
// ...existing modal code...

// Replace the existing radio input event handler with this enhanced version
document.addEventListener('DOMContentLoaded', function() {
  var radio = document.getElementById('slideWorkRadio');
  var slideModal = document.getElementById('slideModal');
  
  if (radio) {
    radio.onclick = function(e) {
      // Check if user is signed in
      const isLoggedIn = !radio.hasAttribute('disabled');
      
      if (!isLoggedIn) {
        e.preventDefault();
        alert('Please sign in to like artwork.');
        return false;
      }
      
      // Get the current image and information
      const modalImg = document.getElementById('modalImg');
      const modalTitle = document.getElementById('modalTitle');
      const modalArtist = document.getElementById('modalArtist');
      const modalDate = document.getElementById('modalDate');
      
      if (!modalImg || !modalImg.src) {
        console.error('No image source found');
        return;
      }
      
      // Prepare the work data to save
      const workData = {
        path: modalImg.src,
        title: modalTitle ? modalTitle.textContent : 'Untitled',
        artist: modalArtist ? modalArtist.textContent.replace('By: ', '') : 'Unknown',
        date: modalDate ? modalDate.textContent.replace('Created: ', '') : '',
        timestamp: new Date().toISOString()
      };
      
      // Show visual feedback that selection is being saved
      radio.style.opacity = '0.7';
      
      // Save the selection via AJAX
      saveSelection(workData)
        .then(response => {
          // Selection successful
          radio.style.opacity = '1';
          radio.style.accentColor = '#4CAF50'; // Change color to green for success
          
          // Reset after a moment
          setTimeout(() => {
            radio.style.accentColor = '#e27979';
          }, 2000);
        })
        .catch(error => {
          console.error('Error saving selection:', error);
          alert('There was a problem saving your selection. Please try again.');
          radio.style.opacity = '1';
        });
    }
  }
  
  // Function to save selection via AJAX
  function saveSelection(workData) {
    return new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'save_selection.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      
      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
          try {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
              resolve(response);
            } else {
              reject(response.message || 'Unknown error occurred');
            }
          } catch (e) {
            reject('Invalid response from server');
          }
        } else {
          reject('Request failed with status: ' + xhr.status);
        }
      };
      
      xhr.onerror = function() {
        reject('Network error occurred');
      };
      
      // Send the data
      xhr.send('workData=' + encodeURIComponent(JSON.stringify(workData)));
    });
  }
});
