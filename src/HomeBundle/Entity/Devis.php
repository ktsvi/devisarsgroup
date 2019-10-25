<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis")
 * @ORM\Entity(repositoryClass="HomeBundle\Repository\DevisRepository")
 */
class Devis
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
     * @ORM\Column(name="resumeDevis", type="string", length=255)
     */
    private $resumeDevis;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofBegining", type="date")
     */
    private $dateofBegining;

    /**
     * @var int
     *
     * @ORM\Column(name="costofProject", type="integer")
     */
    private $costofProject;
     
   /**
* @ORM\ManyToOne(targetEntity="HomeBundle\Entity\User", inversedBy="user")
* @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
*/
   private $user;

  
   /**
* @ORM\ManyToOne(targetEntity="HomeBundle\Entity\Project", inversedBy="Project")
* @ORM\JoinColumn(name="Project", referencedColumnName="id", nullable=false)
*/
   private $project;

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
     * Set resumeDevis
     *
     * @param string $resumeDevis
     *
     * @return Devis
     */
    public function setResumeDevis($resumeDevis)
    {
        $this->resumeDevis = $resumeDevis;

        return $this;
    }

    /**
     * Get resumeDevis
     *
     * @return string
     */
    public function getResumeDevis()
    {
        return $this->resumeDevis;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Devis
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set dateofBegining
     *
     * @param \DateTime $dateofBegining
     *
     * @return Devis
     */
    public function setDateofBegining($dateofBegining)
    {
        $this->dateofBegining = $dateofBegining;

        return $this;
    }

    /**
     * Get dateofBegining
     *
     * @return \DateTime
     */
    public function getDateofBegining()
    {
        return $this->dateofBegining;
    }

    /**
     * Set costofProject
     *
     * @param integer $costofProject
     *
     * @return Devis
     */
    public function setCostofProject($costofProject)
    {
        $this->costofProject = $costofProject;

        return $this;
    }

    /**
     * Get costofProject
     *
     * @return int
     */
    public function getCostofProject()
    {
        return $this->costofProject;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Devis
     */
    public function setUser(\HomeBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HomeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project
     *
     * @param \HomeBundle\Entity\Project $project
     *
     * @return Devis
     */
    public function setProject(\HomeBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \HomeBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
