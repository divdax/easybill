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
        $this->request = $this->constructRequest($api_key);
    }

    /**
     * @param $api_key
     * @return Request
     */
    protected function constructRequest($api_key) {
        return new Request($this->api_endpoint, $api_key);
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

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCustomer($id)
    {
        return $this->request->delete('customers/'.$id);
    }

    /**
     * @param null $attributes
     * @return $this
     */
    public function createDocument($attributes = null)
    {
        $this->document = $this->request->post('documents', ['form_params' => $attributes]);

        return $this;
    }

    /**
     * @return mixed
     */
    public function done()
    {
        return $this->request->put('documents/' . $this->document->id . '/done');
    }

    /**
     * @return mixed
     */
    public function cancel()
    {
        return $this->request->post('documents/' . $this->document->id . '/cancel');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDocument($id)
    {
        return $this->request->get('documents/'.$id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteDocument($id)
    {
        return $this->request->delete('documents/' . $id);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateDocument($id, array $attributes)
    {
        return $this->request->put('documents/' . $id, ['form_params' => $attributes]);
    }

    /**
     * @param string $type email, fax, post
     * @return mixed
     */
    public function send($type = 'email')
    {
        return $this->request->post('documents/' . $this->document->id . '/send/' . $type);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPDF($id)
    {
        return $this->request->get('documents/' . $id . '/pdf');
    }
}
