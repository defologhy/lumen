<?php

class ApiTest extends TestCase
{
    /**
     * /crudmongo [GET]
     */
    public function testAllData(){

        $this->get("api/crudmongo", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    '_id',
                    'namalengkap',
                    'alamat',
                    'username',
                    'password',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
        
    }

    /**
     * /crudmongo/id [GET]
     */
    public function testById(){
        $this->get("api/crudmongo/616f68087231655194707614", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    '_id',
                    'namalengkap',
                    'alamat',
                    'username',
                    'password',
                    'created_at',
                    'updated_at'
                ]
            ]    
        );
        
    }

    /**
     * /crudmongo/add [POST]
     */
    public function testAdd(){

        $parameters = [
            'namalengkap' => 'Infinix',
            'alamat' => 'NOTE 4 5.7-Inch IPS LCD (3GB, 32GB ROM) Android 7.0 ',
            'username' => 'test',
            'password' => app('hash')->make('test')
        ];

        $this->post("api/crudmongo/add", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['message']
        );
        
    }
    
    /**
     * /crudmongo/update/id [PUT]
     */
    public function testUpdate(){

        $parameters = [
            'namalengkap' => 'Infinix',
            'alamat' => 'NOTE 4 5.7-Inch IPS LCD (3GB, 32GB ROM) Android 7.0 ',
            'username' => 'test',
            'password' => app('hash')->make('test')
        ];

        $this->put("api/crudmongo/update/616f68087231655194707614", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['message']
        );
    }

    /**
     * /crudmongo/delete/id [DELETE]
     */
    public function testDelete(){
        
        $this->delete("api/crudmongo/delete/616f68087231655194707614", [], []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
                'message'
        ]);
    }

}