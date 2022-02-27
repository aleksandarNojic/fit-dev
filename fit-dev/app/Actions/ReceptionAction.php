<?php

namespace App\Actions;

use App\Actions\AbstractAction;
use App\Models\ActivityLog;
use App\Models\SportObject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceptionAction extends AbstractAction
{
    /**
     *
     * @var User
     */
    private $user;

    /**
     *
     * @var SportObject
     */
    private $sportObject;

    /**
     *
     * @var array
     */
    private $responseData;

    /**
     * Constructor.
     *
     * @param Request $request
     * @param Note $note
     */
    public function __construct(Request $request, User $user, SportObject $sportObject)
    {
        $this->user = $user;
        $this->sportObject = $sportObject;

        parent::__construct($request);
    }

    /**
     * Prepare the service for execution.
     *
     * @return void
     *
     * @throws AppException
     */
    public function prepare(): void
    {
        $activeToday = $this->user->activities()
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($activeToday) {
            abort(403, 'Forbidden');
        }
    }

    /**
     * Handles the main execution of the service.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $activityLog = ActivityLog::create([
            'user_id' => $this->user->id,
            'sport_object_id' => $this->sportObject->id
        ]);

        $this->responseData = [
            'status' => 'OK',
            'object_name' => $this->sportObject->name,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
        ];

        return (bool) $activityLog;
    }

    /**
     * Return responseData
     *
     * @return array
     */
    public function getResponseData()
    {
        return $this->responseData;
    }
}
