<?php
// This PHP script finds the top 10 most frequently selected works
// across all user profiles and displays them in a horizontally scrolling flexbox gallery
// with modal pop-outs when cards are clicked and detailed info in the modal only.

$baseDir = __DIR__ . '/p-users';
$workCounts = [];
$workDetails = [];

// Get all subdirectories in "p-users"
$subfolders = glob($baseDir . '/*', GLOB_ONLYDIR);

foreach ($subfolders as $subfolder) {
    $profilePath = $subfolder . '/profile.json';
    if (file_exists($profilePath)) {
        $jsonData = file_get_contents($profilePath);
        $profile = json_decode($jsonData, true);

        if (isset($profile['selected_works']) && is_array($profile['selected_works'])) {
            foreach ($profile['selected_works'] as $work) {
                $workKey = $work['path'];
                if (!isset($workCounts[$workKey])) {
                    $workCounts[$workKey] = 0;
                    $workDetails[$workKey] = $work;
                    $workDetails[$workKey]['user_folder'] = basename($subfolder);
                }
                $workCounts[$workKey]++;
            }
        }
    }
}

// Sort works by count descending
arsort($workCounts);

// Get top 10 works
$topWorks = array_slice(array_keys($workCounts), 0, 10);

// Prepare works data for JS modal
$topWorksData = [];
foreach ($topWorks as $workPath) {
    $work = $workDetails[$workPath];
    $work['selected_count'] = $workCounts[$workPath];
    $topWorksData[] = $work;
}
?>

<!-- Modal HTML, place near bottom of page or just below this gallery snippet -->
<div id="selectedWorksModal" style="display:none; position:fixed; z-index:10000; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.85); align-items:center; justify-content:center;">
  <div id="selectedWorksModalContent" style="background:#fff; border-radius:14px; padding:36px 28px; max-width:90vw; max-height:90vh; box-shadow:0 8px 32px #0005; display:flex; flex-direction:column; align-items:center; position:relative;">
    <span id="closeSelectedWorksModal" style="position:absolute; top:16px; right:24px; color:#333; font-size:28px; font-weight:bold; cursor:pointer;">&times;</span>
    <img id="selectedWorksModalImg" src="" alt="" style="max-width:80vw; max-height:60vh; border-radius:8px; margin-bottom:22px;">
    <div id="selectedWorksModalInfo" style="text-align:center; width:100%;"></div>
    <a id="selectedWorksModalProfileBtn" href="#" style="display:inline-block; margin-top:18px; background:#e8bebe; border:none; border-radius:7px; padding:0.7em 2em; font-family:monospace; font-size:1em; color:black; text-decoration:none; cursor:pointer;">visit profile</a>
  </div>
</div>

<!-- Place this div below the slideshow in your main HTML file (e.g., v4.5_Version2.php) -->
<div id="selectedWorksGallery" style="
    width:90vw;
    margin:2em auto 0 auto;
    display:flex;
    flex-direction:row;
    gap:40px;
    color:black;
    align-items:stretch;
    overflow-x:auto;
    padding-bottom:16px;
    scrollbar-width:thin;
    scrollbar-color:#e27979 #f9f9f9;
">
<?php foreach ($topWorks as $i => $workPath):
    $work = $workDetails[$workPath];
    ?>
    <div class="selected-work-card" 
         data-idx="<?php echo $i; ?>" 
         style="cursor:pointer; min-width:260px; max-width:320px; flex:0 0 auto; background:#f9f9f9; border-radius:14px; box-shadow:0 4px 14px #0001; padding:20px; text-align:center; display:flex; flex-direction:column; align-items:center; transition:box-shadow 0.2s;">
        <img src="<?php echo htmlspecialchars($work['path']); ?>" alt="<?php echo htmlspecialchars($work['title']); ?>" style="width:100%; max-width:280px; max-height:220px; object-fit:cover; border-radius:10px; box-shadow:0 2px 8px #0002;">
        <div style="margin-top:12px;font-size:1.15em;font-weight:bold;">
            <?php echo htmlspecialchars($work['title']); ?>
        </div>
        <!-- Only work name shown in gallery! -->
    </div>
<?php endforeach; ?>
</div>

<script>
// Prepare data for JS
const selectedWorksData = <?php echo json_encode($topWorksData, JSON_PRETTY_PRINT); ?>;

// Modal logic
document.querySelectorAll('.selected-work-card').forEach(card => {
    card.addEventListener('click', function(e) {
        const idx = parseInt(card.getAttribute('data-idx'));
        const work = selectedWorksData[idx];

        document.getElementById('selectedWorksModalImg').src = work.path;
        document.getElementById('selectedWorksModalImg').alt = work.title;

        let infoHtml = `
            <div style="font-weight:bold; font-size:1.2em;">${work.title}</div>
            <div style="color:#e27979; margin-top:6px;">Selected ${work.selected_count} times</div>
            <div style="color:#555; font-size:1em; margin-top:8px;">${work.artist}</div>
            <div style="color:#888; margin-top:2px; font-size:0.95em;">${work.date ? work.date : (work.timestamp ? (new Date(work.timestamp)).toLocaleDateString() : '')}</div>
            <div style="color:#aaa; font-size:0.92em; margin-top:8px;">${work.user_folder}</div>
            <div style="color:#aaa; font-size:0.92em; margin-top:8px;">${work.path}</div>
        `;
        document.getElementById('selectedWorksModalInfo').innerHTML = infoHtml;

        // Set profile link in modal
        document.getElementById('selectedWorksModalProfileBtn').href = 'profile.php?artist=' + encodeURIComponent(work.user_folder);

        document.getElementById('selectedWorksModal').style.display = 'flex';
    });
});

// Close modal logic
document.getElementById('closeSelectedWorksModal').onclick = function() {
    document.getElementById('selectedWorksModal').style.display = 'none';
};
document.getElementById('selectedWorksModal').onclick = function(e) {
    if (e.target === this) this.style.display = 'none';
};
</script>