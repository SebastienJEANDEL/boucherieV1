<?php

namespace Oshop\Models;

class CoreModel
{
    /**
     * The entity id
     *
     * @var int
     */
    protected $id;

    protected $name;
    protected $created_at;
    protected $updated_at;

    /**
     * Get the value of id
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * 
     * @param string $name The new brand name
     *
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the creation date
     *
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get the update date
     *
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}