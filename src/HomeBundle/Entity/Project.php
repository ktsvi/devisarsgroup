<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="HomeBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="projectName", type="string", length=255)
     */
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="projectDescription", type="string", length=255)
     */
    private $projectDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="projectDocument", type="string", length=255)
     */
    private $projectDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofStart", type="date")
     */
    private $dateofStart;

  
   /**
* @ORM\ManyToOne(targetEntity="HomeBundle\Entity\User", inversedBy="user")
* @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
*/
     private $user;

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
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set projectDescription
     *
     * @param string $projectDescription
     *
     * @return Project
     */
    public function setProjectDescription($projectDescription)
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    /**
     * Get projectDescription
     *
     * @return string
     */
    public function getProjectDescription()
    {
        return $this->projectDescription;
    }

    /**
     * Set projectDocument
     *
     * @param string $projectDocument
     *
     * @return Project
     */
    public function setProjectDocument($projectDocument)
    {
        $this->projectDocument = $projectDocument;

        return $this;
    }

    /**
     * Get projectDocument
     *
     * @return string
     */
    public function getProjectDocument()
    {
        return $this->projectDocument;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Project
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set dateofStart
     *
     * @param \DateTime $dateofStart
     *
     * @return Project
     */
    public function setDateofStart($dateofStart)
    {
        $this->dateofStart = $dateofStart;

        return $this;
    }

    /**
     * Get dateofStart
     *
     * @return \DateTime
     */
    public function getDateofStart()
    {
        return $this->dateofStart;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Project
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
}
