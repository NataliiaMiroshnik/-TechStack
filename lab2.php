<?php

abstract class SocialNetwork
{
    abstract public function post($message);
}

class Facebook extends SocialNetwork
{
    public function post($message)
    {
        // Тут реалізація публікації в Facebook
    }
}

class LinkedIn extends SocialNetwork
{
    public function post($message)
    {
        // Тут реалізація публікації в LinkedIn
    }
}

abstract class SocialNetworkFactory {
    abstract public function create(): SocialNetwork;
}

class FacebookFactory extends SocialNetworkFactory {
    private $login;
    private $password;

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
    }

    public function create(): SocialNetwork {
        return new Facebook();
    }
}

class LinkedInFactory extends SocialNetworkFactory {
    private $email;
    private $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function create(): SocialNetwork {
        return new LinkedIn();
    }
}

$facebookFactory = new FacebookFactory('login', 'password');
$facebook = $facebookFactory->create();
$facebook->publishMessage('Facebook повідомлення');
$linkedinFactory = new LinkedInFactory('email', 'password');
$linkedin = $linkedinFactory->create();
$linkedin->publishMessage('LinkedIn повідомлення');

?>