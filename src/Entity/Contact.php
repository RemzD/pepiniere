<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @var string|null
     * @Assert\NotBlank(message="Le prénom doit avoir minimum 2 caractères et maximum 25" )
     * @Assert\Length(min=2, max=25)
     */

     private $firstname;


     /**
     * @var string|null
     * @Assert\NotBlank(message="Le nom doit avoir minimum 2 caractères et maximum 25" )
     * @Assert\Length(min=2, max=25)
     */

     private $lastname;
    
    
     /**
     * @var string|null
     * @Assert\NotBlank(message="Le numéro de téléphone doit être valide")
     * @Assert\Regex(
     * pattern="/[0-9]{10}/"
     * )
     */

     private $phone;

         /**
     * @var string|null
     * @Assert\NotBlank(message="L'email doit être valide")
     * @Assert\Email()
     */ 
     
     private $email;


    private $startDate;


    private $endDate;

    /**
     * @var string|null
     * @Assert\notBlank(message="le message doit avoir minimum 10 caractères")
     * @Assert\Length(min=10)
     */

     private $message;

     /**
      * Get the value of message
      */ 
     public function getMessage()
     {
          return $this->message;
     }

     /**
      * Set the value of message
      *
      * @return  self
      */ 
     public function setMessage($message)
     {
          $this->message = $message;

          return $this;
     }

    /**
     * @return  string
     */ 
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return  self
     */ 
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return  string
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return  self
     */ 
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

     /**
      * Get the value of email
      */ 
     public function getEmail()
     {
          return $this->email;
     }

     /**
      * Set the value of email
      *
      * @return  self
      */ 
     public function setEmail($email)
     {
          $this->email = $email;

          return $this;
     }

     /**
      * Get the value of phone
      */ 
     public function getPhone()
     {
          return $this->phone;
     }

     /**
      * Set the value of phone
      *
      * @return  self
      */ 
     public function setPhone($phone)
     {
          $this->phone = $phone;

          return $this;
     }

     /**
      * Get the value of lastname
      */ 
     public function getLastname()
     {
          return $this->lastname;
     }

     /**
      * Set the value of lastname
      *
      * @return  self
      */ 
     public function setLastname($lastname)
     {
          $this->lastname = $lastname;

          return $this;
     }

     /**
      * Get the value of firstname
      */ 
     public function getFirstname()
     {
          return $this->firstname;
     }

     /**
      * Set the value of firstname
      *
      * @return  self
      */ 
     public function setFirstname($firstname)
     {
          $this->firstname = $firstname;

          return $this;
     }

}