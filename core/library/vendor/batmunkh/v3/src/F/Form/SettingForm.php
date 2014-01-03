<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace F\Form;

/**
 * Description here
 *
 * @package    miniCMS
 * @subpackage .
 * @author     BATMUNKH Moltov <contact@batmunkh.com>
 * @version    SVN: $Id
 */
class SettingForm extends \F\PFBC\Form {

    public $form;

    public function __construct($form_name = 'setting') {
        $form = new F\PFBC\Form($form_name);

        $form->addElement(new \F\PFBC\Element\HTML('<legend>' . __('Settings') . '</legend>'));
        $form->addElement(new \F\PFBC\Element\Hidden('form_name', $form_name));
        $form->addElement(new \F\PFBC\Element\Textbox(__('Setting name') . ":", "name", array(
            "required" => 1,
            "longDesc" => __('Name field is required')
        )));
        $form->addElement(new \F\PFBC\Element\Textbox(__('Setting value') . ":", "value", array(
            "required" => 1,
            "longDesc" => __('Name field is required')
        )));


        $this->form = $form;

        return $form;
    }

}