<?php

class Expense {
   private int $id;
   private string $type;
   private string $name;
   private string $date;
   private float $amount;

   public function getId() {
      return $this->id;
   }

   public function getType() {
      return $this->type;
   }

   public function setType($type) {
      $this->type = $type;
   }

   public function getName() {
      return $this->name;
   }

   public function setName($name) {
      $this->name = $name;
   }

   public function getDate() {
      return $this->date;
   }

   public function setDate($date) {
      $this->date = $date;
   }

   public function getAmount() {
      return $this->amount;
   }

   public function setAmount($amount) {
      $this->amount = $amount;
   }
}