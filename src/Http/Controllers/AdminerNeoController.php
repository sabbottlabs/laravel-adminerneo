<?php
namespace SabbottLabs\AdminerNeo\Http\Controllers;

use Illuminate\Routing\Controller;
use SabbottLabs\AdminerNeo\Support\AdminerNeoManager;

class AdminerNeoController extends Controller
{
    public function __construct(protected AdminerNeoManager $manager)
    {
        //
    }

    public function index()
    {
        if (!config('adminerneo.enabled')) {
            abort(404);
        }

        return $this->manager->handle();
    }
}