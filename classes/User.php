<?php

abstract class User
{
    protected string $nom;
    protected string $email;
    protected string $password;
    protected string $image;
    protected string $role;
    protected string $status;

    public function __construct($nom, $email, $password, $image, $role, $status)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->role = $role;
        $this->status = $status;
    }


    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
