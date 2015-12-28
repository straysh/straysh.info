<?php namespace App\Http\Helpers\Menus\Presenters;

use App\Http\Helpers\Menus\MenuItem;

interface PresenterInterface
{
    /**
     * Get open tag wrapper.
     * @return string
     */
    public function getOpenTagWrapper();

    /**
     * Get close tag wrapper.
     * @return string
     */
    public function getCloseTagWrapper();

    /**
     * Get menu tag without dropdown wrapper.
     * @param \App\Http\Helpers\Menus\MenuItem $item
     * @return string
     */
    public function getMenuWithoutDropdownWrapper($item);

    /**
     * Get divider tag wrapper.
     * @return string
     */
    public function getDividerWrapper();

    /**
     * Get divider tag wrapper.
     * @param \App\Http\Helpers\Menus\MenuItem $item
     * @return mixed
     */
    public function getHeaderWrapper($item);

    /**
     * Get menu tag with dropdown wrapper.
     * @param \App\Http\Helpers\Menus\MenuItem $item
     * @return string
     */
    public function getMenuWithDropDownWrapper($item);

    /**
     * Get child menu items.
     * @param \App\Http\Helpers\Menus\MenuItem $item
     *
     * @return string
     */
    public function getChildMenuItems(MenuItem $item);
}