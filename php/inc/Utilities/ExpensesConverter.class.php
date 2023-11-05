<?php

class ExpensesConverter {
   
   public static function convertToStd($expense) {
      if( is_array($expense) ) {
         $expenseList = [];
         foreach($expense as $item) {
            $stdObj = new stdClass;
            $stdObj->id = $item->getId();
            $stdObj->type = $item->getType();
            $stdObj->name = $item->getName();
            $stdObj->date = $item->getDate();
            $stdObj->amount = $item->getAmount();
            $expenseList[] = $stdObj;
         }
         return $expenseList;
      } else {
         $stdObj = new stdClass;
         $stdObj->id = $expense->getId();
         $stdObj->type = $expense->getType();
         $stdObj->name = $expense->getName();
         $stdObj->date = $expense->getDate();
         $stdObj->amount = $expense->getAmount();
   
         return $stdObj;
      }
   }

   public static function convertToObj($stdObject) {
      if( !is_array($stdObject) ) {
         $newExpense = new Expense();
         $newExpense->setType($stdObject->type);
         $newExpense->setName($stdObject->name);
         $newExpense->setDate($stdObject->date);
         $newExpense->setAmount($stdObject->amount);

         return $newExpense;
      } else {
         $expenseList = [];
         foreach($stdObject as $newStdObject) {
            $newExpense = new Expense();
            $newExpense->setType($newStdObject->type);
            $newExpense->setName($newStdObject->name);
            $newExpense->setDate($newStdObject->date);
            $newExpense->setAmount($newStdObject->amount);
            $expenseList[] = $newExpense;
         }
         return $expenseList;
      }
   }
}