<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Cohort enrolment plugin settings and presets.
 *
 * @package    enrol
 * @subpackage jwc
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_jwc_settings', '', get_string('pluginname_desc', 'enrol_jwc')));


    //--- enrol instance defaults ----------------------------------------------------------------------------
    if (!during_initial_install()) {
        $options = get_default_enrol_roles(get_context_instance(CONTEXT_SYSTEM));
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect('enrol_jwc/roleid',
            '学生角色', '', $student->id, $options));
        $teacher = get_archetype_roles('editingteacher');
        $teacher = reset($teacher);
        $settings->add(new admin_setting_configselect('enrol_jwc/teacherroleid',
            '教师角色', '', $teacher->id, $options));
        $settings->add(new admin_setting_configtext('enrol_jwc/semester',
            '当前学期', '“2011秋季，2012春季”之类，与教务系统必须相符。每学期第一周必须修改设置。', '20XXＸ季'));
        $settings->add(new admin_setting_configtext('enrol_jwc/signprefix',
            '签名前缀', '访问教务处数字签名的前缀', ''));
        $settings->add(new admin_setting_configtext('enrol_jwc/signsuffix',
            '签名后缀', '访问教务处数字签名的后缀', ''));
        $settings->add(new admin_setting_configcheckbox('enrol_jwc/unenrolall',
            '清除所有选课', '<strong>慎重！！！</strong>勾选后，在下次cron运行时，会把所有已经同步的选课都清理掉。清理之后，此选项被自动禁用。应该只在每学期初设一下此选项。', 0));
    }
}

