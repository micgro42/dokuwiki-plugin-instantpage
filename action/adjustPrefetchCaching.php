<?php

class action_plugin_instantpage_adjustPrefetchCaching extends DokuWiki_Action_Plugin
{

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     *
     * @return void
     */
    public function register(Doku_Event_Handler $controller)
    {
        $controller->register_hook('ACTION_HEADERS_SEND', 'BEFORE', $this, 'adjustCaching');
    }

    /**
     * Event: ACTION_HEADERS_SEND
     *
     * @param Doku_Event $event event object by reference
     *
     * @return void
     */
    public function adjustCaching(Doku_Event $event)
    {
        global $INPUT;
        if (!$this->isPrefetchRequest()) {
            return;
        }
        if (substr($INPUT->server->str('SCRIPT_NAME'), -8) !== 'doku.php') {
            return;
        }
        $event->data[] = 'Cache-Control: max-age=60';
        $event->data[] = 'Pragma: ';
        $event->data[] = 'Expires: ';
    }

    private function isPrefetchRequest()
    {
        global $INPUT;
        return $INPUT->server->str('HTTP_PURPOSE') === 'prefetch'
            || $INPUT->server->str('HTTP_X_MOZ') === 'prefetch';

    }

}
