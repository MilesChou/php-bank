<?php
namespace MilesChou\Bank;

use Illuminate\Support\Collection;

class Bank extends Collection
{
    /**
     * @var Resource
     */
    protected static $defaultResource;

    /**
     * @var null|array
     */
    protected $bankCode;

    /**
     * @var null|array
     */
    protected $branchCode;

    /**
     * @param Resource $resource
     * @return static
     */
    public static function create(Resource $resource = null)
    {
        if (null === $resource) {
            $resource = static::getDefaultResource();
        }

        $data = $resource->getData();

        return static::make($data);
    }

    /**
     * @return Resource
     */
    public static function getDefaultResource()
    {
        if (null === static::$defaultResource) {
            static::$defaultResource = new OpenData();
        }

        return static::$defaultResource;
    }

    /**
     * @param Resource $resource
     */
    public static function setDefaultResource(Resource $resource)
    {
        static::$defaultResource = $resource;
    }

    /**
     * @return array
     */
    public function getBankCode()
    {
        if (null === $this->bankCode) {
            $this->bankCode = $this->filter(function ($item) {
                return '' === trim($item[1]);
            })->sortBy(0)->keyBy(0)->transform(function ($item) {
                return $item[2];
            })->all();
        }

        return $this->bankCode;
    }

    /**
     * @return array
     */
    public function getBranchCode()
    {
        if (null === $this->branchCode) {
            $this->branchCode = $this->filter(function ($item) {
                return '' !== trim($item[1]);
            })->sortBy(0)->keyBy(1)->transform(function ($item) {
                return $item[2];
            })->all();
        }

        return $this->branchCode;
    }
}
