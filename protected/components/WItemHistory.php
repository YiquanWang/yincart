<?php/* * To change this template, choose Tools | Templates * and open the template in the editor. */class WItemHistory extends CWidget {    public function init() {        parent::init();    }        public function getItems(){        if (!empty($_COOKIE['CART']['history'])) {            $ids = $_COOKIE['CART']['history'];            $item_ids = explode(',', $ids);            foreach($item_ids as $item_id){                $items[] = Item::model()->findByPk($item_id);            }            return $items;        }    }    public function run() {        $this->render('itemHistory');    }}