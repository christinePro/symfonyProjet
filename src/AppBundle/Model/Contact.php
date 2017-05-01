<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * No needed anymore, replaced by AppBundle\Entity\Contact
 */
class Contact
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=2000)
     */
    private $content;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=2000)
     */
     private $publishAt;


     public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setPublishAt(\DateTime $publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getPublishAt()
    {
        return $this->publishAt;
    }
}
