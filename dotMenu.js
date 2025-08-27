
document.addEventListener('DOMContentLoaded', function() {
  const dot = document.getElementById('dot');
  const menu = document.getElementById('dotMenu');
  let expanded = false;

  dot.addEventListener('click', function(e) {
    expanded = !expanded;
    if (expanded) {
      dot.classList.add('expanded');
      menu.style.display = 'block';
      setTimeout(()=>menu.style.opacity="1", 10); // fade in
    } else {
      dot.classList.remove('expanded');
      menu.style.opacity="0";
      setTimeout(()=>menu.style.display="none", 300);
    }
    e.stopPropagation();
  });

  // Clicking outside dot/menu closes it
  document.addEventListener('mousedown', function(e) {
    if (expanded && !dot.contains(e.target) && !menu.contains(e.target)) {
      dot.classList.remove('expanded');
      menu.style.opacity="0";
      setTimeout(()=>menu.style.display="none", 300);
      expanded = false;
    }
  });

  // ESC closes menu
  document.addEventListener('keydown', function(e) {
    if (expanded && e.key === 'Escape') {
      dot.classList.remove('expanded');
      menu.style.opacity="0";
      setTimeout(()=>menu.style.display="none", 300);
      expanded = false;
    }
  });
});


