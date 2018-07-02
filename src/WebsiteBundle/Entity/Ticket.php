<?php

namespace WebsiteBundle\Entity;

use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\Mapping as ORM;
use WebsiteBundle\Resources\enum\TicketsStatus;

/**
 * Ticket
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\TicketRepository")
 */
class Ticket
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /** @ORM\Column(name="demande", length=140) */
    private $demande;
    /** @ORM\Column(name="commentaire", length=255) */
    private $commentaire;

    /** @ORM\Column(name="date_creation", type="datetime") */
    private $dateCreation;
    // private $utilisateur;

    /** @ORM\Column(name="status", length=50) */
    private $status;

    /**
     * Ticket constructor.
     * @param $demande
     * @param $commentaire
     * @param $dateCreation
     * @param $utilisateur
     * @param $status
     * @param int $id
     */
    public function __construct($demande, $commentaire, $utilisateur, $status)
    {
        $this->demande = $demande;
        $this->commentaire = $commentaire;
        $this->dateCreation = new \DateTime("now");
        //$this->utilisateur = $utilisateur;
        $this->status = TicketsStatus::STATUS_OUVERT;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation(){
        return $this->dateCreation;
    }

    /**
     * @return mixed
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * @param mixed $demande
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        if(!in_array($status, TicketsStatus::getAvaliableStatus())){
            throw new \InvalidArgumentException("Status existe pas");
        }
        $this->status = $status;
        return $this;
    }
}

