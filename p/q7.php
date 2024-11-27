<?php

// Base class: User
class User
{
    protected $name;
    protected $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    // Method to display user details
    public function displayDetails()
    {
        return "Name: {$this->name}, Email: {$this->email}";
    }
}

// Derived class: Admin
class Admin extends User
{
    private $accessLevel;

    public function __construct($name, $email, $accessLevel)
    {
        // Call the parent class constructor
        parent::__construct($name, $email);
        $this->accessLevel = $accessLevel;
    }

    // Override the displayDetails method to include access level
    public function displayDetails()
    {
        $baseDetails = parent::displayDetails();
        return "$baseDetails, Access Level: {$this->accessLevel}";
    }
}

// Example usage
$user = new User("Alice", "alice@example.com");
$admin = new Admin("Bob", "bob@example.com", "Super Admin");

echo "<h3>User Details:</h3>";
echo $user->displayDetails(); // Displays base user details

echo "<h3>Admin Details:</h3>";
echo $admin->displayDetails(); // Displays admin details, including access level
?>