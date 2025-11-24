<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Initialize game
 */
if (!isset($_SESSION['init'])) {

    // Global Player State
    $_SESSION['score']           = 100;
    $_SESSION['hints_used']      = 0;

    // 
    $_SESSION['past_map_solved']  = false;
    $_SESSION['past_year_solved'] = false;

    // Year the Santa Maria was built (learned in Past)
    $_SESSION['ship_built_year']  = 1700;

    // -------- PRESENT STATE --------
    // Modern logic uses only this:
    $_SESSION['present_solved']   = false;

    // Word produced by the Present puzzle
    // Initialized empty — present.php will set it to "key" or "nak"
    $_SESSION['water_riddle_answer'] = '';

    // --------- FUTURE STATE ---------
    $_SESSION['future_beacon_solved']  = false;
    $_SESSION['future_paradox_solved'] = false;

    // Mark initialization complete
    $_SESSION['init'] = true;
}

/**
 * Player score
 */
function adjust_score(int $delta): void {
    $_SESSION['score'] += $delta;
    if ($_SESSION['score'] < 0) {
        $_SESSION['score'] = 0;
    }
}

/**
 *Hint cost
 */
function use_hint(int $cost = 10): bool {
    if ($_SESSION['score'] >= $cost) {
        $_SESSION['hints_used']++;
        adjust_score(-$cost);
        return true;
    }
    return false;
}

/**
 * Messages
 */
function flash_message(string $msg): void {
    $_SESSION['flash'] = $msg;
}

function get_flash(): string {
    if (!empty($_SESSION['flash'])) {
        $message = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $message;
    }
    return '';
}

/**
 * Reset everything for a new game.
 */
function reset_timeline(): void {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['init'] = null;
}
