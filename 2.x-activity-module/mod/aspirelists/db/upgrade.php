<?php
function xmldb_aspirelists_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if($oldversion < 2014040701)
    {
        upgrade_mod_savepoint(true, 2014040701, 'aspirelists');
    }
    if($oldversion < 2014041701)
    {
        upgrade_mod_savepoint(true, 2014041701, 'aspirelists');
    }
    if ($oldversion < 2014041702) {

        // Define table aspirelists to be created.
        $table = new xmldb_table('aspirelists');

        // Adding fields to table aspirelists.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('course', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('lti', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('display', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('showexpanded', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1');

        // Adding keys to table aspirelists.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Adding indexes to table aspirelists.
        $table->add_index('course', XMLDB_INDEX_NOTUNIQUE, array('course'));

        // Conditionally launch create table for aspirelists.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Aspirelists savepoint reached.
        upgrade_mod_savepoint(true, 2014041702, 'aspirelists');
    }

    if ($oldversion < 2014041704) {

        // Define table aspirelists to be created.
        $table = new xmldb_table('aspirelists');

        // Adding fields to table aspirelists.

        $field = new xmldb_field('intro', XMLDB_TYPE_TEXT, null, null, null, null, null, 'course');

        // Conditionally launch add field display
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('introformat', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '0', 'intro');

        // Conditionally launch add field display
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Aspirelists savepoint reached.
        upgrade_mod_savepoint(true, 2014041704, 'aspirelists');
    }

    if ($oldversion < 2014041705) {

        // Define table aspirelists to be created.
        $table = new xmldb_table('aspirelists');

        // Adding fields to table aspirelists.

        $field = new xmldb_field('name', XMLDB_TYPE_CHAR, 255, null, null, null, null, 'course');

        // Conditionally launch add field display
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Aspirelists savepoint reached.
        upgrade_mod_savepoint(true, 2014041705, 'aspirelists');
    }

}