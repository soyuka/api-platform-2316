<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Dummy {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column
     */
    public $name;

    /**
     * @ApiProperty
     */
    public $meta;

    public function getId() {
        return $this->id;
    }
}
