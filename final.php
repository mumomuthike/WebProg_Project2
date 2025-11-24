<?php
require_once 'functions.php';
include 'header.php';
?>

<div class="final-bg"></div>

<section class="final-screen">
  
  <div class="final-box">
      <h2 class="final-title handwritten">You wake up.</h2>

      <p class="final-message handwritten">
        Your mind is still yours.<br>
        But Cthulhu remains hungry.
      </p>

      <form method="post" action="index.php">
        <button class="btn" name="reset" value="1">Go Again</button>
      </form>
  </div>

</section>

<?php include 'footer.php'; ?>