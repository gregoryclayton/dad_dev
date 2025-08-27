// Function to make images in the work modal go fullscreen when clicked
document.addEventListener('DOMContentLoaded', function() {
  // Get the fullscreen container elements
  const fullscreenContainer = document.getElementById('fullscreenImage');
  const fullscreenImg = document.getElementById('fullscreenImg');
  const closeFullscreen = document.getElementById('closeFullscreen');
  
  // Close fullscreen when clicking the close button or anywhere on the background
  closeFullscreen.addEventListener('click', function() {
    fullscreenContainer.style.display = 'none';
  });
  
  fullscreenContainer.addEventListener('click', function(e) {
    if (e.target === fullscreenContainer) {
      fullscreenContainer.style.display = 'none';
    }
  });
  
  // Function to handle image clicks in modal content
  function setupModalImageListeners() {
    // Get the modal content where images would be displayed
    const modalContent = document.getElementById('modalContent');
    
    // If modalContent exists, add a click event delegate
    if (modalContent) {
      modalContent.addEventListener('click', function(e) {
        // Check if the clicked element is an image
        if (e.target.tagName === 'IMG') {
          // Display the image in fullscreen
          fullscreenImg.src = e.target.src;
          fullscreenContainer.style.display = 'block';
          
          // Add some animation effect
          fullscreenImg.style.opacity = '0';
          setTimeout(() => {
            fullscreenImg.style.opacity = '1';
          }, 50);
        }
      });
    }
  }
  
  // Run setup immediately and also when workModal is shown
  setupModalImageListeners();
  
  // Also set up the same behavior for the slideModal
  const modalImg = document.getElementById('modalImg');
  if (modalImg) {
    modalImg.addEventListener('click', function() {
      fullscreenImg.src = this.src;
      fullscreenContainer.style.display = 'block';
      
      // Add animation effect
      fullscreenImg.style.opacity = '0';
      setTimeout(() => {
        fullscreenImg.style.opacity = '1';
      }, 50);
    });
  }
});