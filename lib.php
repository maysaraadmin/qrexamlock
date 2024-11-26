<?php
// This file is part of the qrexamlock plugin for Moodle - http://moodle.org/
//
// qrexamlock is a plugin to enhance exam security using QR code-based access control.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

/**
 * Generates a QR code for a given quiz session.
 *
 * @param int $quizid The ID of the quiz activity.
 * @param int $userid The ID of the user.
 * @return string Path to the generated QR code image.
 */
function local_qrexamlock_generate_qr_code($quizid, $userid) {
    global $CFG;

    require_once($CFG->libdir . '/filelib.php'); // Load file library.
    require_once($CFG->dirroot . '/local/qrexamlock/phpqrcode/qrlib.php'); // Include QR library.

    // Define the data to encode in the QR code.
    $data = json_encode([
        'quizid' => $quizid,
        'userid' => $userid,
        'timestamp' => time()
    ]);

    // Define the output file path.
    $outputdir = $CFG->dataroot . '/qrexamlock/qrcodes/';
    make_temp_directory('qrexamlock/qrcodes'); // Ensure the directory exists.
    $filename = $outputdir . "qr_{$quizid}_{$userid}.png";

    // Generate the QR code.
    QRcode::png($data, $filename, QR_ECLEVEL_H, 6);

    return $filename;
}

/**
 * Validates the QR code scan data.
 *
 * @param string $qrdata The scanned QR code data (JSON format).
 * @return bool True if valid, false otherwise.
 */
function local_qrexamlock_validate_qr_code($qrdata) {
    global $DB;

    // Decode the QR data.
    $data = json_decode($qrdata, true);
    if (!$data || !isset($data['quizid']) || !isset($data['userid']) || !isset($data['timestamp'])) {
        return false;
    }

    // Check if the quiz and user exist in the database.
    $quizid = $data['quizid'];
    $userid = $data['userid'];
    $timestamp = $data['timestamp'];

    if (!$DB->record_exists('quiz', ['id' => $quizid])) {
        return false; // Quiz does not exist.
    }
    if (!$DB->record_exists('user', ['id' => $userid])) {
        return false; // User does not exist.
    }

    // Verify that the QR code is still valid based on expiry time.
    $expirytime = get_config('local_qrexamlock', 'qrcodeexpiry') * 60; // Convert to seconds.
    if ((time() - $timestamp) > $expirytime) {
        return false; // QR code has expired.
    }

    return true; // Valid QR code.
}

/**
 * Restricts access to the quiz based on QR code validation.
 *
 * @param stdClass $quiz The quiz activity object.
 * @param stdClass $user The user object.
 * @return bool True if access is granted, false otherwise.
 */
function local_qrexamlock_restrict_quiz_access($quiz, $user) {
    // Generate a QR code for the current user and quiz.
    $qrcodefile = local_qrexamlock_generate_qr_code($quiz->id, $user->id);

    // Display the QR code to the user.
    echo html_writer::tag('div', get_string('scanqrcode', 'local_qrexamlock'), ['class' => 'qrexamlock-message']);
    echo html_writer::empty_tag('img', ['src' => new moodle_url('/local/qrexamlock/qrcodes/' . basename($qrcodefile))]);

    // Wait for QR code validation.
    // This can be implemented using AJAX to validate the scan in real-time.
    return true;
}
