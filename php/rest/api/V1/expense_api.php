<?php

require_once("../../../inc/config.inc.php");
require_once("../../../inc/Entities/Expense.class.php");
require_once("../../../inc/Utilities/PDOAgent.class.php");
require_once("../../../inc/Utilities/DAO/ExpenseDAO.class.php");
require_once("../../../inc/Utilities/ExpensesConverter.class.php");

ExpenseDAO::startDb();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type");;

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
   case 'GET':
      echo json_encode(
         ExpensesConverter::convertToStd(ExpenseDAO::getAllExpenses())
      );
   break;
   case 'POST':
      $data = json_decode(file_get_contents('php://input'));
      ExpenseDAO::insertNewExpense(ExpensesConverter::convertToObj($data));
      header("Location: http://localhost:8080");
   break;
   case 'DELETE':
      $expense = json_decode(file_get_contents('php://input'));
      ExpenseDAO::deleteExpense($expense);
   break;

}