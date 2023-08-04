<?php namespace Sunnyr\Company\Http\Services;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use Sunnyr\Company\Models\Contactus;
use Illuminate\Support\Facades\Validator;
use Sunnyr\Company\Contracts\ContactusServiceInterface;
use Illuminate\Validation\ValidationException;

class ContactusService implements ContactusServiceInterface
{
    public function index()
    {
        return Inertia::render('Contactus/ContactusIndex');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  ['required'],
            'mobile'    =>  ['required'],
            'title'     =>  ['nullable','max:255', 'min:8'],
            'message'   =>  ['required', 'max:5000']
        ]);
       
        try{
            $Contactus = Contactus::create([
                'name'      => $request->name,
                'user_id'   => $request->userId,
                'mobile'    => $request->mobile,
                'title'     => $request->title,
                'message'   => $request->message,
            ]);
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $Contactus;
    }
}

