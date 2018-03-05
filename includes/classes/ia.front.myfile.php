<?php
/******************************************************************************
 *
 * Subrion - open source content management system
 * Copyright (C) 2017 Intelliants, LLC <https://intelliants.com>
 *
 * This file is part of Subrion.
 *
 * Subrion is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Subrion is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Subrion. If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @link https://subrion.org/
 *
 ******************************************************************************/

class iaMyfile extends abstractModuleFront
{
    protected static $_table = 'myfiles';

    protected $_itemName = 'myfile';

    protected $_moduleName = 'myfiles';

    public $coreSearchEnabled = true;
    public $coreSearchOptions = [
        'regularSearchFields' => ['title', 'description'],
    ];

    public function get(){

        if('latest' == $this->iaCore->get('myfile_type')){
            $limit = $this->iaCore->get('myfile_entry_latest');
            $where = [
                'status'=>' `status` = "active" '
            ];
        }

        if('featured' == $this->iaCore->get('myfile_type')){
            $limit = $this->iaCore->get('myfile_entry_featured');
            $date = date(iaDb::DATETIME_FORMAT);

            $where = [
                'status'=>' `status` = "active" AND `featured` = 1 AND `featured_end` >= "'.$date.'" '
            ];
        }

        $sql = 'SELECT  p.* '
            . 'FROM `' . self::getTable(true) . '`  p '
            . 'WHERE '.$where['status'].' '
            . 'ORDER BY p.`date_added` DESC LIMIT 0,'.$limit.' ';
        $rows = $this->iaDb->getAll($sql);
        $this->_processValues($rows);

        return $rows;
    }


}