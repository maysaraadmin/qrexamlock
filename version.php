<?php
// This file is part of the qrexamlock plugin for Moodle - http://moodle.org/
// 
// qrexamlock is a plugin to enhance exam security using QR code-based access control.
// 
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_qrexamlock'; // Full name of the plugin (used for diagnostics).
$plugin->version   = 2024112300;        // The current plugin version (date-based YYYYMMDDXX).
$plugin->release   = 'v1.0';            // Human-readable version name.
$plugin->requires  = 2022041900;        // Requires this Moodle version (e.g., Moodle 4.0).
$plugin->maturity  = MATURITY_STABLE;   // Maturity level: MATURITY_ALPHA, MATURITY_BETA, or MATURITY_STABLE.
$plugin->author    = 'Your Name or Organization'; // Author of the plugin.
$plugin->license   = 'GPLv3 or later';  // License type.
$plugin->supported = [401, 402];        // Supported Moodle versions (e.g., Moodle 4.1 and 4.2).

// Optional: Dependencies
// $plugin->dependencies = [
//     'mod_quiz' => ANY_VERSION, // Requires the Quiz module.
// ];
