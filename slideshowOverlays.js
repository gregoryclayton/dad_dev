
    // ... (keep your images, current, timer, etc. definitions)

    // These will overlay the title/date
    var titleElem = document.getElementById('slideshow-title');
    var dateElem = document.getElementById('slideshow-date');

    function getWorkInfoFromImagePath(path) {
      // Try to match image to an artist and work entry in ARTISTS array
      // ARTISTS and their workNlink fields are available via PHP/JS bridge
      var match = {
        title: '',
        date: ''
      };
      if (!path || !window.ARTISTS) return match;
      
      // First try to match with artists' works in the database
      for (var i=0; i<ARTISTS.length; ++i) {
        var a = ARTISTS[i];
        for (var n=1; n<=6; ++n) {
          var link = a['work'+n+'link'];
          if (link && path.indexOf(link.replace(/^\//,'')) !== -1) {
            match.title = a['work'+n] || '';
            match.date = a['date'] || '';
            return match;
          }
        }
      }
      
      // If no match in database, extract a cleaner title from filename
      var filename = path.split('/').pop();
      // Remove file extension
      filename = filename.replace(/\.[^/.]+$/, "");
      // Replace underscores with spaces
      filename = filename.replace(/_/g, " ");
      // Capitalize first letter of each word
      filename = filename.replace(/\b\w/g, function(l){ return l.toUpperCase() });
      
      match.title = filename;
      return match;
    }

    function showImage(idx) {
      if (!images.length) {
        imgElem.src = '';
        imgElem.alt = 'No photos found';
        if(titleElem) titleElem.textContent = '';
        if(dateElem) dateElem.textContent = '';
        return;
      }
      current = (idx + images.length) % images.length;
      var imgPath = images[current];
      imgElem.src = imgPath;
      imgElem.alt = 'Photo ' + (current + 1);
      
      // Overlay title/date only - no path information
      var info = getWorkInfoFromImagePath(imgPath);
      if(titleElem) titleElem.textContent = info.title || '';
      if(dateElem) dateElem.textContent = info.date || '';
    }

    // ... rest of slideshow code (leave as is) ...
