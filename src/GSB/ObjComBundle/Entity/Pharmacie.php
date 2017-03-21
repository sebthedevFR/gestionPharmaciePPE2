<?php

namespace GSB\ObjComBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Pharmacie
 *
 * @ORM\Table(name="pharmacie")
 * @ORM\Entity(repositoryClass="GSB\ObjComBundle\Repository\PharmacieRepository")
 */
class Pharmacie
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=75)
     */
    private $ville;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateajout", type="datetime")
     */
    private $dateajout;

    /**
     * @ORM\Column(name="client", type="boolean")
     */
    private $client;

    /**
     * Get id
     *
     * @return integer 
     */

    /**
     * @ORM\OneToOne(targetEntity="GSB\ObjComBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="GSB\ObjComBundle\Entity\Categorie", cascade={"persist"})
     */
    private $categories;



    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Pharmacie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Pharmacie
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set dateajout
     *
     * @param \DateTime $dateajout
     * @return Pharmacie
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

    public function __construct()
    {
        $this->dateajout = new \DateTime();
        $this->categories = new ArrayCollection();
    }




    /**
     * Set client
     *
     * @param boolean $client
     * @return Pharmacie
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return boolean 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set image
     *
     * @param \GSB\ObjComBundle\Entity\Image $image
     * @return Pharmacie
     */
    public function setImage(Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \GSB\ObjComBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categories
     *
     * @param \GSB\ObjComBundle\Entity\Categorie $categories
     * @return Pharmacie
     */
    public function addCategory(\GSB\ObjComBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \GSB\ObjComBundle\Entity\Categorie $categories
     */
    public function removeCategory(\GSB\ObjComBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
