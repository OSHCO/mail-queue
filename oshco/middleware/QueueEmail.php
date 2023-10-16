namespace oshco\middleware;

use webfiori\email\Email;
use oshco\middleware\MailQueue;

trait QueueEmail {
    public function enqueue() {
        if ($this instanceof Email) {
            MailQueue::enqueue($this);
        }
    }
}
