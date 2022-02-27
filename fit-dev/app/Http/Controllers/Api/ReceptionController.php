<?php

namespace App\Http\Controllers\Api;

use App\Actions\ReceptionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceptionRequest;
use App\Models\FitCard;
use App\Models\SportObject;

class ReceptionController extends Controller
{
    /**
     * Run Reception Action.
     *
     * @return \Illuminate\Http\Response
     */
    public function reception(ReceptionRequest $request)
    {
        $user = FitCard::find($request->card_uuid)->user;
        $sportObject = SportObject::find($request->object_uuid);

        $action = new ReceptionAction($request, $user, $sportObject);
        $action->run();

        return response($action->getResponseData());
    }
}
