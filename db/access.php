<?php
// This file is part of the qrexamlock plugin for Moodle - http://moodle.org/
//
// qrexamlock is a plugin to enhance exam security using QR code-based access control.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    // Capability for managing the plugin settings.
    'local/qrexamlock:manage' => [
        'riskbitmask' => RISK_CONFIG,
        'captype'     => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes'  => [
            'manager' => CAP_ALLOW,
        ],
    ],

    // Capability for viewing QR codes for exams.
    'local/qrexamlock:viewqrcode' => [
        'riskbitmask' => RISK_PERSONAL,
        'captype'     => 'read',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes'  => [
            'teacher' => CAP_ALLOW,
            'student' => CAP_ALLOW,
        ],
    ],

    // Capability for scanning and validating QR codes.
    'local/qrexamlock:validateqrcode' => [
        'riskbitmask' => RISK_PERSONAL,
        'captype'     => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes'  => [
            'teacher' => CAP_ALLOW,
        ],
    ],

    // Capability for generating reports about QR code scans.
    'local/qrexamlock:generatereports' => [
        'riskbitmask' => RISK_PERSONAL,
        'captype'     => 'read',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes'  => [
            'manager' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ],
    ],
];
