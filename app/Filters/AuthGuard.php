<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rolePermissions=[];
        $rolePermissions['admin']=['dashboard','user-list','add-user','view_details','edit-user'];
        $rolePermissions['customer']=['dashboard'];
        if (!session()->get('logged_in'))
        {
            return redirect()->to(base_url().'/');
        }else{
            $loginRole = session()->get('role_name');
            $permissions = $rolePermissions[$loginRole];
            $uriString = uri_string();
            $currentRoute = explode("/",$uriString)[0];
            if(!in_array($currentRoute,$permissions)){
               return redirect()->to(base_url().'access-denied');
            }
            
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}