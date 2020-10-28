<?php


namespace Kira\Ajax;

use Kira\Hooks\InteractsWithHooks;
use Kira\Hooks\HasHooksInterface;

class Ajax implements AjaxInterface, HasHooksInterface
{
    use InteractsWithHooks;

    /**
     * @var array
     */
    protected $options;

    /**
     * Ajax will be listen at 'wp_ajax_$action'. For example 'wp_ajax_do_something'.
     *
     * @param string $action
     * @return mixed
     */
    public function listenAt(string $action)
    {
        $this->when('wp_ajax_' . $action);
        return $this;
    }

    /**
     * Set default input options
     *
     * @param array $options
     * @return mixed
     */
    public function withDefaultOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Handle
     *
     * @param \Closure $closure
     * @return mixed
     */
    public function handle(\Closure $closure)
    {
        $this->fire($closure, $this);
    }

    /**
     *
     */
    public function __invoke()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if ($this->options) {
            $input = \wp_parse_args($input, $this->options);
        }

        $this->handler->__invoke($input);
    }


    /**
     * Response with success status.
     *
     * @return mixed
     */
    public function responseSuccess()
    {
        return \wp_send_json([
            'status' => 'success'
        ]);
    }

    /**
     * Response with failed status.
     *
     * @param string $message
     * @return mixed
     */
    public function responseFailed(string $message)
    {
        return \wp_send_json([
            'status'  => 'failed',
            'message' => $message
        ]);
    }
}