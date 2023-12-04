<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    private $product = '' ;
    protected $helpers = 'form' ;
    public function __construct(){
      
        $this->product = new ProductModel();       
    }

    public function index()
    {
        $data['product'] = $this->product->findAll();
        $data['title'] = 'Display All Products';
        // print_r($data['product']);
        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {

        $rules = [
            'name' => 'required|max_length[30]|min_length[3]',
            'category' => 'required|max_length[30]|min_length[3]',
            'price' => 'required|numeric',
            'sku' => 'required|min_length[3]',
            'model' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('products/create');
        }
        else{
            $data = [
                'product' => $this->request->getVar('title'),
                'category' => $this->request->getVar('category'),
                'price' => $this->request->getVar('price'),
                'sku' => $this->request->getVar('sku'),
                'model' => $this->request->getVar('model'),
            ];

            $this->product->insert($data);
            $session = session(); 
            $session->setFlashdata('msg', 'Product Successfully Added');
            return $this->response->redirect(site_url('/products'));
        }
    }

    public function edit($id){
        //  $this->product->where('product_id', $id);
         $data = $this->product->find($id); 
        // print_r($data);
        return view('products/edit', $data);
    }

    public function update($id){
        //  $this->product->where('product_id', $id);
        //  $data = $this->product->find($id); 
        // print_r($data);
        // return view('products/edit', $data);
    }

    public function delete($id){
        $this->product->where('product_id', $id);
        $this->product->delete();
        return $this->response->redirect('/products');
    }
}