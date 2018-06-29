<?php

namespace WebsiteBundle\Entity;

use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\TicketRepository")
 */
class Ticket
{

    private $demande;
    private $commentaire;
    private $dateCreation;
    private $utilisateur;
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

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
        $this->dateCreation = date("Y-m-d H:i:s");
        $this->utilisateur = $utilisateur;
        $this->status = $status;
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
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}

