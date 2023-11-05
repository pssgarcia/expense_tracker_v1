<?php

class ExpenseDAO {
   private static $db;

   public static function startDb() {
      self::$db = new PDOAgent('Expense');
   }

   public static function getAllExpenses() {
      $sql = 'SELECT * FROM expenses';

      self::$db->query($sql);
      self::$db->execute();

      return self::$db->resultSet();
   }

   public static function insertNewExpense(Expense $expense) {
      $sql = 'INSERT INTO expenses (type, name, date, amount) VALUES (:type, :name, :date, :amount)';

      self::$db->query($sql);

      self::$db->bind(':type', $expense->getType());
      self::$db->bind(':name', $expense->getName());
      self::$db->bind(':date', $expense->getDate());
      self::$db->bind(':amount', $expense->getAmount());

      self::$db->execute();
      return self::$db->lastInsertId();
   }

   public static function deleteExpense($expenseId) {
      $sql = 'DELETE FROM expenses WHERE id = :id';

      self::$db->query($sql);
      self::$db->bind(':id', $expenseId);

      self::$db->execute();

      return self::$db->rowCount();
   }
}