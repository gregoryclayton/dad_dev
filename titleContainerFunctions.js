
// ...existing scripts...

// --- Title-container popout menu functionality ---
document.addEventListener('DOMContentLoaded', function() {
  var titleContainer = document.getElementById('mainTitleContainer');
  var menu = document.getElementById('titleMenuPopout');
  var closeBtn = document.getElementById('closeTitleMenu');

  function closeMenu() {
    menu.style.display = 'none';
  }

  if (titleContainer && menu) {
    titleContainer.style.cursor = "pointer";
    titleContainer.addEventListener('click', function(e) {
      // Position menu relative to the titleContainer (left, below)
      var rect = titleContainer.getBoundingClientRect();
      menu.style.left = (rect.left + window.scrollX + rect.width + 18) + "px";
      menu.style.top = (rect.top + window.scrollY) + "px";
      menu.style.display = 'block';
    });
  }

  // Close button in menu
  if (closeBtn) {
    closeBtn.onclick = function(e) {
      closeMenu();
    };
  }

  // Clicking anywhere outside the menu closes it
  document.addEventListener('mousedown', function(e) {
    if (menu.style.display === 'block' && !menu.contains(e.target) && !titleContainer.contains(e.target)) {
      closeMenu();
    }
  });

  // Escape key closes menu
  document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeMenu();
  });
});
