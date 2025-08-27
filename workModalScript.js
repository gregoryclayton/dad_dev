// Add this to your existing JavaScript files or in a script tag at the bottom
document.addEventListener('DOMContentLoaded', function() {
  // Gallery pagination
  const galleryItems = document.querySelectorAll('.gallery-item');
  const itemsPerPage = 12;
  const totalPages = Math.ceil(galleryItems.length / itemsPerPage);
  let currentPage = 1;
  
  const prevButton = document.getElementById('prevGalleryPage');
  const nextButton = document.getElementById('nextGalleryPage');
  const pageInfo = document.getElementById('galleryPageInfo');
  
  // Update page info
  function updatePageInfo() {
    if (pageInfo) {
      pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
    }
    
    // Update button states
    if (prevButton) {
      prevButton.disabled = currentPage === 1;
      prevButton.style.opacity = currentPage === 1 ? '0.5' : '1';
    }
    
    if (nextButton) {
      nextButton.disabled = currentPage === totalPages;
      nextButton.style.opacity = currentPage === totalPages ? '0.5' : '1';
    }
  }
  
  // Show items for current page
  function showCurrentPageItems() {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    
    galleryItems.forEach((item, index) => {
      item.style.display = (index >= startIndex && index < endIndex) ? 'block' : 'none';
    });
    
    updatePageInfo();
  }
  
  // Initialize
  if (galleryItems.length > 0) {
    showCurrentPageItems();
    
    // Add event listeners to buttons
    if (prevButton) {
      prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
          currentPage--;
          showCurrentPageItems();
        }
      });
    }
    
    if (nextButton) {
      nextButton.addEventListener('click', function() {
        if (currentPage < totalPages) {
          currentPage++;
          showCurrentPageItems();
        }
      });
    }
  }
});

// Function to show gallery work in modal
function showGalleryWork(workElement) {
  // Get data from the work element
  const artist = workElement.getAttribute('data-artist');
  const title = workElement.getAttribute('data-title');
  const image = workElement.getAttribute('data-image');
  const description = workElement.getAttribute('data-description');
  const date = workElement.getAttribute('data-date');
  const likes = workElement.getAttribute('data-likes');
  
  // Use existing slide modal
  const modal = document.getElementById('slideModal');
  const modalImg = document.getElementById('modalImg');
  const modalTitle = document.getElementById('modalTitle');
  const modalDate = document.getElementById('modalDate');
  const modalArtist = document.getElementById('modalArtist');
  const visitProfileBtn = document.getElementById('visitProfileBtn');
  
  // Set modal content
  modalImg.src = image;
  modalTitle.textContent = title;
  modalDate.textContent = date || '';
  modalArtist.textContent = artist;
  
  // Set up the visit profile button
  visitProfileBtn.onclick = function() {
    window.location.href = 'profile.php?user=' + encodeURIComponent(artist);
  };
  
  // Show modal
  modal.style.display = 'flex';
}