
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

     

    function getProfileFolderName(artist) {
  // Should match PHP's: strtolower(firstname_lastname), non-alphanumeric replaced by _
  let folder = (artist.firstname + '_' + artist.lastname).toLowerCase();
  return folder.replace(/[^a-z0-9_\-]/g, '_');
}

  

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

