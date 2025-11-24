<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset'])) {
    reset_timeline();
    header('Location: index.php');
    exit;
}

include 'header.php';
?>
<section class="hero">

<!-- LEFT: CTHULHU IMAGE -->
<div class="hero_art">
  <img src="cthulu.png" alt="Colossal Cthulhu rising from the ocean" class="hero_cthulhu" />
</div>

<!-- RIGHT: TEXT + DOORS -->
<div class="hero_cont">

  <h1 class="hero_titl typewriter">
    Cthulu has awoken from his long slumber..
  </h1>

  <p class="hero_subtitl handwritten">
    He has made a puzzle to test you before he feasts on your mind.
    Enter three eras, each questioning your ability to remeber the previous one.
    Using your knowledge and timeliness, escape this puzzle before Cthulu takes over your mind.
  </p>

  <!-- DOOR STATUS CARDS -->
  <div class="hero_drs">

    <!-- PAST -->
    <div class="door_crd">
      <div class="door_lbl">Past : SS Santa Maria (Wreck)</div>
      <div class="door_stat">
        <?php
          if ($_SESSION['past_map_solved'] && $_SESSION['past_year_solved']) {
              echo 'Status: <span class="status-complete">Fully charted</span>';
          } elseif ($_SESSION['past_map_solved']) {
              echo 'Status: <span class="status-partial">Map found, year unknown</span>';
          } else {
              echo 'Status: <span class="status-locked">Lost beneath the waves</span>';
          }
        ?>
      </div>
    </div>

    <!-- PRESENT -->
    <div class="door_crd">
      <div class="door_lbl">Present : Cruise Ship Deck</div>
      <div class="door_stat">
        <?php
          if ($_SESSION['present_solved']) {
              echo 'Status: <span class="status-complete">Artifact harmonized</span>';
          } else {
              echo 'Status: <span class="status-locked">Surface-level ignorance</span>';
          }
        ?>
      </div>
    </div>

    <!-- FUTURE -->
    <div class="door_crd">
      <div class="door_lbl">Future : Drowned Earth</div>
      <div class="door_stat">
        <?php
          if ($_SESSION['future_paradox_solved']) {
              echo 'Status: <span class="status-complete">Paradox escaped</span>';
          } elseif ($_SESSION['future_beacon_solved']) {
              echo 'Status: <span class="status-partial">Beacon deciphered</span>';
          } else {
              echo 'Status: <span class="status-locked">World lost to the deep</span>';
          }
        ?>
      </div>
    </div>

  </div>

  <!-- BUTTONS -->
  <div class="hero_act">
    <a class="btn" href="past.php">Find the Past</a>
    <a class="btn" href="present.php">Walk to the Present</a>
    <a class="btn" href="future.php">Peer into the Future</a>
  </div>

</div>
</section>