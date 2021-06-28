<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @Vich\Uploadable()
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;


    /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="image")
     * @Assert\Image(maxSize="8M")
     * @var File
     */
    private $imageFile;

    
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     */
    private $category;


    public function __construct()
    {
        $this->categories = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue() {
        $this->setUpdatedAt(new \DateTime());
    }

    

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    
}

