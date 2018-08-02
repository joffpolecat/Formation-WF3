<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var UploadedFile
     * @Assert\Image(
     * maxSize = "2M"
     * )
     */
    private $file;

    private $tmpPath;

    public function getId()
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get maxSize = "2M",
     *
     * @return  UploadedFile
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set maxSize = "2M",
     *
     * @param  UploadedFile  $file  maxSize = "2M",
     *
     * @return  self
     */ 
    public function setFile(UploadedFile $file)
    {
        $this->tmpPath = $this->path;
        $this->path = '';
        $this->file = $file;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function generateFileName()
    {
        if ( is_file($this->getPublicRootDir() . $this->tmpPath) ) // si un fichier existe
        {
            unlink($this->getPublicRootDir() . $this->tmpPath);
        }

        if ( $this->file instanceof UploadedFile ) {
            $this->path = uniqid('image_') . '.' . $this->file->guessExtension();
        }
    }

    public function getPublicRootDir()
    {
        return __DIR__ . '/../../public/uploads/';
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if ( $this->file instanceof UploadedFile ) 
        {
            $this->file->move(
                $this->getPublicRootDir(),
                $this->path
            );
        }
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeFile()
    {
        if ( is_file($this->getPublicRootDir() . $this->path) ) // si un fichier existe
        {
            unlink($this->getPublicRootDir() . $this->path);
        }
    }

}
