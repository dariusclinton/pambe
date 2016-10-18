<?php

namespace WS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="WS\UserBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;
    
    private $directory;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Postload()
     */
    public function postLoad() {
        $this->updateAt = new \DateTime();
    }

    public $file;


    public function getUploadRootDir() {
        return __DIR__.'/../../../../web/uploads/'.$this->directory;
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();

        if ($this->file !== null) {
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     */
    public function upload_PostPersist() {
        if ($this->file !== null) {
            $this->file->move($this->getUploadRootDir(), $this->path);
            unset($this->file);
        }
    }

    /**
     * @ORM\PostUpdate()
     */
    public function upload_PostUpdate() {
        if ($this->file !== null) {
            $this->file->move($this->getUploadRootDir(), $this->path);
            unset($this->file);

            if ($this->oldFile != null) {
                unlink($this->tempFile);
            }
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function postRemoveUpload() {
        if (file_exists($this->tempFile)) unlink($this->tempFile);
    }


    /**
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
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
     * Set name
     *
     * @param string $name
     * @return Media
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Media
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * Set directory
     *
     * @param string $directory
     * @return Media
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;

        return $this;
    }

    /**
     * Get directory
     *
     * @return string 
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->name = "userProfile";
        $this->path = "user.png";
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Media
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }
    
    public function __toString() {
        return $this->getPath();
    }
}
