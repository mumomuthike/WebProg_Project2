<?php
require_once 'functions.php';


if (!isset($_SESSION['future_beacon_solved'])) {
    $_SESSION['future_beacon_solved'] = false;
}

if (!isset($_SESSION['future_paradox_solved'])) {
    $_SESSION['future_paradox_solved'] = false;
}

if (!isset($_SESSION['ship_built_year'])) {
    $_SESSION['ship_built_year'] = 1700;
}


if (!isset($_SESSION['water_riddle_answer'])) {
    $_SESSION['water_riddle_answer'] = '';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['hint_beacon'])) {
        if (use_hint()) {
            flash_message('Hint: Remember your two previous answers....place them together');
        } else {
            flash_message('Not enough points for a hint.');
        }
        header('Location: future.php');
        exit;
    }

    if (isset($_POST['hint_paradox'])) {
        if (use_hint()) {
            flash_message('Hint: what is it called when two things do not make sense...in a timey way (para....)');
        } else {
            flash_message('Not enough points for a hint.');
        }
        header('Location: future.php');
        exit;
    }

    
    if (isset($_POST['answer_beacon']) && !$_SESSION['future_beacon_solved']) {
        $expected = strtolower($_SESSION['water_riddle_answer'] . $_SESSION['ship_built_year']);
        $answer   = trim(strtolower($_POST['answer_beacon']));

        if ($answer === $expected) {
            $_SESSION['future_beacon_solved'] = true;
            adjust_score(25);
            flash_message('Cthulu is satisfied, your beacon stabilizes');
        } else {
            adjust_score(-5);
            flash_message('OH No! It shreaks...try again -5 points.');
        }
        header('Location: future.php');
        exit;
    }

    
    if (
        isset($_POST['answer_paradox']) &&
        $_SESSION['future_beacon_solved'] &&
        !$_SESSION['future_paradox_solved']
    ) {
        $answer = trim(strtolower($_POST['answer_paradox']));

        if ($answer === 'paradox') {
          if ($answer === 'paradox') {
            $_SESSION['future_paradox_solved'] = true;
            adjust_score(40);
        }
        } else {
            adjust_score(-5);
            flash_message('A pause... Cthulu is still hungry -5 points.');
        }
        header('Location: final.php');
        exit;
    }
}

include 'header.php';
?>

<section class="room">
  <div class="room_txt">
    <h2>Future : Drowned Earth</h2>

    <p class="narrative typewriter">
      Your eyes creak open to find yourself underwater again...but this time its emptier. You know, instincitvely this is the future climate scientists warned us about. The water is lighter, but also dead. You need to get out of here.
    </p>

    
    <div class="pzzl_blk">
      <h3>Puzzle 1 — Decode the Eldritch Beacon</h3>
      <p class="puzzle-text">
        There is a totem in your hand, some technology you can not understand. It begs but one question
        <em>"From the past, from the present, comes the answer to the future</em>
        </p>
      <?php if (!$_SESSION['future_beacon_solved']): ?>
        <form method="post" class="pzzl_frm">
          <label>Enter the combined phrase:
            <input name="answer_beacon" required />
          </label>
          <div class="actions">
            <button class="btn" type="submit">Answer the Totem</button>
            <button name="hint_beacon" value="1" class="btn alt">Hint (-10)</button>
          </div>
        </form>
      <?php else: ?>
        <p class="pzzl_slv">Totem recognized.</p>
      <?php endif; ?>
    </div>

   
    <div class="pzzl_blk">
      <h3>Puzzle 2 — Name the Loop</h3>
      <p class="puzzle-text">
        The totem flashes bright red, all white text
        <em>"To satiate Cthulu's hunger, you must give me but one answer. What is it called when the timelines do not align?"</em>
        </p>
      <?php if (!$_SESSION['future_paradox_solved']): ?>
        <form method="post" class="pzzl_frm">
          <label>Enter the final word:
            <input name="answer_paradox" required />
          </label>
          <div class="actions">
            <button class="btn" type="submit">Break Out of Cthulus Trials</button>
            <button name="hint_paradox" value="1" class="btn alt">Hint (-10)</button>
          </div>
        </form>
      <?php else: ?>
        <div class="ending">
          Completed.
          <a href="final.php" class="btn">Continue</a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="room_vis">
    <div class="fut_ocean">
      <img src="underwater.jpg" class="fut_bgimg">
      <img src="submarine.png" class="submar_ing">
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
