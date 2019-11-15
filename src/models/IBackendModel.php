<?php

namespace abstractCRUD\models;

/**
 * Interface BackendModel
 * @package backend\components
 *
 * @property integer $id
 */
interface IBackendModel
{
    /**
     * Get title for the template page
     *
     * @return string
     */
    public static function getModelTitle();

    /**
     * Get title for the index page
     *
     * @return string
     */
    public static function getAllModelsTitle();

    /**
     * @return IBackendSearchModel
     */
    public static function getSearchModelClass();

    /**
     * Get attribute columns for view page
     *
     * @return array
     */
    public function getColumns();

    /**
     * get list of Asset classes that should be registered with form rendering
     *
     * @return array
     */
    public function getFormAssets();

    /**
     * tabbed form config, if count($result) < 2 no tabs will be displayed
     *
     * @return array
     */
    public function getFormConfig();

    /**
     * @return bool
     */
    public function isNewRecord();

}
