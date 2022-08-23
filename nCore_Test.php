<?php

require_once("nCore/MySQLConnection.php");
require_once("nCore/MySQLCommand.php");
require_once("nCore/MySQLCommandParameter.php");
require_once("nCore/MySQLCommandParameters.php");
require_once("nCore/MySQLDataReader.php");

try
{
    $db = "database_name";
    $user = "database_username";
    $pass = "database_password";

    // Initialize a new mySQL connection
    $connection = new MySQLConnection('localhost', $db, $user, $pass, 'utf8');
}
catch (Exception $ex)
{
    echo 'DBConnection: Failed to connect to database';
    exit;
}

// How to insert data
$sql = 'INSERT INTO `Employees` (`FirstName`,`LastName`,`Email`,`PhoneNumber`,`Salary`) VALUES (?,?,?,?,?)';
$command = new MySQLCommand($connection, $sql);
$command->Parameters->setString(1, "Nikos");
$command->Parameters->setString(2, "Siatras");
$command->Parameters->setString(3, "email@email.com");
$command->Parameters->setInteger(4, 2100000000);
$command->Parameters->setDouble(5, 1000);
$command->ExecuteQuery();
$recordID = $command->$command->getLastInsertID(); // This returns the Auto Increment ID
echo 'New employee inserted. Record ID is ' . $recordID . '<br>';

// How to read data
$sql = "SELECT `ID`,`FirstName`,`LastName`,`Salary` FROM `Employees` WHERE `Saralary`> ?";
$command = new MySQLCommand($connection, $sql);
$command->Parameters->setInteger(1, 1000);
$reader = $command->ExecuteReader();
while ($reader->Read())
{
    $employeeID = $reader->getValue(0);
    $firstName = $reader->getValue(1);
    $lastName = $reader->getValue(2);
    $salary = $reader->getValue(3);

    echo $firstName . " " . $lastName . " salary is " . $salary;
}
$reader->Close();

// Close the mySQL connection
$connection->Close();
?>