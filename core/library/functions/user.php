<?php

/**
 * This file is part of the miniCMS package.
 * (c) 2005-2012 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Nevterch orson hereglegchiin id -g butsaana
 */
function get_logged_user_id() {

    global $session;

    //demo oor set hiiv
    $session->set('user_id', 1);

    return $session->get('user_id');
}
