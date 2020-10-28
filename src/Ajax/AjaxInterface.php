<?php


namespace Kira\Ajax;


use Closure;

interface AjaxInterface
{
    /**
     * Ajax will be listen at 'wp_ajax_$action'. For example 'wp_ajax_do_something'.
     *
     * @param string $action
     * @return mixed
     */
    public function listenAt(string $action);

    /**
     * Set default input options
     *
     * @param array $options
     * @return mixed
     */
    public function withDefaultOptions(array $options);

    /**
     * Handle
     *
     * @param Closure $closure
     * @return mixed
     */
    public function handle(Closure $closure);

    /**
     * Response with success status.
     *
     * @return mixed
     */
    public function responseSuccess();

    /**
     * Response with failed status.
     *
     * @param string $message
     * @return mixed
     */
    public function responseFailed(string $message);
}