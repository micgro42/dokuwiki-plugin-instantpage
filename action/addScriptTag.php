<?php

class action_plugin_instantpage_addScriptTag extends DokuWiki_Action_Plugin
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
        $controller->register_hook(
            'TPL_METAHEADER_OUTPUT',
            'BEFORE',
            $this,
            'addInstantPageScriptTag'
        );
    }

    /**
     * Event: TPL_METAHEADER_OUTPUT
     *
     * @param Doku_Event $event event object by reference
     *
     * @return void
     */
    public function addInstantPageScriptTag(Doku_Event $event)
    {
        $event->data['script'][] = [
            'type' => 'text/javascript',
            'src' => '//instant.page/1.2.2',
            'async' => true,
            'defer' => true,
        ];
    }
}
