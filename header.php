<?php
require_once __DIR__ . '/functions.php';

// Era
$script = basename($_SERVER['SCRIPT_NAME'], '.php');

$eraClass = 'era_hme';
if ($script === 'past')    $eraClass = 'era_past';
if ($script === 'present') $eraClass = 'era_pres';
if ($script === 'future')  $eraClass = 'era_fut';

// background
$bgClass = 'era_bg_index';
if ($script === 'past')    $bgClass = 'era_bg_past';
if ($script === 'present') $bgClass = 'era_bg_pre';
if ($script === 'future')  $bgClass = 'era_bg_fut';

// Time dail
$dialClass = 'dia_chilling';
if ($script === 'past')    $dialClass = 'dia_pas';
if ($script === 'present') $dialClass = 'dia_pre';
if ($script === 'future')  $dialClass = 'dia_fut';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Temporal Paradox: Depths of Cthulhu</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body class="<?php echo $eraClass; ?>">


  <div class="era_bg <?php echo $bgClass; ?>"></div>
  <div class="ocean-overlay"></div>

 
  <div class="page-door page-door-<?php echo $script; ?>">
    <div class="page-door-leaf"></div>
  </div>

 
  <header class="site_head">
    <a href="index.php" class="title">ESCAPE CTHULHU: Time is not on your side</a>
    <div class="hud">
      <div class="score">Score: <strong><?php echo $_SESSION['score']; ?></strong></div>
      <div class="hints">Hints used: <?php echo $_SESSION['hints_used']; ?></div>

      <form method="post" action="index.php" class="rest_frm">
        <button class="reset_bt" name="reset" value="1" type="submit">Reset</button>
      </form>
    </div>
  </header>

  <nav class="ti_nav">
    <div class="ti_dia <?php echo $dialClass; ?>">
      <span class="dia_look"></span>

      <a class="era-link <?php echo $script === 'past' ? 'active' : ''; ?>" href="past.php">Past</a>
      <a class="era-link <?php echo $script === 'present' ? 'active' : ''; ?>" href="present.php">Present</a>
      <a class="era-link <?php echo $script === 'future' ? 'active' : ''; ?>" href="future.php">Future</a>
    </div>
  </nav>

  <main class="container">
    <?php if ($f = get_flash()): ?>
      <div class="flash"><?php echo $f; ?></div>
    <?php endif; ?>
