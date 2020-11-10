<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    function peticionCreateOrdenServicio()
    {
        $responseEdit = $this->post('crearOrdenServicio');
        $responseEdit->assertStatus(200);
    }

    function peticionSerCreate()
    {
        $responseEdit = $this->get('/editServicio/{id}');
        $responseEdit->assertStatus(200);
    }

    function peticionSerEdit()
    {
        $responseEdit = $this->get('/editServicio/{id}');
        $responseEdit->assertStatus(200);
    }

    function peticionAreaList()
    {
        $responseEdit = $this->get('/Administrador/area');
        $responseEdit->assertStatus(200);
    }

    function peticionAreaEdit()
    {
        $responseEdit = $this->get('/Administrador/editArea/1');
        $responseEdit->assertStatus(200);
    }

    function peticionAreaCreate()
    {
        $responseEdit = $this->post('/Administrador/crearArea');
        $responseEdit->assertStatus(200);
    }

    function peticionServicioList()
    {

        $responseEdit = $this->get('/Administrador/Servicio');
        $responseEdit->assertStatus(200);

    }

    function peticionServicioEdit()
    {
        $responseEdit = $this->post('/Administrador/crearServicio');
        $responseEdit->assertStatus(200);
    }

    function peticionServicioCreate()
    {
        $responseEdit = $this->post('/Administrador/crearArea');
        $responseEdit->assertStatus(200);
    }

}
