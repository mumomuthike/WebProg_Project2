
<?php
require_once 'functions.php';


if (!isset($_SESSION['artifact_state'])) {
    $_SESSION['artifact_state'] = 'damaged';
}

if (!isset($_SESSION['present_solved'])) {
    $_SESSION['present_solved'] = false;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    if (isset($_POST['hint'])) {
        if (use_hint()) {
            flash_message('Hint: NO HINTS, if you give up, input NAY');
        } else {
            flash_message('Not enough points for a hint.');
        }
        header('Location: present.php');
        exit;
    }

    
    $answer = strtoupper(trim($_POST['answer'] ?? ''));
    $answer = preg_replace('/[^A-Z]/', '', $answer);

 
    $state   = strtolower($_SESSION['artifact_state']);
    $correct = ($state === 'repaired') ? 'KEY' : 'NAY';

   
    if ($answer === $correct) {
        $_SESSION['present_solved'] = true;
        $_SESSION['water_riddle_answer'] = strtolower($correct);
        adjust_score(20);
        flash_message('The ship humms, Cthulu is satisfied, the present stabilizes.');
    } else {
        adjust_score(-5);
        flash_message('The ipad flickers and rejects the input. -5 points.');
    }


    header('Location: present.php');
    exit;
}

include 'header.php';
?>

<section class="room">
  <div class="room_txt">
    <h2>Present : Cruise Ship</h2>

    <p class="narrative typewriter">
      You look around and immediately smell old carpet... is that bongo music you hear. This is just like that curise ship your parents took you on before the divorce... the ipad in your hand beeps, time to solve this.
    </p>

    <?php if (!$_SESSION['present_solved']): ?>

      <p class="puzzle-text">
        On the screen the following riddle appears
        <em>"I open all wooden frames, three letters in my name...."</em>
      </p>
        
      </p>

      <form method="post" class="pzzl_frm">
        <label>Enter the three-letter code:
          <input name="answer" maxlength="3" required />
        </label>
        <div class="actions">
          <button class="btn" type="submit">Activate</button>
          <button name="hint" value="1" class="btn alt">Get Hint (-10)</button>
        </div>
      </form>

    <?php else: ?>

      <p class="pzzl_slv">The ipad beeps, then vanishes...</p>
      <a href="future.php" class="btn">Enter the Future</a>

    <?php endif; ?>
  </div>


</section>


<?php include 'footer.php'; ?>

