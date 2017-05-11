<?php

namespace DivDax\Easybill;

use DivDax\Easybill\Http\Request;

/**
 * easybill.de API-Documentation:
 * https://www.easybill.de/api/
 * JSON API-Description:
 * https://api.easybill.de/rest/v1/swagger.json
 */

class easybill
{
    public $api_endpoint = 'https://api.easybill.de/rest/v1/';

    protected $request;

    protected $response;

    protected $document;

    /**
     * easybill constructor.
     * @param $api_key
     */
    public function __construct($api_key)
    {
        $this->request = new Request($this->api_endpoint, $api_key);
    }

    /**
     * Search easybill customers by given get parameters
     *
     * @param array $parameters
     * @return array
     */
    public function searchCustomer(array $parameters)
    {
        $this->response = $this->request->get('customers', $parameters);
        return $this->response;
    }

    /**
     * @param null $attributes
     * @return mixed
     */
    public function createCustomer($attributes = null)
    {
        return $this->request->post('customers', ['form_params' => $attributes]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomer($id)
    {
        return $this->request->get('customers/'.$id);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateCustomer($id, array $attributes)
    {
        return $this->request->put('customers/'.$id, $attributes);
    }

    public function deleteCustomer($id)
    {
        return $this->request->delete('customers/'.$id);
    }

    public function createDocument($attributes = null)
    {
        $this->document = $this->request->post('documents', ['form_params' => $attributes]);

        return $this;
    }

    public function done()
    {
        return $this->request->put('documents/' . $this->document->id . '/done');
    }

    public function cancel()
    {
        return $this->request->post('documents/' . $this->document->id . '/cancel');
    }

    public function deleteDocument($id)
    {
        return $this->request->delete('documents/' . $id);
    }

    /**
     * @param string $type email, fax, post
     * @return mixed
     */
    public function send($type = 'email')
    {
        return $this->request->post('documents/' . $this->document->id . '/send/' . $type);
    }

    public function getPDF($id)
    {
        return $this->request->get('documents/' . $id . '/pdf');
    }
}
