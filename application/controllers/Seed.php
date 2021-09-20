<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH.'vendor/autoload.php';

/**
 * Класс первоначаьной подготовки таблиц
 * возмжно не самое элегантное, но рабочее решение
 *
 * @property Seed_model $seed_model
 */
class Seed extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seed_model');
        $this->load->helper('url');
    }

    /**
     * Производит первоначальную поготовку таблиц
     */
    public function index()
    {
        $supervisor_names = array(
            "Комиссия по делам несовершеннолетних",
            "ОВД",
            "ФНС",
            "Таможня",
            "Трудовая инспекция",
            "Санэпидемстанция",
            "Россельхознадзор",
            "Росреестр",
            "Росприроднадзор",
            "Ростехнадзор",
            "Пожарная инспекция",
            "Ространснадзор",
            "Роскомнадзор",
            "ФАС",
            "Роспотребнадзор",
            "Росстат",
            "Госстройнадзор",
            "Росфинмониторинг",
            "Росздравнадзор",
            "Департамент образования"
        );
        $supervisor = array();
        $business = array();
        $faker = Faker\Factory::create('ru_RU');
        for ($i = 0; $i < 400; $i++){
            $business[] = array('name' => $faker->company);
        }
        foreach ($supervisor_names as $name){
            $supervisor[] = array('name'=> $name);
        }

        try {
            $this->seed_model->seedData('small_business_entity', $business);
            $this->seed_model->seedData('supervisor', $supervisor);
        } catch (Exception $error) {
            echo 'Ошибка при попытке заполнить таблицы: ',  $error->getMessage(), "\n";
        }

    }
}