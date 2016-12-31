<?php declare(strict_types=1);

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\OperatorResource;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;

/**
 * Represents a Compute v2 AvailabilityZone.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class AvailabilityZone extends OperatorResource implements Listable, Retrievable, Creatable, Deletable
{
    /** @var int */
    public $disk;

    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var int */
    public $ram;

    /** @var int */
    public $swap;

    /** @var int */
    public $vcpus;

    /** @var array */
    public $links;

    protected $resourceKey = 'availabilityZoneInfo';
    protected $resourcesKey = 'availabilityZoneInfo';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getFlavor(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $userOptions): Creatable
    {
        $response = $this->execute($this->api->postFlavors(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteFlavor(), ['id' => (string) $this->id]);
    }
}
