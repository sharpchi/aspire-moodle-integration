<?php

require_once("../../config.php");
require_once($CFG->dirroot.'/mod/aspirelists/lib.php');
require_once($CFG->dirroot.'/mod/lti/lib.php');
require_once($CFG->dirroot.'/mod/lti/locallib.php');

$id = required_param('id', PARAM_INT); // Course Module ID

$cm = get_coursemodule_from_id('aspirelists', $id, 0, false, MUST_EXIST);
$list = $DB->get_record('aspirelists', array('id' => $cm->instance), '*', MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

add_to_log($course->id, "aspirelists", "launch", "launch.php?id=$cm->id", "$list->id");

$list->cmid = $cm->id;
aspirelists_add_lti_properties($list);
lti_view($list);
