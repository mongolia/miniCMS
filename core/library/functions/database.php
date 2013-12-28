<?php

/**
 * This file is part of the miniCMS package.
 * (c) 2005-2012 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
function load_db($config = array()) {

    switch (DB_ADAPTER) {
        case 'pdo':
            $db = new D\Adapter\PdoAdapter(DB_TYPE . ":dbname=" . $config['db_name'], $config['db_user'], $config['db_pass'], array(
                'db_name' => $config['db_name']
            ));
            break;
        case 'mysql':
            break;
        case 'oci8':
            break;
    }

    return $db;
}

/*
 * field iin neriig Model export-d zoriulj yanzlah
 */

function db_field_fix_name($field = '') {

    //dooguur zuraasaar tasalna
    $f = explode('_', $field);
    $fixed_name = '';
    foreach ($f as $k => $v) {
        $fixed_name .= strtoupper($v{0}) . substr($v, 1);
    }

    return $fixed_name;
}

/**
 * Model generate hiihed ashiglagdana
 * @param array $field Ex:
 * [id] => Array
  (
  [name] => id
  [type] => int(10) unsigned
  [null] => NO
  [default] =>
  [extra] => auto_increment
  )
 * @param $fieldname string field iin ner. Ex: deerhi jisheenii id key
 * @param $model_name string Model iin ner Ex: User
 */
function db_create_field_comment($field = array(), $fieldname = '', $model_name) {

    $f = $field[$fieldname];
    $buf = "/**
     * field info:
           *    name:       " . $field['name'] . "
           *    type:       " . $field['type'] . "
           *    null:       " . $field['null'] . "
           *    default:    " . $field['default'] . "
           *    extra:      " . $field['extra'] . "
           *    generated:  " . date("Y-m-d h:i:s a") . "
     * @param \${FIELDNAME} {TYPE} {MODELNAME} iin {FIELDNAME}
     * @return object
     */\n";
    $type = 'string';

    //field iin turliig jijig useg bolgoh
    $f['type'] = strtolower($field['type']);

    $type = db_field_type_to_model($f['type']);

    $buf = str_replace('{TYPE}', $type, $buf);
    $buf = str_replace('{FIELDNAME}', $fieldname, $buf);
    $buf = str_replace('{MODELNAME}', $model_name, $buf);
    return $buf;
}

/*
 * Model iin function iig gargah
 * @param $field array() Field iin medeelel Ex: array('name'=>'','type'=>'','null'=>'','default'=>'','extra'=>'')
 */

function db_create_model_function($field) {

    $fieldtype = db_field_type_to_model($field['type']);
    $buf = '';

    $buf = "\tpublic function set" . db_field_fix_name($field['name']) . "(\${FIELDNAME}) {\n";

    //turliig oruulah
    switch ($fieldtype) {
        case 'int':
            $buf .= '${FIELDNAME} = ({FIELDTYPE}) ${FIELDNAME};' . "\n";
            break;
        case 'string':
            $buf .= '${FIELDNAME} = ({FIELDTYPE}) ${FIELDNAME};' . "\n";
            break;
        case 'date':
            break;
        case 'datetime':
            break;
    }

    //field iin nereer command uguh
    switch ($field['name']) {
        case 'date_created':
            $buf .= '${FIELDNAME} = \M\Carbon::now();' . "\n";
            break;
        case 'id':
            $buf .= 'if (isset($this->fields["id"])) {
                            throw new \BadMethodCallException(__("The ID has been set already."));
                        }

                        if (!is_int($id) || $id < 1) {
                            throw new \InvalidArgumentException(__("The ID is invalid."));
                        }';
            break;
        default:
            break;
    }
    //null NO bol default utgiig onoono
    if (strtolower($field["null"]) == "no" && $field['name'] !== 'id') {
        $buf .= '
                if(!isset(${FIELDNAME}) || ${FIELDNAME} == ""){
                    ${FIELDNAME}="' . $field['default'] . '";
                }
            ';
    }
    $buf .= "\$this->fields[\"{FIELDNAME}\"] = \${FIELDNAME};\n";
    $buf .= "\nreturn \$this;\n
    }\n";

    $buf = str_replace("{FIELDNAME}", $field['name'], $buf);
    $buf = str_replace("{FIELDTYPE}", $fieldtype, $buf);

    return $buf;
}

function db_field_type_to_model($fieldtype) {

    $fieldtype = strtolower($fieldtype);

    if (substr($fieldtype, 0, 3) == 'int') {
        $type = 'int';
    }
    if (substr($fieldtype, 0, 7) == 'varchar') {
        $type = 'string';
    }
    if (substr($fieldtype, 0, 4) == 'text') {
        $type = 'string';
    }
    if (substr($fieldtype, 0, 8) == 'datetime') {
        $type = 'datetime';
    } elseif (substr($fieldtype, 0, 4) == 'date') {
        $type = 'date';
    }

    return $type;
}

//modelMapper iig beldeh
function db_build_model_mapper($mappers) {

}