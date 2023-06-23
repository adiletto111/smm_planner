<?php

namespace App\View;

class Users extends Main
{
    public function content(array $data)
    {
    
        ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <div class="block-content">      
                            <div class="pull-right">
                                <a href="/users/add" class="btn rounded-pill btn-success me-1 mb-3">
                                    <i class="fa fa-plus fa-pencil-alt"></i>
                                </a>
                            </div>
                            <?php $this->table($this->getColumns(), $data['data']);?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }

    private function getColumns()
    {
        return [
            'id' => [
                'label' => '#',
                'class' => 'text-center',
                'style' => 'width: 50px'
            ],
            'email' => [
                'label' => 'Email пользователя',
                'class' => '',
                'style' => ''
            ],
            'name' => [
                'label' => 'Имя пользователя',
                'class' => '',
                'style' => ''
            ],
            'privilege' => [
                'label' => 'Привилегия',
                'class' => '',
                'style' => ''
            ],
        ];
    }
}