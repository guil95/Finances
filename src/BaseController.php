<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 23/03/19
 * Time: 20:57
 */
namespace App;

use Symfony\Component\HttpFoundation\Request;

use App\Security\Auth;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class BaseController extends AbstractController
{
    public function __construct(RequestStack $request)
    {
        Auth::checkHeader($request->getCurrentRequest()->headers->all());
    }
}