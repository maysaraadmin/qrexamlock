<?php
// This file is part of the qrexamlock plugin for Moodle - http://moodle.org/
//
// qrexamlock is a plugin to enhance exam security using QR code-based access control.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) { // Ensure the user has site administration permissions.
    $settings = new admin_settingpage('local_qrexamlock', get_string('pluginname', 'local_qrexamlock'));

    // Enable/Disable the plugin.
    $settings->add(new admin_setting_configcheckbox(
        'local_qrexamlock/enabled',
        get_string('enabled', 'local_qrexamlock'),
        get_string('enabled_desc', 'local_qrexamlock'),
        1 // Default: Enabled.
    ));

    // QR Code Expiry Time (in minutes).
    $settings->add(new admin_setting_configtext(
        'local_qrexamlock/qrcodeexpiry',
        get_string('qrcodeexpiry', 'local_qrexamlock'),
        get_string('qrcodeexpiry_desc', 'local_qrexamlock'),
        5, // Default: 5 minutes.
        PARAM_INT
    ));

    // Require device verification.
    $settings->add(new admin_setting_configcheckbox(
        'local_qrexamlock/requiredeviceverification',
        get_string('requiredeviceverification', 'local_qrexamlock'),
        get_string('requiredeviceverification_desc', 'local_qrexamlock'),
        1 // Default: Enabled.
    ));

    // Logging enabled/disabled.
    $settings->add(new admin_setting_configcheckbox(
        'local_qrexamlock/logging',
        get_string('logging', 'local_qrexamlock'),
        get_string('logging_desc', 'local_qrexamlock'),
        1 // Default: Enabled.
    ));

    // Add the settings page to the "Local plugins" category.
    $ADMIN->add('localplugins', $settings);
}
