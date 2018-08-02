<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="user")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleFollow", mappedBy="user", orphanRemoval=true)
     */
    private $articleFollows;
    
    public function __construct()
    {
        parent::__construct();
        $this->articleFollows = new ArrayCollection();
        // your own logic
    }

    /**
     * Get the value of articles
     */ 
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set the value of articles
     *
     * @return  self
     */ 
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * @return Collection|ArticleFollow[]
     */
    public function getArticleFollows(): Collection
    {
        return $this->articleFollows;
    }

    public function addArticleFollow(ArticleFollow $articleFollow): self
    {
        if (!$this->articleFollows->contains($articleFollow)) {
            $this->articleFollows[] = $articleFollow;
            $articleFollow->setUser($this);
        }

        return $this;
    }

    public function removeArticleFollow(ArticleFollow $articleFollow): self
    {
        if ($this->articleFollows->contains($articleFollow)) {
            $this->articleFollows->removeElement($articleFollow);
            // set the owning side to null (unless already changed)
            if ($articleFollow->getUser() === $this) {
                $articleFollow->setUser(null);
            }
        }

        return $this;
    }
}