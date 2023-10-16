<?php

namespace oshco\middleware;

use webfiori\email\Email;
use webfiori\framework\middleware\AbstractMiddleware;
use webfiori\http\Request;
use webfiori\http\Response;

/**
 * A middleware which is used to queue email messages for processing after a
 * response is sent.
 *
 * @author i.binalshikh
 */
class MailQueue extends AbstractMiddleware {
    private $messagesQueue;
    private static $instance;
    /**
     * Creates and returns an instance of the class.
     * 
     * @return MailQueue
     */
    public static function get() : MailQueue {
        if (self::$instance === null) {
            self::$instance = new MailQueue();
        }
        return self::$instance;
    }
    /**
     * Creates new instance of the class.
     * 
     * The middleware will be registered under the 'global' middleware group
     * with name 'email-queue' and priority 5.
     */
    public function __construct() {
        parent::__construct('email-queue');
        $this->messagesQueue = [];
        $this->setPriority(5);
        $this->addToGroups([
            'global',
        ]);
    }
    /**
     * Adds new email message to the queue of messages.
     * 
     * @param Email $message
     */
    public static function enqueue(Email $message) {
        self::get()->messagesQueue[] = $message;
    }
    /**
     * A method that does nothing.
     * 
     * @param Request $request
     * @param Response $response
     */
    public function after(Request $request, Response $response) {
        
    }
    /**
     * Process the queue of messages and send them.
     * 
     * @param Request $request
     * @param Response $response
     */
    public function afterSend(Request $request, Response $response) {
        foreach (self::get()->messagesQueue as $m) {
            $m->send();
        }
    }
    /**
     * A method that does nothing.
     * 
     * @param Request $request
     * @param Response $response
     */
    public function before(Request $request, Response $response) {
        
    }
}
