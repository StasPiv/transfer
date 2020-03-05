<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Transfer;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class TransferConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getClassTargetDirectory()
    {
        return APPLICATION_SOURCE_DIR . '/Generated/Shared/Transfer/';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDataBuilderTargetDirectory()
    {
        return APPLICATION_SOURCE_DIR . '/Generated/Shared/DataBuilder/';
    }

    /**
     * @api
     *
     * @return string[]
     */
    public function getSourceDirectories()
    {
        $globPatterns = $this->getCoreSourceDirectoryGlobPatterns();
        $globPatterns[] = $this->getApplicationSourceDirectoryGlobPattern();

        $globPatterns = array_merge($globPatterns, $this->getAdditionalSourceDirectoryGlobPatterns());

        return $globPatterns;
    }

    /**
     * @api
     *
     * @return string[]
     */
    public function getDataBuilderSourceDirectories()
    {
        $globPatterns = $this->getSourceDirectories();

        $globPatterns[] = APPLICATION_ROOT_DIR . '/tests/_data';
        $globPatterns[] = APPLICATION_VENDOR_DIR . '/*/*/tests/_data/';

        return $globPatterns;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDataBuilderFileNamePattern()
    {
        return '/(.*?).(databuilder|transfer).xml/';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getEntityFileNamePattern()
    {
        return '/(.*?).(schema).xml/';
    }

    /**
     * @deprecated please use TransferConfig::getCoreSourceDirectoryGlobPatterns() instead
     *
     * @return string
     */
    protected function getSprykerCoreSourceDirectoryGlobPattern()
    {
        return APPLICATION_VENDOR_DIR . '/*/*/src/*/Shared/*/Transfer/';
    }

    /**
     * @return string[]
     */
    protected function getCoreSourceDirectoryGlobPatterns()
    {
        /**
         * This is added for keeping the BC and needs to be
         * replaced with the actual return of
         * getSprykerCoreSourceDirectoryGlobPattern() method
         */
        return [
            $this->getSprykerCoreSourceDirectoryGlobPattern(),
        ];
    }

    /**
     * @return string
     */
    protected function getApplicationSourceDirectoryGlobPattern()
    {
        return APPLICATION_SOURCE_DIR . '/*/Shared/*/Transfer/';
    }

    /**
     * @deprecated please use TransferConfig::getCoreSourceDirectoryGlobPatterns() instead
     *
     * This method can be used to extend the list of directories for transfer object
     * discovery in project implementations.
     *
     * @return string[]
     */
    protected function getAdditionalSourceDirectoryGlobPatterns()
    {
        return [];
    }

    /**
     * @api
     *
     * @return string[]
     */
    public function getEntitiesSourceDirectories()
    {
        return [
            APPLICATION_SOURCE_DIR . '/Orm/Propel/' . APPLICATION_STORE . '/Schema/',
        ];
    }

    /**
     * This will enable strict validation for transfer names upon generation.
     * The suffix "Transfer" is auto-appended and must not be inside the XML definitions.
     *
     * Defaults to false for BC reasons. Enable on project level if all modules in question
     * have been upgraded to the version they are fixed in.
     *
     * @api
     *
     * @return bool
     */
    public function isTransferNameValidated(): bool
    {
        return false;
    }

    /**
     * This will enable strict validation for case sensitive declaration.
     * Mainly for property names, and singular definition.
     *
     * Defaults to false for BC reasons. Enable on project level if all modules in question
     * have been upgraded to the version they are fixed in.
     *
     * @api
     *
     * @return bool
     */
    public function isCaseValidated(): bool
    {
        return false;
    }

    /**
     * This will enable strict validation for collections and singular definition.
     * The singular here is important to specify to avoid it being generated without inflection.
     *
     * Defaults to false for BC reasons. Enable on project level if all modules in question
     * have been upgraded to the version they comply with this rule.
     *
     * @api
     *
     * @return bool
     */
    public function isSingularRequired(): bool
    {
        return false;
    }
}
