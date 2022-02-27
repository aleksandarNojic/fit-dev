<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Database\ConnectionResolverInterface;

/**
 * Abstract Action.
 *
 */
abstract class AbstractAction
{
    /**
     * Request.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Database connection manager.
     *
     * @var ConnectionResolverInterface
     */
    protected $dbm;

    /**
     * Service outcome status.
     *
     * @var bool
     */
    protected $status;

    /**
     * Constructor.
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request = null)
    {
        $this->request      = $request;
        $this->dbm          = app('db');
    }

    /**
     * Handles the main execution of the service.
     *
     * @throws \Exception
     * @return bool
     */
    abstract public function handle(): bool;

    /**
     * Return the status.
     *
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * Run the service.
     *
     * @return bool
     */
    public function run(): bool
    {
        if (method_exists($this, 'prepare')) {
            $this->prepare();
        }

        $this->status = $this->handle();

        if ($this->status && method_exists($this, 'success')) {
            $this->success();
        }

        return $this->status;
    }
}
