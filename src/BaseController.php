<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Security\Auth;

class BaseController extends AbstractController
{
    public function __construct(RequestStack $request)
    {
        Auth::checkHeader($request->getCurrentRequest()->headers->all());
    }
}