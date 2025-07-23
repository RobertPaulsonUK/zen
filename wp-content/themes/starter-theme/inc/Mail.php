<?php

    class Mail
    {
        protected string $site_url;
        protected string $site_name;
        protected string $headers;
        protected string $subject;

        public function __construct(string $subject)
        {
            $this->site_url  = wp_parse_url(get_site_url(), PHP_URL_HOST);
            $this->site_name = get_bloginfo('name');
            $this->subject = $subject;
            $this->headers   = $this->generate_default_headers();
        }

        protected function generate_default_headers(): string
        {
            return implode("\r\n", array(
                'From: ' . $this->site_name . ' <wordpress@' . $this->site_url . '>',
                'Content-Type: text/html; charset=UTF-8'
            ));
        }

        public function mail(string $email_to, string $message)
        {
            return mail($email_to, $this->subject, $message, $this->headers);
        }
        public function generate_reset_message(string $code,\WP_User $user):string
        {
            $message = "Hi, " . $user->user_login . "\n\n";
            $message .= "To reset your password, enter the code sent to you on the website\n";
            $message .=  $code. "\n\n";
            $message .= "If you did not request a password reset, please ignore this email.\n";
            return $message;
        }
    }