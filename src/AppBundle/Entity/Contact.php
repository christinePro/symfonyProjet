<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewPage
 *
 * @ORM\Table(name="Contact)
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
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
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;


    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="publishAt", type="datetime")
     */
    private $publishAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_processed", type="boolean")
     */
    private $isProcessed;

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
     * Set title
     *
     * @param string $title
     *
     * @return Contact
     */
    public function setTitle($title)
    {
        $this->title= $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Contact
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Set publishAt
     *
     * @param \DateTime $publishAt
     *
     * @return Contact
     */
    public function setPublishAt($publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    /**
     * Get publishAt
     *
     * @return \DateTime
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    public function setIsProcessed($isProcessed)
    {
        $this->isProcessed = $isProcessed;

        return $this;
    }

    public function isProcessed()
    {
        return (bool) $this->isProcessed;
    }
}
