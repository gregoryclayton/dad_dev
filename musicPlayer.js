

// Add this code to your existing scripts section
document.addEventListener('DOMContentLoaded', function() {
  // Music player functionality
  const musicBtn = document.getElementById('musicBtn');
  const musicPlayIcon = document.getElementById('musicPlayIcon');
  const audio = document.getElementById('backgroundMusic');
  let isPlaying = false;
  
  if (musicBtn && audio) {
    musicBtn.addEventListener('click', function(e) {
      e.stopPropagation(); // Prevent dot menu from closing
      
      if (isPlaying) {
        // Stop music
        audio.pause();
        musicPlayIcon.style.display = 'none';
      } else {
        // Start music
        audio.play().catch(error => {
          // Handle autoplay restrictions
          console.log('Playback failed, likely due to autoplay restrictions:', error);
          // Show a message to the user if needed
        });
        musicPlayIcon.style.display = 'block';
      }
      
      isPlaying = !isPlaying;
    });
  }
  
  // Make sure audio has the correct event listeners
  if (audio) {
    // Handle when audio ends naturally (shouldn't happen with loop, but just in case)
    audio.addEventListener('ended', function() {
      isPlaying = false;
      musicPlayIcon.style.display = 'none';
    });
    
    // Handle errors
    audio.addEventListener('error', function() {
      isPlaying = false;
      musicPlayIcon.style.display = 'none';
      console.error('Audio playback error');
    });
  }
});

