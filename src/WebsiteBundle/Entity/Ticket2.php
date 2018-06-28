<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket2
 *
 * @ORM\Table(name="ticket2")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\Ticket2Repository")
 */
class Ticket2
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

