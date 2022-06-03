<?php namespace AslamBpract\LaraLegals\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class LaraLegalsTermsController extends BaseController
{




  /**
     * Return the javascript for the Debugbar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view_terms()
    {

        $content ="<h1>Terms</h1><br/><p>This is terms</p>";

        return view('LaraLegals::terms.index', compact('title','content'));


    }
    
  

 /**
     * Return the javascript for the Debugbar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function js()
    {

        $response = new Response(
            'Test Js', 200, [
                'Content-Type' => 'text/javascript',
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
     * Return the stylesheets for the Debugbar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function css()
    {
        

        $response = new Response(
            'Test css', 200, [
                'Content-Type' => 'text/css',
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
     * Cache the response 1 year (31536000 sec)
     */
    protected function cacheResponse(Response $response)
    {
        $response->setSharedMaxAge(31536000);
        $response->setMaxAge(31536000);
        $response->setExpires(new \DateTime('+1 year'));

        return $response;
    }
}
