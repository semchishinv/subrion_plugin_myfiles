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

class iaBackendController extends iaAbstractControllerModuleBackend
{
    protected $_name = 'myfiles';
    protected $_helperName = 'myfile';
    protected $_gridColumns = ['title', 'body', 'status','featured','date_added'];
    protected $_gridFilters = ['title' => self::LIKE, 'status' => self::EQUAL, 'gender' => self::EQUAL];
    protected $_activityLog = ['item' => 'file'];

    public function init()
    {
        $this->_path = IA_ADMIN_URL . $this->getName() . IA_URL_DELIMITER;
    }

    public function updateCounters($entryId, array $entryData, $action, $previousData = null)
    {
        $this->_iaCore->factory('cache')->remove('myfiles');
    }

    protected function _entryAdd(array $entryData)
    {
        $entryData['date_added'] = date(iaDb::DATETIME_FORMAT);

        return parent::_entryAdd($entryData);
    }

    protected function _entryUpdate(array $entryData, $entryId)
    {
        $entryData['date_modified'] = date(iaDb::DATETIME_FORMAT);

        return parent::_entryUpdate($entryData, $entryId);
    }

    protected function _setDefaultValues(array &$entry)
    {
        $entry['title'] = $entry['body'] = '';
        $entry['date_added'] = date(iaDb::DATETIME_FORMAT);
        $entry['status'] = iaCore::STATUS_ACTIVE;
        $entry['featured'] = false;
    }

    protected function _assignValues(&$iaView, array &$entryData)
    {
        parent::_assignValues($iaView, $entryData);

        unset($entryData['date_added']);
    }

}