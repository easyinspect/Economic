<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:05.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\RequiredModules;

class AppRoles
{
    /** @var string $name */
    private $name;
    /** @var array $requiredModules */
    private $requiredModules = [];
    /** @var int $roleNumber */
    private $roleNumber;

    /** @var Economic $economic */
    private $economic;

    /**
     * AppRoles constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into AppRoles.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return AppRoles
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $appRoles = new self($economic);

        $appRoles->setName($stdClass->name);
        $appRoles->setRequiredModules($stdClass->requiredModules ?? null);
        $appRoles->setRoleNumber($stdClass->roleNumber);

        return $appRoles;
    }

    /**
     * Retrieves a collection of AppRoles.
     * @param Filter $filter
     * @return AppRoles
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/app-roles?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/app-roles?', $this);
        }
    }

    /**
     * Retrieves a single AppRole by its roleNumber.
     * @param int $roleNumber
     * @return AppRoles
     */
    public function get(int $roleNumber)
    {
        return self::transform($this->economic, $this->economic->get('/app-roles/'.$roleNumber));
    }

    // Setters & Getters

    /**
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AppRoles
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getRequiredModules() : ?array
    {
        return $this->requiredModules;
    }

    /**
     * @param array $requiredModules
     * @return AppRoles
     */
    public function setRequiredModules(array $requiredModules = null)
    {
        if (!is_null($requiredModules)) {

            foreach ($requiredModules as $module) {
                $this->requiredModules[] = new RequiredModules($module->moduleNumber, $module->self);
            }

        }


        return $this;
    }

    /**
     * @return int|null
     */
    public function getRoleNumber() : ?int
    {
        return $this->roleNumber;
    }

    /**
     * @param int $roleNumber
     * @return AppRoles
     */
    public function setRoleNumber(int $roleNumber)
    {
        $this->roleNumber = $roleNumber;

        return $this;
    }
}
