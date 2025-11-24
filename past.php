<?php
require_once 'functions.php';

if (!isset($_SESSION['past_map_solved'])) {
    $_SESSION['past_map_solved'] = false;
}
if (!isset($_SESSION['past_year_solved'])) {
    $_SESSION['past_year_solved'] = false;
}
if (!isset($_SESSION['artifact_state'])) {
    $_SESSION['artifact_state'] = 'damaged';
}


if (!isset($_SESSION['ship_built_year'])) {
    $_SESSION['ship_built_year'] = 1700;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    if (isset($_POST['hint_map'])) {
        if (use_hint()) {
            flash_message('Hint: Sailors unfold it to cross the sea—ink instead of waves.');
        } else {
            flash_message('Not enough points for a hint.');
        }
        header('Location: past.php');
        exit;
    }

    if (isset($_POST['hint_year'])) {
        if (use_hint()) {
            flash_message('Hint: Study the iron cannon closely; its engraved date is the truth.');
        } else {
            flash_message('Not enough points for a hint.');
        }
        header('Location: past.php');
        exit;
    }

    
    if (isset($_POST['answer_map']) && !$_SESSION['past_map_solved']) {
        $answer = trim(strtolower($_POST['answer_map']));
        if ($answer === 'map') {
            $_SESSION['past_map_solved'] = true;
            adjust_score(15);
            flash_message('The waterlogged ink reforms. A map glows on the cabin wall.');
        } else {
            adjust_score(-5);
            flash_message('The timbers groan. That is not what the riddle meant. -5 points.');
        }
        header('Location: past.php');
        exit;
    }

    
    if (isset($_POST['answer_year']) && $_SESSION['past_map_solved'] && !$_SESSION['past_year_solved']) {

        $answerYear = trim($_POST['answer_year']);
        $answerYear = preg_replace('/\D/', '', $answerYear); 

        if ($answerYear === strval($_SESSION['ship_built_year'])) {
            $_SESSION['past_year_solved'] = true;
            $_SESSION['artifact_state'] = 'repaired';   
            adjust_score(20);
            flash_message('You trace the numbers in the rust. The ship remembers being born in 1700.');
        } else {
            adjust_score(-5);
            flash_message('The hull rejects that date. -5 points.');
        }

        header('Location: past.php');
        exit;
    }
}

include 'header.php';
?>

<section class="room">
  <div class="room_txt">
    <h2>Past : Wreck of the SS Santa Maria</h2>

    <p class="narrative typewriter">
      You open your eyes and immediately shut them, it stings. Salty, briney, old. The ship is lit, somehow, underwater. You are breathing, you think. But no time, you need to solve this to leave.
    </p>

    
    <div class="pzzl_blk">
      <h3>Puzzle 1 — Where are we</h3>
      <p class="puzzle-text">
        Etched into the desk:
        <em>"I contain cities but have no houses, I have oceans but no water, I see forests but smell no trees...."</em>
      </p>

      <?php if (!$_SESSION['past_map_solved']): ?>
        <form method="post" class="pzzl_frm">
          <label>Enter the answer (one word):
            <input name="answer_map" required />
          </label>
          <div class="actions">
            <button type="submit" class="btn">Submit</button>
            <button name="hint_map" value="1" class="btn alt">Get Hint (-10)</button>
          </div>
        </form>
      <?php else: ?>
        <p class="pzzl_slv">Solved: MAP</p>
      <?php endif; ?>
    </div>

    
    <div class="pzzl_blk">
      <h3>Puzzle 2 — When is this Ship?</h3>
      <p class="puzzle-text">
        Beside you are 3 dated artifacts
        <em>zoom in and figure out what date this ship was made</em>
      </p>

      <div class="art_grid">


<div class="flip_card">
    <div class="flip_inner">
        <div class="flip_front">
            <img src="compass.png" alt="Compass">
            <figcaption>Compass</figcaption>
        </div>
        <div class="flip_back">
            <img src="compass.png" alt="Compass detail">
            <p>It's engraved 1681...maybe thats a clue</p>
        </div>
    </div>
</div>


<div class="flip_card">
    <div class="flip_inner">
        <div class="flip_front">
            <img src="captains_log.png" alt="Captain's Log">
            <figcaption>Captain's Log</figcaption>
        </div>
        <div class="flip_back">
            <img src="captains_log.png" alt="Captain's Log detail">
            <p>March 28, 1701… the ship was made by then.</p>
        </div>
    </div>
</div>


<div class="flip_card">
    <div class="flip_inner">
        <div class="flip_front">
            <img src="canon.png" alt="Cannon">
            <figcaption>Cannon</figcaption>
        </div>
        <div class="flip_back">
            <img src="canon.png" alt="Canon Etching">
            <p>The cannon has this date etched to its size <strong>1700</strong></p>
        </div>
    </div>
</div>

</div>


</div>
      </div>

      <?php if (!$_SESSION['past_map_solved']): ?>
        <p class="pzzl_lck">Solve the riddle above first.</p>

      <?php elseif (!$_SESSION['past_year_solved']): ?>
        <form method="post" class="pzzl_frm">
          <label>Enter the ship’s year:
            <input name="answer_year" placeholder="YYYY" required />
          </label>
          <div class="actions">
            <button type="submit" class="btn">Commit Year</button>
            <button name="hint_year" value="1" class="btn alt">Get Hint (-10)</button>
          </div>
        </form>

      <?php else: ?>
        <p class="pzzl_slv">Solved: 1700</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="room_vis">
    <div class="wreck_wind">
      <img src="shipwreck.png" class="shipwreck_ill" alt="Shipwreck">
    </div>
  </div>
</section>


<?php include 'footer.php'; ?>
