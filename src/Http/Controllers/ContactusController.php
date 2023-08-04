<?php

namespace Sunnyr\Company\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Contracts\ContactusServiceInterface;

class ContactusController extends Controller
{
    public function __construct(public ContactusServiceInterface $contactusServiceInterface)
    {
    }

    public function index()
    {
        return $this->contactusServiceInterface->index();
    }

    public function store(Request $request)
    {
        try{
            $this->contactusServiceInterface->store($request);
        } 
        catch(ValidationException $e) {
            return response(['error' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        catch(\Exception $e) {
            return response(['error' => 'خطایی رخ داد'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response(['success' => 'پیام شما با موفقیت ارسال شد' ]);
    }
}
