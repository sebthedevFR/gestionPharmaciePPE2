<?php

namespace GSB\ObjComBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suivi
 *
 * @ORM\Table(name="suivi")
 * @ORM\Entity(repositoryClass="GSB\ObjComBundle\Repository\SuiviRepository")
 */
class Suivi
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
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=100)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateajout", type="datetime")
     */
    private $dateajout;

    /**
     * @ORM\ManyToOne(targetEntity="GSB\ObjComBundle\Entity\Pharmacie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laPharmacie;

    public function __construct()
    {
        $this->dateajout = new \DateTime();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Suivi
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Suivi
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateajout
     *
     * @param \DateTime $dateajout
     * @return Suivi
     */
    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;

        return $this;
    }

    /**
     * Get dateajout
     *
     * @return \DateTime 
     */
    public function getDateajout()
    {
        return $this->dateajout;
    }

    /**
     * Set laPharmacie
     *
     * @param \GSB\ObjComBundle\Entity\Pharmacie $laPharmacie
     * @return Suivi
     */
    public function setLaPharmacie(\GSB\ObjComBundle\Entity\Pharmacie $laPharmacie)
    {
        $this->laPharmacie = $laPharmacie;

        return $this;
    }

    /**
     * Get laPharmacie
     *
     * @return \GSB\ObjComBundle\Entity\Pharmacie 
     */
    public function getLaPharmacie()
    {
        return $this->laPharmacie;
    }
}
