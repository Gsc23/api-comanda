<?php
namespace App\ValueObjects;

class Username
{
    public string $username;

    private function __construct(string $username)
    {
        $this->username = $username;
    }

    public static function factory(string $name)
    {
        $username = self::generateUsername($name);
        return new self($username);
    }

    private static function generateUsername($name)
    {
        $nameParts = explode(' ', $name);

        $first = strtolower($nameParts[0][0]);
        $lastname = strtolower(end($nameParts));

        $username = $first . '.' . $lastname;

        return $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

}
