<?php

interface Notification
{
    public function send(string $title, string $message);
}

class EmailNotification implements Notification
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function send(string $title, string $message): void
    {
        // Реалізація відправки email
    }
}

class SlackNotification implements Notification
{
    private $slack;

    public function __construct(string $login, string $apiKey, string $chatId)
    {
        // Ініціалізуємо з'єднання з Slack використовуючи login та apiKey та зберігаємо chatId для відправки повідомлень у вказаний чат
    }

    public function send(string $title, string $message): void
    {
        // Реалізація відправки повідомлення у Slack
    }
}

class SmsNotification implements Notification
{
    private $phone;
    private $sender;

    public function __construct(string $phone, string $sender)
    {
        $this->phone = $phone;
        $this->sender = $sender;
    }

    public function send(string $title, string $message): void
    {
        // Реалізація відправки SMS
    }
}

class SlackNotificationAdapter implements Notification
{
    private $slackNotification;

    public function __construct(SlackNotification $slackNotification)
    {
        $this->slackNotification = $slackNotification;
    }

    public function send(string $title, string $message): void
    {
        $this->slackNotification->send($title, $message);
    }
}

class SmsNotificationAdapter implements Notification
{
    private $smsNotification;

    public function __construct(SmsNotification $smsNotification)
    {
        $this->smsNotification = $smsNotification;
    }

    public function send(string $title, string $message): void
    {
        $this->smsNotification->send($title, $message);
    }
}

$emailNotification = new EmailNotification('email@example.com');
$emailNotification->send('Subject', 'Email message');

$slackNotification = new SlackNotification('login', 'api_key', 'chat_id');
$slackNotificationAdapter = new SlackNotificationAdapter($slackNotification);
$slackNotificationAdapter->send('Subject', 'Slack message');

$smsNotification = new SmsNotification('1234567890', 'Sender');
$smsNotificationAdapter = new SmsNotificationAdapter($smsNotification);
$smsNotificationAdapter->send('Subject', 'SMS message');

?>