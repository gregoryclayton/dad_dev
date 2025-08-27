

// Add this code to your existing slideModal script or as a new script before the closing body tag
document.addEventListener('DOMContentLoaded', function() {
  // Get DOM elements
  const fullscreenContainer = document.getElementById('fullscreenImage');
  const fullscreenImg = document.getElementById('fullscreenImg');
  const closeFullscreenBtn = document.getElementById('closeFullscreen');
  
  // Function to toggle fullscreen mode
  function showFullscreen(imgSrc) {
    fullscreenImg.src = imgSrc;
    fullscreenContainer.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
    
    // Animation effect
    fullscreenImg.style.opacity = '0';
    fullscreenImg.style.transform = 'scale(0.9)';
    setTimeout(() => {
      fullscreenImg.style.opacity = '1';
      fullscreenImg.style.transform = 'scale(1)';
    }, 10);
  }
  
  // Function to close fullscreen
  function closeFullscreen() {
    fullscreenImg.style.opacity = '0';
    fullscreenImg.style.transform = 'scale(0.9)';
    setTimeout(() => {
      fullscreenContainer.style.display = 'none';
      document.body.style.overflow = ''; // Restore scrolling
    }, 200);
  }
  
  // Close fullscreen on X button click
  if (closeFullscreenBtn) {
    closeFullscreenBtn.addEventListener('click', closeFullscreen);
  }
  
  // Close fullscreen on background click
  if (fullscreenContainer) {
    fullscreenContainer.addEventListener('click', function(e) {
      if (e.target === fullscreenContainer || e.target === fullscreenImg) {
        closeFullscreen();
      }
    });
  }
  
  // Close on ESC key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && fullscreenContainer.style.display === 'block') {
      closeFullscreen();
    }
  });
  
  // Connect to modal image
  const modalImg = document.getElementById('modalImg');
  if (modalImg) {
    modalImg.style.cursor = 'zoom-in';
    modalImg.addEventListener('click', function(e) {
      e.stopPropagation(); // Prevent closing the modal
      showFullscreen(this.src);
    });
  }
  
  // Also connect to work card images in the main content
  document.addEventListener('click', function(e) {
    // If it's an image in a work-card that's already in the expanded modal view
    if (e.target.tagName === 'IMG' && e.target.closest('#modalContent')) {
      showFullscreen(e.target.src);
    }
  });
});





// Work card expansion functionality
document.addEventListener('DOMContentLoaded', function() {
  // Set up delegated event listener for work cards
  document.addEventListener('click', function(e) {
    // Find if the clicked element is a work card or an image inside a work card
    const workCard = e.target.closest('.work-card');
    if (!workCard) return;
    
    // Stop event propagation to prevent entry from toggling open/closed
    e.stopPropagation();
    
    // Get the work data
    const title = workCard.querySelector('span')?.textContent || 'Artwork';
    const img = workCard.querySelector('img')?.src || '';
    
    if (!img) return; // No image to show
    
    // Find artist info from parent entry
    const entry = workCard.closest('.artist-entry');
    let artistName = 'Artist';
    if (entry) {
      const firstname = entry.querySelector('.artist-firstname')?.textContent || '';
      const lastname = entry.querySelector('span:nth-child(3)')?.textContent || '';
      artistName = (firstname + ' ' + lastname).trim();
    }
    
    // Populate modal content
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = `
      <div style="display:flex; flex-direction:column; align-items:center;">
        <h2 style="margin-bottom:15px; font-size:24px; color:white;">${title}</h2>
        
        <div style="width:100%; max-width:750px; margin-bottom:20px; text-align:center;">
          <img src="${img}" alt="${title}" 
            style="max-width:100%; max-height:70vh; object-fit:contain; border-radius:10px; box-shadow:0 4px 20px rgba(0,0,0,0.3);">
        </div>
        
        <div style="margin-top:10px; color:#aaa; font-size:16px;">
          By ${artistName}
        </div>
        
        <div style="margin-top:30px;">
          <button id="closeModalBtn" style="background:#e27979; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer; font-size:16px;">Close</button>
        </div>
      </div>
    `;
    
    // Show modal
    const modal = document.getElementById('workModal');
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling while modal is open
    
    // Add event listener to the close button
    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
  });
  
  // Close modal when clicking X button
  const closeBtn = document.getElementById('closeModal');
  if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
  }
  
  // Close modal when clicking outside content
  const modal = document.getElementById('workModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal();
      }
    });
  }
  
  // Close on ESC key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal && modal.style.display === 'block') {
      closeModal();
    }
  });
  
  function closeModal() {
    const modal = document.getElementById('workModal');
    if (modal) {
      modal.style.display = 'none';
      document.body.style.overflow = ''; // Restore scrolling
    }
  }
  
  // Add CSS for animation
  const style = document.createElement('style');
  style.textContent = `
    @keyframes modalFadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .work-card {
      cursor: pointer;
      transition: transform 0.2s ease-in-out;
    }
    .work-card:hover {
      transform: scale(1.03);
    }
  `;
  document.head.appendChild(style);
});
